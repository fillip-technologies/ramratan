<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
public function store_wishlist(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'product_id' => 'required|integer',
    ]);

    $uid = $request->user_id;
    $pid = $request->product_id;

    $exists = WishList::where('user_id', $uid)
                      ->where('product_id', $pid)
                      ->exists();

    if ($exists) {
        return back()->with('added', 'Product already added to wishlist.');
    }


    $wish = WishList::create([
        'user_id' => $uid,
        'product_id' => $pid,
    ]);

    if ($wish) {
        return redirect()->route('wishlist')->with('success', 'Product added to wishlist.');
    }

    return back()->with('error', 'Something went wrong, please try again.');
}

  public function remove(Request $request)
    {
        $userId = auth()->id();

        WishList::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['success' => true]);
    }


}
