<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;
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

    //
}
