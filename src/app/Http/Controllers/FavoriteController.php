<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, $shopId)
    {
        $user = Auth::user();

        if ($user) {
            $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

            if ($favorite) {
                $favorite->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Favorite::create([
                    'user_id' => $user->id,
                    'shop_id' => $shopId,
                ]);
                return response()->json(['status' => 'added']);
            }
        } else {
            return response()->json(['status' => 'guest']);
        }
        
    }
}
