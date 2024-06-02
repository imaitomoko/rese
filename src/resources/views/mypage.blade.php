@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="mypage__content">
    <div class="mypage__heading">
        <h1><?php $user = Auth::user(); ?> {{ $user->name }}さん</h1>
    </div>
    <div class="mypage__item">
        <div class="mypage__reservation">
            <h2>予約状況</h2>
            <div class="reservation__card">
                <div class="reservation__card-heading">
                    <div class="card-heading_title">
                        <i class="fas fa-solid fa-clock"></i>
                        <p class="card-heading_name">予約</p>
                    </div>
                    <div class="card-heading_delete">
                        <i class="fas fa-regular fa-circle-xmark"></i>
                    </div>
                </div>
                <div class="form__index">
                    <div class="index__shop">
                        <p class="index__shop-ttl">Shop</p>
                        <p class="index__shop-text">{{ $shop->shop_name }}</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Date</p>
                        <p class="index__shop-text" id="selectedDate"></p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Time</p>
                        <p class="index__shop-text" id="selectedTime">{{ $defaultTime }}</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Number</p>
                        <p class="index__shop-text" id="selectedNumber">1人</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mypage__favorite">
            <h2>お気に入り店舗</h2>

        </div>
    </div>
</div>
