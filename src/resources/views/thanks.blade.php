@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <h1>会員登録ありがとうございます</h1>
    <a href="{{ route('login') }}" class="btn btn-primary">ログインする</a>
</div>
@endsection