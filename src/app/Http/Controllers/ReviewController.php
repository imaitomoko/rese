<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopReviewRequest;
use App\Models\Shop;
use App\Models\ShopReview;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ShopReviewRequest $request, $shopId)
    {
        $shop = Shop::findOrFail($shopId);

        if (Auth::check()) {

            $user = Auth::user();

            $review = new ShopReview();
            $review->shop_id = $shop->id;
            $review->user_id = Auth::id();
            $review->stars = $request->input('stars');
            $review->comment = $request->input('comment', '');  // デフォルトで空の文字列
            $review->save();

            return redirect()->back()->with('success', 'レビューが投稿されました。');
        } else {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }
    }
}
