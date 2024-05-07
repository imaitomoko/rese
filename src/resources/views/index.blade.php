@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="header__inner">
    <div class="header__search">
        <form class="search" action="">
            <div class="search__box">
                <p class="search__box-ttl">All area</p>
                <select class="search__box-area" name="" id="">
                    @foreach ($areas as $area)
                    <option value="{{ $area['id'] }}">{{ $area['name'] }}</option>
                    @endforeach
                </select>
                <p class="search__box-ttl">All genre</p>
                <select class="search__box-genre" name="" id="">
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>

            </div>
        </form>
    </div>
</div>
@endsection