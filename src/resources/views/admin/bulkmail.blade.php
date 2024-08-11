@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bulkmail.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="heading">
            <h1>メール送信完了</h1>
        </div>
        <div class="ttl">
            <h3>全ユーザーにメッセージが送信されました。</h3>
        </div>
        <div class="back">
            <a href="/admin/dashboard">ダッシュボードに戻る</a>
        </div>
    </div>

@endsection