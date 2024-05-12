@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="content__shop">
            <div class="content__shop-name">
                <button class="shop__back" type="button" onclick="history.back()">◀️</button>
                <h2 class="shop__name">AAA</h2>
            </div>
            <div class="content__shop-img">
                <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="">
            </div>
            <div class="content__shop-info">
                <p class="content__area">#東京都</p>
                <p class="content__category">#寿司</p>
            </div>
            <div class="content__shop-detail">
                <p class="content__text">料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。</p>
            </div>
        </div>
        <div class="content__reservation">
            <form class="reservation__form" action="">
                <h2 class="reservation__ttl">予約</h2>
                <input class="form__date" type="date">
                <select class="form__time" name="date">
                    <option value=""></option>
                </select>
                <select class="form__number" name="number" id="">
                    <option value=""></option>
                </select>
                <div class="form__index">
                    <div class="index__shop">
                        <p class="index__shop-ttl">Shop</p>
                        <p class="index__shop-text">仙人</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Date</p>
                        <p class="index__shop-text">2021</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Time</p>
                        <p class="index__shop-text">17:00</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Number</p>
                        <p class="index__shop-text">1人</p>
                    </div>
                </div>
                <input class="form__button"type="button" value="予約する">
            </form>
        </div>
    </div>
@endsection