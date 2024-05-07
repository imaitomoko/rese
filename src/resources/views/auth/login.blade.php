@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h2>login</h2>
    </div>
    <form class="form">
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__group-icon">
                    <i class="fa-solid fa-envelope"></i>
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
                    <i class="fa-solid fa-lock"></i>
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