@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')

<div class="content">
    <div class="checkout__form">
        <div class="form__ttl">
            <h3>Stripe決済</h3>
        </div>
        <form action="{{ asset('charge') }}" method="POST">
        @csrf
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-amount="1000"
                data-name="Stripe Demo"
                data-label="決済をする"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="JPY">
            </script>
        </form>
    </div>
</div>

@endsection