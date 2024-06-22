@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')


<div class="content">
    <h1 class="content-title">予約変更</h1>
    <div class="reservation__card">
        <div class="form-group">
            <p class="form-ttl">Shop</p>
            <p class="form-shop">{{ $reservation->shop->shop_name}}</p>
        </div>
        <form class="form" action="{{ route('mypage.update', ['id' => $reservation->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-ttl" for="date">Date</label>
                @php
                $today = date('Y-m-d');
                @endphp
                <input type="date" id="date" name="date" class="form-control" value="{{ $reservation->date }}" min="{{ $today }}">
            </div>
            <div class="form-group">
                <label class="form-ttl" for="time">Time</label>
                <select class="form-control" name="time" >
                    @php
                        use Carbon\Carbon;
                        $selectedTime = Carbon::createFromFormat('H:i:s', $reservation->time)->format('H:i');
                    @endphp
                    @endphp
                    @for ($hour = 17; $hour <= 20; $hour++)
                        @foreach (['00', '30'] as $minute)
                            @php
                                $time = sprintf('%02d:%02d', $hour, $minute);
                            @endphp
                            <option value="{{ $time }}" {{ $time == $selectedTime ? 'selected' : '' }}>　{{ $time }}
                            </option>
                        @endforeach
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-ttl" for="number">Number</label>
                <select class="form-control" name="number" id="">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $i == $reservation->number ? 'selected' : '' }}>
                            {{ $i }}人
                        </option>
                    @endfor
                </select>
            </div>
            <div class="submit-button">
                <button type="submit" class="btn">変更する</button>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="back">
        <a class="back-button" href="/mypage">back</a>
    </div>
</div>



@endsection
