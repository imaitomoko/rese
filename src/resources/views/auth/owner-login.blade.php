@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="form_heading">
            <h1>オーナーログイン</h1>
        </div>
        @error('login')
        <div class="alert alert-danger">
        &#x26A0; {{ $message }}
        </div>
        @enderror
        <form method="POST" action="/owner/login">
            @csrf
            <div class="form__group">
                <div class="form__input--text">
                    <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__input--text">
                    <input class="input" type="password" name="password" placeholder="Password" />
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