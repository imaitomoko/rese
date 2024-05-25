@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done__content">
    <h2>ご予約ありがとうございます</h2>
    <div class="back">
        <a href="{{ route('detail', ['shop_id' => $shop->id]) }}" class="back__button">戻る</a>
    </div>
</div>

@endsection