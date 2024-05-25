@extends('layouts.app')

<script>
        document.addEventListener("DOMContentLoaded", function() {
            // 今日の日付を取得してセット
            const dateInput = document.querySelector(".form__date");
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
            document.getElementById('selectedDate').innerText = today;

            // 日付が変更された時の処理
            dateInput.addEventListener('change', function() {
                document.getElementById('selectedDate').innerText = this.value;
            });

            // 時間が変更された時の処理
            const timeSelect = document.querySelector(".form__time");
            timeSelect.addEventListener('change', function() {
                document.getElementById('selectedTime').innerText = this.value;
            });

            // 人数が変更された時の処理
            const numberSelect = document.querySelector(".form__number");
            numberSelect.addEventListener('change', function() {
                document.getElementById('selectedNumber').innerText = this.value + "人";
            });
        });
    </script>

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="content__shop">
            <div class="content__shop-name">
                <button class="shop__back" type="button" onclick="history.back()">◀️</button>
                <h2 class="shop__name">{{ $shop->shop_name }}</h2>
            </div>
            <div class="content__shop-img">
                <img src="{{ $shop->image }}" alt="{{ $shop->shop_name }}">
            </div>
            <div class="content__shop-info">
                <p class="content__area">#{{ $shop->area }}</p>
                <p class="content__category">#{{ $shop->category }}</p>
            </div>
            <div class="content__shop-detail">
                <p class="content__text">{{ $shop->detail }}</p>
            </div>
        </div>
        <div class="content__reservation">
            <form class="reservation__form" action="{{ route('store') }}" method="POST">
                @csrf
                <h2 class="reservation__ttl">予約</h2>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input class="form__date" type="date" name="date" value="{{ $today }}">
                <select class="form__time" name="time" >
                    <option value=""></option>
                    @foreach ($times as $time)
                    <option value="{{ $time }}" {{ $time == $defaultTime ? 'selected' : '' }}>{{ $time }}</option>
                    @endforeach
                </select>
                <select class="form__number" name="number" id="">
                    @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
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
                <input class="form__button" type="submit" value="予約する">
            </form>
        </div>
    </div>
@endsection