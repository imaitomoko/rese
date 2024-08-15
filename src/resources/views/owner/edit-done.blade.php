@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/add-done.css') }}">
@endsection

@section('content')

<div class="content">
    <div class="complete_card">
        <h2>店舗が更新されました。</h2>
        <div class="owner__dashboard">
            <a class="owner__dashboard-submit" href="/owner/dashboard">オーナートップページへ</a>
        </div>
    </div>
</div>

@endsection