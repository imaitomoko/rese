@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop-add.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="heading">
            <h1>{{ $owner->owner_name }} オーナー</h1>
        </div>
        <div class="add-shop">
            <div class="add-shop__ttl">
                <h2>店舗追加</h2>
            </div>
            <div class="add-shop__form">
                <form action="/owner/shop/store" method="POST">
                    @csrf
                    <div class="form__item">
                        <p class="form__item-label">店舗名</p>
                        <input type="text" name="shop_name" class="form__item-input" required>
                    </div>
                    <div class="form__item">
                        <label class="form__item-label" for="area_id">エリア</label>
                        <select name="area_id" id="area_id" class="select" required>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form__item">
                        <label class="form__item-label" for="category_id">ジャンル</label>
                        <select name="category_id" id="category_id" class="select" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form__item">
                        <p class="form__item-label">画像</p>
                        <input type="text" name="image" class="form__item-input"required>
                    </div>
                    <div class="form__item">
                        <p class="form__item-label">詳細</p>
                        <textarea name="detail" class="form__item-textarea" required></textarea>
                    </div>
                    <div class="form__button">
                        <button type="submit" class="form__button-submit">作成する</button>
                    </div>
                </form>
            </div>
            <div class="owner__dashboard">
                <a class="owner__dashboard-submit" href="/owner/dashboard">オーナートップページへ</a>
            </div>
        </div>
    </div>
@endsection