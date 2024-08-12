<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'))->with([
                'login_msg' => 'ログインしました',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

        public function index()
    {
        return view('admin.dashboard'); // admin.dashboardビューが表示されます
    }

        public function logout(Request $request)
        {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトしたらログインフォームにリダイレクト
        return redirect()->route('admin.login')->with([
            'logout_msg' => 'ログアウトしました',
        ]);
    }

    public function registerOwner(Request $request)
    {
        $form = $request->all();
    // パスワードをハッシュ化する
        if (isset($form['password'])) {
            $form['password'] = Hash::make($form['password']);
        }

        $owner = Owner::create($form);

        return view('admin.owner-registered', compact('owner'));
    }

    //
}
