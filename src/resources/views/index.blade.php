@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <div class="header__search">
        <form class="header__search-form" id="searchForm" action="/search" method="GET">
            @csrf
            <div class="header__search-inner">
                <label for="area_id">All area</label>
                <select name="area_id" id="area_id" onchange="this.form.submit()">
                <option value=""selected></option>
                @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area }}</option> <!-- 各エリアをオプションとして表示 -->
                @endforeach
                </select>
            </div>
            <div class="header__search-inner">
                <label for="category_id">All genre</label>
                <select name="category_id" id="category_id" onchange="this.form.submit()">
                <option value=""selected></option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option> <!-- 各エリアをオプションとして表示 -->
                @endforeach
                </select>
            </div>
            <div class="header__search-inner">
                <input class="search__form-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Search...">
            </div>
        </form>
    </div>



<div class="flex__item wrap">
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
                    <button class="favorite_button" onclick="toggleFavorite({{ $shop->id }}, {{ auth()->check() ? 'true' : 'false' }})">
                        <span id="heartIcon-{{ $shop->id }}" class="heart {{ $shop->isFavorite ? 'favorite' : '' }}">&#9825;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function toggleFavorite(shopId, isLoggedIn) {
            var heartIcon = document.getElementById('heartIcon-' + shopId);
            heartIcon.classList.toggle('favorite');

            if (isLoggedIn) {
                var isFavorite = heartIcon.classList.contains('favorite') ? 1 : 0;
                saveFavorite(shopId, isFavorite);
            } 
        }

        function saveFavorite(shopId, isFavorite) {
            fetch("{{ route('favorite.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    shop_id: shopId,
                    is_favorite: isFavorite
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

    </script>
</div>


@endsection