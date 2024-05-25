<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
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

        return view ('done', compact('shop'));
    }

    public function done()
    {
        $shop_id = session('shop_id');
        $shop = Shop::find($shop_id);
        
        return view('done', compact('shop'));
    }
}
