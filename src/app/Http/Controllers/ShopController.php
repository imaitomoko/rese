<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $favoriteStatus = true;

        $shops = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
        ->join('categories', 'shops.category_id', '=', 'categories.id')
        ->select('shops.shop_name','shops.image', 'areas.area','categories.category')->get();
        $areas = Area::all();
        $categories = Category::all();

        return view('index',compact('shops', 'favoriteStatus', 'areas', 'categories'));
    }

    public function search(Request $request)
    {
        $favoriteStatus = true;

        $shops = Shop::join('areas', 'shops.area_id', '=', 'areas.id')
        ->join('categories', 'shops.category_id', '=', 'categories.id')
        ->select('shops.shop_name','shops.image', 'areas.area','categories.category')->AreaSearch($request->area_id)
        ->CategorySearch($request->category_id)
        ->KeywordSearch($request->keyword)
        ->get();
        $areas = Area::all();
        $categories = Category::all();
    
        return view('index', compact('shops', 'favoriteStatus', 'areas', 'categories'));
    }

    public function detail()
    {
        return view('detail');
    }


}  
