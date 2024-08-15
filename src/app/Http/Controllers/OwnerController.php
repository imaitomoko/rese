<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;
use App\Models\Area;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;


class OwnerController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.owner-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $owner = Owner::where('email', $credentials['email'])->first();

    // オーナーが存在し、パスワードが一致するかを確認
        if ($owner && Hash::check($credentials['password'], $owner->password)) {
        // 認証成功 - オーナーをログインさせる
            Auth::guard('owner')->login($owner);

            return redirect()->intended(route('owner.dashboard'))->with([
                'login_msg' => 'ログインしました',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function index()
    {
        $owner = Auth::guard('owner')->user();

        $shops = $owner->shops;

        return view('owner.owner-dashboard', compact('owner', 'shops')); 
    }

    public function showAddShopForm()
    {
        // ログイン中のオーナー情報を取得
        $owner = Auth::guard('owner')->user();

        // エリアとカテゴリ情報を取得
        $areas = Area::all();
        $categories = Category::all();

        // ビューにデータを渡してフォームを表示
        return view('owner.shop-add', compact('owner', 'areas', 'categories'));
    }

    public function storeShop(Request $request)
    {
        $owner = Auth::guard('owner')->user();

        $shopData = $request->only(['shop_name', 'area_id', 'category_id', 'image', 'detail']);
        $shopData['owner_id'] = $owner->id;

        $shop = Shop::create($shopData);

        return redirect()->route('owner.shop.done')->with('shop', $shop);
    }

    public function showDonePage()
    {
        return view('owner.add-done');
    }

    public function showEditShopForm($id)
    {
        // ログイン中のオーナー情報を取得
        $owner = Auth::guard('owner')->user();

        $shop = Shop::where('id', $id)->where('owner_id', $owner->id)->firstOrFail();

        // エリアとカテゴリ情報を取得
        $areas = Area::all();
        $categories = Category::all();
        // ビューにデータを渡してフォームを表示
        return view('owner.shop-edit', compact('owner', 'shop', 'areas', 'categories'));
    }

    public function updateShop(Request $request, $id)
    {
        $owner = Auth::guard('owner')->user();
    
    // バリデーション
        $request->validate([
        'shop_name' => 'required|string|max:255',
        'area_id' => 'required|exists:areas,id',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|string|max:255',
        'detail' => 'required|string',
        ]);

        $shop = Shop::find(id);
            if ($shop && $shop->owner_id == $owner->id) {
                $shopData = $request->only(['shop_name', 'area_id', 'category_id', 'image', 'detail']);
                $shop->update($shopData);

                return redirect()->route('owner.shop.edit.done')->with('shop', $shop);
            }
        return redirect()->route('owner.shop.update')->withErrors('更新に失敗しました');
    }

    public function showEditDonePage()
    {
        return view('owner.edit-done');
    }

    public function showReservations()
    {
    // ログイン中のオーナー情報を取得
    $owner = Auth::guard('owner')->user();

    // オーナーが所有する店舗に関連する予約を取得
    $reservations = Reservation::whereHas('shop', function($query) use ($owner) {
        $query->where('owner_id', $owner->id);
    })->get();

    // ビューにデータを渡す
    return view('owner.owner-reservation', compact('owner', 'reservations'));
    }


}
