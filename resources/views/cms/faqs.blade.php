@extends('app')
@section('title', 'Faqs')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Faqs</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Faqs</li>
            </ul>
        </div>
    </div>
</section>

<section class="membership-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title extra-padding">
                            Got any Question
                        </h6>
                        <h2 class="title">
                            We’ve Got Answers
                        </h2>
                        <p class="text">
                            Try to check out frequently ask questions
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-area">
            <div class="faq-wrapper">
                <div class="faq-item">
                    <div class="faq-title">
                        <h6 class="title">What is Peyamba? </h6>
                        <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                        <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                        <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                    </div>
                </div>
                <div class="faq-item active open">
                    <div class="faq-title">
                        <h6 class="title">What kind of photos can I use? </h6>
                        <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                        <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                        <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-title">
                        <h6 class="title">Which are the payment methods?</h6>
                        <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                        <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                        <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-title">
                        <h6 class="title">How Our Matchmaking Works ?</h6>
                        <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                        <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                        <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-title">
                        <h6 class="title">How can i delete my profile?</h6>
                        <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                        <p>Being that Tickto does not own any of the tickets sold on our site, we do not have the ability to exchange or replace tickets with other inventory. </p>
                        <p>If you would like to "upgrade" or change the location of your seats, you can relist your current tickets for sale here and purchase other tickets of your choice. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
</script>
@endpush