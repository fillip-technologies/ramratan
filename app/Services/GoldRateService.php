<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoldRateService
{
    private const FAILURE_COOLDOWN = 3600; // after a failed call, wait an hour before trying again

    /**
     * Per-gram INR rates keyed by purity ("24K", "22K", "18K"), or null if unavailable.
     *
     * The live API is called at most `calls_per_day` times a day (one call per 24h / N window)
     * and never more than `monthly_limit` times in a calendar month. Everything else is
     * served from cache, so page views never cost API requests.
     */
    public function rates(): ?array
    {
        return $this->withMarkup($this->rawRates());
    }

    /** Rates as returned by GoldAPI, without the configured markup. */
    private function rawRates(): ?array
    {
        $fresh = Cache::get('gold_rates');
        if ($fresh) {
            return $fresh;
        }

        if (Cache::has('gold_rates_cooldown')) {
            return Cache::get('gold_rates_last');
        }

        // Only one request at a time may refresh the rate.
        $lock = Cache::lock('gold_rates_refresh', 15);
        if (!$lock->get()) {
            return Cache::get('gold_rates_last');
        }

        try {
            return Cache::get('gold_rates') ?? $this->refresh();
        } finally {
            $lock->release();
        }
    }

    public function perGram(string $purity): ?float
    {
        return $this->rates()[strtoupper($purity)] ?? null;
    }

    /** Adds GOLD_PRICE_MARKUP (flat rupees per gram) to every purity. */
    private function withMarkup(?array $rates): ?array
    {
        if (!$rates) {
            return null;
        }

        $markup = (float) config('services.goldapi.markup');
        foreach (['24K', '22K', '18K'] as $k) {
            $rates[$k] = round($rates[$k] + $markup, 2);
        }

        return $rates;
    }

    private function refresh(): ?array
    {
        $monthKey = 'gold_api_calls_' . now()->format('Y_m');
        $limit = (int) config('services.goldapi.monthly_limit');

        if ($limit > 0 && (int) Cache::get($monthKey, 0) >= $limit) {
            Log::warning('GoldAPI monthly limit reached, serving last known rate');
            return Cache::get('gold_rates_last');
        }

        try {
            // Count the attempt before calling, so a crash can never cause uncounted requests.
            Cache::add($monthKey, 0, now()->endOfMonth()->addDay());
            Cache::increment($monthKey);

            $res = Http::timeout(8)
                ->withHeaders(['x-access-token' => config('services.goldapi.key')])
                ->get('https://www.goldapi.io/api/price/XAU/INR');

            $json = $res->json();
            $rate = fn (string $k) => $json['melt_price_per_gram'][strtolower($k)] ?? $json['price_gram_' . strtolower($k)] ?? null;

            if ($res->successful() && $rate('24K')) {
                $rates = [
                    '24K' => round($rate('24K'), 2),
                    '22K' => round($rate('22K'), 2),
                    '18K' => round($rate('18K'), 2),
                    'updated_at' => now()->toIso8601String(),
                ];
                Cache::put('gold_rates', $rates, $this->refreshInterval());
                Cache::forever('gold_rates_last', $rates);
                return $rates;
            }

            Log::warning('GoldAPI request failed', ['status' => $res->status(), 'body' => $res->body()]);
        } catch (\Throwable $e) {
            Log::warning('GoldAPI request error: ' . $e->getMessage());
        }

        Cache::put('gold_rates_cooldown', true, self::FAILURE_COOLDOWN);
        return Cache::get('gold_rates_last');
    }

    /** Seconds between live API calls: 86400 / GOLD_API_CALLS_PER_DAY. */
    private function refreshInterval(): int
    {
        $perDay = max(1, (int) config('services.goldapi.calls_per_day'));

        return intdiv(86400, $perDay);
    }
}
