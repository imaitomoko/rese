<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();

        $shopId = $request->input('shop_id');
        $isFavorite = $request->input('is_favorite');

        
        $favorite = Favorite::firstOrNew([
            'user_id' => $user->id,
            'shop_id' =>$shopId
        ]);

        $favorite->is_favorite = $isFavorite;
        $favorite->save();

        return response()->json(['message' => 'Favorite toggled successfully']);
    }
    //
}
