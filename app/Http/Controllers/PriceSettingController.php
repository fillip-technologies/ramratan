<?php

namespace App\Http\Controllers;

use App\Models\CostumForm;
use App\Models\PriceSetting;
use App\Services\GoldRateService;
use Illuminate\Http\Request;

class PriceSettingController extends Controller
{
    public function price_index()
    {
        return view('admin.pricesetting.create');
    }

    public function price_list()
    {
        $prices = PriceSetting::paginate(5);
        return view('admin.pricesetting.list', compact('prices'));
    }

    public function price_store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'price' => 'required',
            'gst' => 'required',
            'making_charges' => 'required',
            'purity' => 'required',
        ]);

        $data = PriceSetting::create([
            'price' => $request->price,
            'gst' => $request->gst,
            'making_charges' => $request->making_charges,
            'purity' => $request->purity,
            'name' => $request->name
        ]);
        if ($data) {
            return redirect('price/list')->with('success', 'Add Price SuccessFully');
        }
    }

    public function price_edit($id)
    {
        $editId = PriceSetting::where('id', $id)->first();
        return view('admin.pricesetting.edit', compact('editId'));
    }
    public function price_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'gst' => 'required|numeric',
            'making_charges' => 'required|numeric',
            'purity' => 'required|string|max:10',
        ]);

        $upId = PriceSetting::findOrFail($id);
        $upId->name = $request->name;
        $upId->price = $request->price;
        $upId->gst = $request->gst;
        $upId->making_charges = $request->making_charges;
        $upId->purity = $request->purity;

        $upId->save();


        return redirect('price/list')->with('success', 'Product price updated successfully!');
    }

    public function price_delete($id)
    {
        $data = PriceSetting::findOrFail($id);
        if ($data) {
            return redirect('price/list')->with('success', 'Delete Price Data SuccessFully');
        }
    }


    public function customization_form(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'material' => 'required',
            'description' => 'required|string',
            'images' => 'required|mimes:png,jpg',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }

        $data = CostumForm::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'material' => $request->material,
            'description' => $request->description,
            'images' => $imagePath
        ]);

        if ($data) {
            return back()->with('success', 'Your Data Submitted SuccessFully !');
        }
    }

    public function custom_list()
    {
        $custom = CostumForm::paginate(10);
        return view('pages.custom', compact('custom'));
    }


    public function goldRates(GoldRateService $gold)
    {
        $rates = $gold->rates();

        if (!$rates) {
            return response()->json(['status' => 0, 'message' => 'Gold rate unavailable'], 503);
        }

        return response()->json(['status' => 1, 'data' => $rates]);
    }

    public function calculate(Request $request, GoldRateService $gold)
    {
        $request->validate([
            'product' => 'required|string',
            'purity' => 'required|in:24K,22K,18K',
            'weight' => 'required|numeric|min:0.01|max:10000',
        ]);

        $setting = PriceSetting::where('name', $request->product)->first();
        if (!$setting) {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }

        $rate = $gold->perGram($request->purity);
        if (!$rate) {
            return response()->json(['status' => 0, 'message' => 'Gold rate unavailable'], 503);
        }

        $goldValue = $rate * $request->weight;
        $making = (float) $setting->making_charges;
        $subtotal = $goldValue + $making;
        $gstPercent = (float) $setting->gst;
        $gstAmount = $subtotal * $gstPercent / 100;

        return response()->json([
            'status' => 1,
            'data' => [
                'price' => round($rate, 2),
                'gold_value' => round($goldValue, 2),
                'making_charges' => round($making, 2),
                'subtotal' => round($subtotal, 2),
                'gst_percent' => $gstPercent,
                'gst' => round($gstAmount, 2),
                'totalChrges' => round($subtotal + $gstAmount, 2),
            ],
        ]);
    }
}
