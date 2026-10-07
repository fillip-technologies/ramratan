<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoldRateService
{
    private const FRESH_TTL = 900;      // refetch from goldapi.io every 15 minutes
    private const FALLBACK_TTL = 86400; // keep last good rate as a fallback for a day

    /**
     * Per-gram INR rates keyed by purity ("24K", "22K", "18K"), or null if unavailable.
     */
    public function rates(): ?array
    {
        $fresh = Cache::get('gold_rates');
        if ($fresh) {
            return $fresh;
        }

        try {
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
                Cache::put('gold_rates', $rates, self::FRESH_TTL);
                Cache::put('gold_rates_last', $rates, self::FALLBACK_TTL);
                return $rates;
            }

            Log::warning('GoldAPI request failed', ['status' => $res->status(), 'body' => $res->body()]);
        } catch (\Throwable $e) {
            Log::warning('GoldAPI request error: ' . $e->getMessage());
        }

        return Cache::get('gold_rates_last');
    }

    public function perGram(string $purity): ?float
    {
        return $this->rates()[strtoupper($purity)] ?? null;
    }
}
