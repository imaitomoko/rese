@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-registered.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>オーナー登録が完了しました！</h1>
        <h3>オーナー名: {{ $owner->owner_name }}</h3>
        <h3>メールアドレス: {{ $owner->email }}</h3>
        <div class="dashboard">
            <a href="/admin/dashboard">ダッシュボードに戻る</a>
        </div>
        
    </div>
@endsection