<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ReservationRequest;
use App\Jobs\SendReminderEmail;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();

        Log::info('Store method called');

        $user = Auth::user();

        Log::info('Request data: ', $request->all());

        if (!$request->has('shop_id')) {
            Log::error('shop_id is missing from the request');
        }

        $reservation = new reservation();
        $reservation->user_id = $user->id;
        $reservation->shop_id = $request->input('shop_id');
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        Log::info('Reservation saved successfully');

        $shop = Shop::find($reservation->shop_id);

        $reservationDate = Carbon::createFromFormat('Y-m-d', $reservation->date);
        $reminderTime = $reservationDate->setTime(7, 0, 0);

        if ($reminderTime->isPast()) {
            // 予約日時が過去の場合は、直ちにリマインドメールを送信する
            SendReminderEmail::dispatch($reservation);
        } else {
            // 予約日のAM7:00にリマインドメールをスケジュールする
            SendReminderEmail::dispatch($reservation)->delay($reminderTime);
        }

        return view ('done', compact('shop'));
    }

    public function done()
    {
        $shop_id = session('shop_id');
        $shop = Shop::find($shop_id);
        
        return view('done', compact('shop'));
    }

    public function destroy(Reservation $reservation)
    {
        // ログインユーザーが所有している予約かどうかを確認
        if ($reservation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $reservation->delete();

        return response()->json(['success' => 'Reservation deleted successfully']);
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer|min:1',
        ]);

        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        return redirect()->route('mypage.edit', ['id' => $id])->with('success', '予約が更新されました');
    }

}
