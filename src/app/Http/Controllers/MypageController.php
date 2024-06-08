<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; 
use App\Models\Shop; 
use App\MOdels\Favorite;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index() {
        $user = auth()->user();

        $reservations = Reservation::where('user_id', $user->id)
        ->with(['shop'=> function($query) {
            $query->select('id', 'shop_name');
        }])->get();

        $shops = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
            ->join('categories', 'shops.category_id', '=', 'categories.id')
            ->join('favorites', 'shops.id', '=', 'favorites.shop_id')
            ->where('favorites.user_id', $user->id)
            ->select('shops.id', 'shops.shop_name', 'shops.image', 'areas.area', 'categories.category')
            ->get();

        return view('mypage', compact('reservations', 'shops'));
    }

    
}
