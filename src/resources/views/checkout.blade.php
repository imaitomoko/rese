@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')

<div class="content">
    @if (session('success_message'))
        <div>{{ session('success_message') }}</div>
    @endif

    @if (session('error_message'))
        <div>{{ session('error_message') }}</div>
    @endif
    <div class="checkout__form">
        <div class="form__ttl">
            <h3>Strip決済</h3>
        </div>
        
        <form id="payment-form" action="{{ route('store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="amount">金額</label>
                <input type="text" id="amount" name="amount" placeholder="金額" required>
            </div>
            <div class="form-group">
                <label for="card-element">クレジットカード情報</label>
                <div id="card-element" class="StripeElement"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button class="button__submit" type="submit" class="btn">支払う</button>
        </form>
    </div>
</div>
    
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        var cardExpiry = elements.create('cardExpiry', {style: style});
        cardExpiry.mount('#card-expiry-element');

        var cardCvc = elements.create('cardCvc', {style: style});
        cardCvc.mount('#card-cvc-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var amount = document.getElementById('amount').value;

            fetch('{{ route('processPayment') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify({
                    amount: amount
                })
            }).then(function(response) {
                return response.json();
            }).then(function(responseJson) {
                stripe.confirmCardPayment(responseJson.clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: '顧客名',
                        },
                    },
                }).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        if (result.paymentIntent.status === 'succeeded') {
                            alert('支払いが成功しました');
                        }
                    }
                });
            });
        });
    </script>

@endsection