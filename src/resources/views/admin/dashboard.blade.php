@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="form__heading">
            <h1>管理者ダッシュボード</h1>
        </div>
        <div class="owner_register">
            <div class="ttl">
                <h3>オーナー登録</h3>
            </div>
            <form action="/admin/owners/register" method="post">
                @csrf
                <div class="form__input-text">
                    <input class="form-control" type="text" name="owner_name" placeholder="オーナーの名前を入力してください">
                </div>
                <div class="form__input-text">
                    <input type="text" name="email" class="form-control" placeholder="オーナーのメールアドレスを入力してください" >
                </div>
                <div class="form__input-text">
                    <input class="form-control" type="password" name="password" placeholder="パスワードを入力してください">
                </div>
                <div class="form__button">
                    <button class="form__button-submit type="submit">登 録</button>
                </div>
            </form>
        </div>
        <div class="send__mail">
            <div class="ttl">
                <h3>お知らせメール作成</h3>
            </div>
            <form action="/admin/send/bulk/mail" method="post">
                @csrf
                <div class="mail__text">
                    <textarea name="message" placeholder="メッセージを入力してください"></textarea>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">メール一斉送信</button>
                </div>
            </form>
        </div>
        <div class="logout">
            <a href="/admin/logout">ログアウト</a>
        </div>
    </div>


@endsection