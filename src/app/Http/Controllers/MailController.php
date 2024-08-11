<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendBulkMail(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
        // 全ユーザーを取得
        $users = User::all();

        // 各ユーザーにメール送信
        foreach ($users as $user) {
            Mail::raw($request->input('message'), function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('お知らせ');
            });
        }
        return view('admin.bulkmail');
    }
        
}
