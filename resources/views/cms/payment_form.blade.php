@extends('app')
@section('title', 'Billing Details')
@section('content')
<style>
    #payment-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }
    #card-element {
        background-color: white;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    #card-errors {
        color: red;
        margin-bottom: 20px;
    }
    #submit-button {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        padding: 12px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    #submit-button:hover {
        background-color: #218838;
    }
</style>

<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Billing Details</li>
            </ul>
        </div>
    </div>
</section>

<section class="user-setting-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="page-title">Membership Plan Details</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-plan">
                            <p class="duration">{{$plan->name}}</p>
                            <h4 class="number">
                                <sup>$</sup>{{$plan->price}}
                            </h4>
                            <p class="stamet">{{$plan->subtitle}}</p>
                            <p class="stamet">{{$plan->description}}</p>
                            <img class="shape" src="{{ asset('assets/images/membership/plan-bg.png') }} " alt="">
                            <p class="duration">Billing Details</p>
                            <div class="single-blog post-details">
                                <form action="{{ route('payment.process') }}" method="POST" id="payment_form">
                                    @csrf
                                    <div>
                                        <label for="card-element">Credit or debit card</label>
                                        <div id="card-element"></div>
                                        <div id="card-errors" role="alert"></div>
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                    </div>
                                    <button type="submit">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        cardElement.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        var form = document.getElementById('payment_form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
