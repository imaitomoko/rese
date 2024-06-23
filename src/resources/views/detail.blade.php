@extends('layouts.app')

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

            <div class="content__shop-review">
                <h3>レビューを投稿する</h3>
                <form action="{{ route('shop.reviews.store', $shop->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="stars">評価:</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="stars" value="5"><label for="star5">★</label>
                            <input type="radio" id="star4" name="stars" value="4"><label for="star4">★</label>
                            <input type="radio" id="star3" name="stars" value="3"><label for="star3">★</label>
                            <input type="radio" id="star2" name="stars" value="2"><label for="star2">★</label>
                            <input type="radio" id="star1" name="stars" value="1" checked><label for="star1">★</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">コメント:</label>
                        <textarea class=" comment_form" name="comment" id="comment" rows="4"></textarea>
                    </div>
                    <button class="review_button" type="submit">レビューを投稿する</button>
                </form>
            </div>

            <div class="content__shop-reviews">
                <h3>レビュー</h3>
                @forelse ($shop->reviews as $review)
                <div class="review">
                    <p>評価: {{ $review->stars }} / 5</p>
                    <p>{{ $review->comment }}</p>
                    <p>投稿者: {{ $review->user->name }}</p>
                    <p>投稿日: {{ $review->created_at->format('Y-m-d') }}</p>
                </div>
                @empty
                <p>まだレビューはありません。</p>
                @endforelse
            </div>
        </div>

        <div class="content__reservation">
            <form class="reservation__form" action="{{ route('store') }}" method="POST">
                @csrf
                <h2 class="reservation__ttl">予約</h2>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input class="form__date" type="date" name="date" value="{{ $today }}" min="{{ $today }}">
                <select class="form__time" name="time" >
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

@section('scripts')
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

            const stars = document.querySelectorAll('.star-rating label');
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.previousElementSibling.value;
                    alert(`評価: ${rating}が選択されました。`);
                });
            });
        });
</script>
@endsection
