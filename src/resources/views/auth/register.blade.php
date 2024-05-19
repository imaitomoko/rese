@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        <h3>Registration</h3>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__group-icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <div class="form__input--text">
                    <input class="input" type="text" name="name" value="{{ old('name') }}" placeholder="Username"/>
                </div>
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
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
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection