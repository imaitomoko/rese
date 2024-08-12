@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-dashboard.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="heading">
            <h1>{{ $owner->owner_name }} オーナー</h1>
        </div>
        <div class="shop">
            <div class="shop__ttl">
                <h3>店舗情報</h3>
            </div>
            <div class="shop-table">
                <table class="shop-table__inner">
                    <tr class="shop-table__row">
                        <th class="shop-table__header">店舗</th>
                    </tr>
                    @foreach($shops as $shop)
                        <tr class="shop-table__row">
                            <td class="shop-table__item">{{ $shop->shop_name }}</div>
                            <td class="shop-table__item">
                                <div class="update-form__button">
                                    <a class="update-form__button-submit" type="submit">編集</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="button">
                <div class="add">
                    <a href="">店舗追加</a>
                </div>
                <div class="reservation">
                    <a href="">予約一覧</a>
                </div>
            </div>
        </div>
    </div>
@endsection