@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <h2>会員登録ありがとうございます</h2>
    <div class="login">
        <a href="{{ route('login') }}" class="login__button">ログインする</a>
    </div>
</div>
@endsection