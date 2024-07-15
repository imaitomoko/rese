@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')

<div class="content">
    <div class="complete_card">
        <h3>この度はご利用いただき、誠にありがとうございます。<br>
        お支払いが完了しました。</h3>
        <div class="mypage_button">
            <a class="mypage" href="/mypage">マイページへ</a>
        </div>
    </div>
</div>

@endsection
