@extends('app')
@section('title', 'Billing Details')
@section('content')
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
                            <a href="#" class="custom-button">Buy Now!</a>
                            <img class="shape" src="assets/images/membership/plan-bg.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>







<div class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title">Plan Details</h3>
                <p class="duration">{{$plan->name}}</p>
                <p class="duration">{{$plan->subtitle}}</p>
                <h4 class="number">$ {{$plan->price}}</h4>
                <p class="stamet mb-30 mt-30">
                    {{$plan->description}}
                </p>
            </div>
        </div>
    </div>
</div>
<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="m-title">Billing Details</h3>
                <div class="single-blog post-details">
                    <form action="{{ route('payment.process') }}" method="POST" id="payment_form">
                        @csrf
                        <div>
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element"></div>
                            <div id="card-errors" role="alert"></div>
                            <input type="text" hidden name="plan_id" value="{{$plan->id}}">
                        </div>
                        <button type="submit">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

</body>
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Stripe
        var stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        cardElement.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment_form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Show error in #card-errors
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Send the token to your server
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
</html>