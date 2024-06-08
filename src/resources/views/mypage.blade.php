@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@php
use Carbon\Carbon;
@endphp

<div class="content">
    <div class="mypage__heading">
        <h1 class="user_name"><?php $user = Auth::user(); ?> {{ $user->name }}さん</h1>
    </div>
    <div class="mypage__item">
        <div class="mypage__reservation">
            <h2>予約状況</h2>
            @foreach($reservations as $index => $reservation)
            <div class="reservation__card" id="reservation-{{ $reservation->id }}">
                <div class="reservation__card-heading">
                    <div class="card-heading_title">
                        <div class="icon">
                            <i class="fas fa-solid fa-clock large-icon"></i>
                        </div>
                        <p class="card-heading_name">予約{{ $index + 1 }}</p>
                    </div>
                    <div class="card-heading_delete">
                        <button class="delete-button" data-id="{{ $reservation->id }}">
                            <i class="fas fa-solid fa-trash large-icon"></i>
                        </button>
                    </div>
                </div>
                <div class="form__index">
                    <div class="index__shop">
                        <p class="index__shop-ttl">Shop</p>
                        <p class="index__shop-text">{{ $reservation->shop->shop_name }}</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Date</p>
                        <p class="index__shop-text">{{ $reservation->date }}</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Time</p>
                        <p class="index__shop-text">{{ Carbon::createFromFormat('H:i:s',$reservation->time)->format('H:i') }}</p>
                    </div>
                    <div class="index__shop">
                        <p class="index__shop-ttl">Number</p>
                        <p class="index__shop-text">{{ $reservation->number }}人</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mypage__favorite">
            <h2>お気に入り店舗</h2>
            <div class="favorite__items wrap">
                @foreach ($shops as $shop)
                <div class="shop">
                    <div class="shop__img">
                        <img src="{{ $shop->image }}" alt="{{ $shop->shop_name }}">
                    </div>
                    <div class="shop__content">
                        <p class="shop__name">{{ $shop->shop_name }}</p>
                        <div class="shop__info">
                            <p class="shop__area">#{{ $shop->area }}</p>
                            <p class="shop__category">#{{ $shop->category }}</p>
                        </div>
                        <div class="shop__button">
                            <div class="shop__detail">
                                <a class="shop__detail-submit" href="{{ route('detail', ['shop_id' => $shop->id]) }}">詳しく見る</a>
                            </div>
                            <div class="shop__favorite">
                                @auth
                                    <button class="favorite-button" data-shop-id="{{ $shop->id }}">
                                        <i class="fa {{ $shop->isFavoritedBy(Auth::user()) ? 'fas fa-heart active' : 'fas fa-heart' }}"></i>
                                    </button>
                                @else
                                    <button class="favorite-button" data-shop-id="{{ $shop->id }}">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                @endauth

                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div> 
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.delete-button').click(function() {
        var reservationId = $(this).data('id');
        var url = '/reservations/' + reservationId;
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                "_token": token,
            },
            success: function(response) {
                if (response.success) {
                    $('#reservation-' + reservationId).remove();
                    updateReservationIndexes();
                } else {
                    alert('Failed to delete reservation.');
                }
            },
            error: function(response) {
                alert('Failed to delete reservation.');
            }
        });
    });
    function updateReservationIndexes() {
        $('.reservation__card').each(function(index) {
            $(this).find('.card-heading_name').text('予約' + (index + 1));
        });
    }

});

document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const shopId = this.getAttribute('data-shop-id');
            const heartIcon = this.querySelector('i');
            const shopElement = this.closest('.shop');
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

            if (isLoggedIn) {
                fetch(`/favorite/${shopId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        heartIcon.classList.add('active');
                    } else if (data.status === 'removed') {
                        heartIcon.classList.remove('active');
                        // ショップエレメントを削除
                        shopElement.remove();
                    }
                });
            } else {
                window.location.href = "{{ route('login') }}";
            }
        });
    });
});


</script>


@endsection

