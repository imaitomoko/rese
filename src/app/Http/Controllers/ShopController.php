<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index()
    {
        $favoriteStatus = true;

        $shops = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
        ->join('categories', 'shops.category_id', '=', 'categories.id')
        ->select('shops.id', 'shops.shop_name','shops.image', 'areas.area','categories.category')->get();
        $areas = Area::all();
        $categories = Category::all();

        return view('index',compact('shops', 'favoriteStatus', 'areas', 'categories'));
    }

    public function search(Request $request)
    {
        $favoriteStatus = true;

        $shops = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
        ->join('categories', 'shops.category_id', '=', 'categories.id')
        ->select('shops.id', 'shops.shop_name','shops.image', 'areas.area','categories.category')->AreaSearch($request->area_id)
        ->CategorySearch($request->category_id)
        ->KeywordSearch($request->keyword)
        ->get();
        $areas = Area::all();
        $categories = Category::all();
    
        return view('index', compact('shops', 'favoriteStatus', 'areas', 'categories'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
            ->join('categories', 'shops.category_id', '=', 'categories.id')
            ->select('shops.shop_name', 'shops.image', 'areas.area', 'categories.category', 'shops.detail')
            ->where('shops.id', $shop_id)
            ->first();

        if (!$shop) {
            abort(404); // ショップが見つからない場合は404エラーを返す
        }

        $today = Carbon::today()->toDateString();

        $times = [];
        $startTime = Carbon::createFromTime(17, 0);
        $endTime = Carbon::createFromTime(20, 0);

        while ($startTime->lessThanOrEqualTo($endTime)) {
            $times[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }

        $areas = Area::all();
        $categories = Category::all();
        $defaultTime = '17:00';

        return view('detail', compact('shop', 'areas', 'categories', 'today', 'times', 'defaultTime'));
    }


}  
