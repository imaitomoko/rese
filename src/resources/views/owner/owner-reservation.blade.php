@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-reservation.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="heading">
            <h1>{{ $owner->owner_name }} オーナー</h1>
        </div>
        <div class="shop">
            <div class="shop__ttl">
                <h2>予約一覧</h2>
            </div>
            <div class="shop-table">
                <table class="shop-table__inner">
                    <tr class="shop-table__row">
                        <th class="shop-table__header">
                            <span class="shop-table__header-span">店舗</span>
                            <span class="shop-table__header-span">Date</span>
                            <span class="shop-table__header-span">Time</span>
                            <span class="shop-table__header-span">人数</span>
                        </th>
                    </tr>
                    @foreach($reservations as $reservation)
                    <tr class="shop-table__row">
                        <td class="shop-table__item">
                            <div class="shop-table__item-data">
                                <p class="shop-table__item-p">{{ $reservation->shop->shop_name }}</p>
                            </div>
                            <div class="shop-table__item-data">
                                <p class="shop-table__item-p">{{ $reservation->date }}</p>
                            </div>
                            <div class="shop-table__item-data">
                                <p class="shop-table__item-p">{{ date('H:i', strtotime($reservation->time)) }}</p>
                            </div>
                            <div class="shop-table__item-data">
                                <p class="shop-table__item-p">{{ $reservation->number }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="button">
                <a class="shop__button" href="/owner/dashboard">オーナートップページへ</a>
            </div>
        </div>
    </div>
@endsection