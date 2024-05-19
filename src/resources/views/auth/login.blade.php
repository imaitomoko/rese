@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h3>login</h3>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__group-icon">
                    <i class="fas fa-envelope fa-2x"></i>
                </div>
                <div class="form__input--text">
                    <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                </div>
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__group-icon">
                    <i class="fas fa-lock fa-2x"></i>
                </div>
                <div class="form__input--text">
                    <input class="input" type="password" name="password" placeholder="Password" />
                </div>
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection