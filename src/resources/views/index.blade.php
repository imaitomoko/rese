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
                <option value="{{ $area->id }}">{{ $area->area }}</option> 
                @endforeach
            </select>
        </div>
        <div class="header__search-inner">
            <label for="category_id">All genre</label>
            <select name="category_id" id="category_id" onchange="this.form.submit()">
            <option value=""selected></option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category }}</option> 
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
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const shopId = this.getAttribute('data-shop-id');
            const heartIcon = this.querySelector('i');
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