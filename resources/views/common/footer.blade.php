<footer class="footer-section">
    <img class="shape1" src="{{ asset('assets/images/footer/f-shape.png') }}" alt="">
    <img class="shape2" src="{{ asset('assets/images/footer/flower01.png') }}" alt="">
    <img class="shape3" src="{{ asset('assets/images/footer/right-shape.png') }}" alt="">
{{--     <div class="newslater-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="newslater-container">
                        <div class="newslater-wrapper">
                            <div class="icon">
                                <img src="{{ asset('assets/images/footer/n-icon.png') }}" alt="">
                            </div>
                            <p class="text">Sign up to recieve a monthly email on the latest news!</p>
                            <form class="newslater-form">
                                <input type="text" placeholder="Your Email Address">
                                <button type="submit">
                                    <i class="fab fa-telegram-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="footer-links">
            <div class="row">
                <div class="col-lg-12">
                    <hr class="hr">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="link-wrapper one">
                        <h4 class="f-l-title">
                            Our Information
                        </h4>
                        <ul class="f-solial-links">
                            <li>
                                <a href="{{ url('about_us') }}">
                                    <i class="fas fa-angle-double-right"></i> About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('contact_us') }}">
                                    <i class="fas fa-angle-double-right"></i> Contact Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('blog') }}">
                                    <i class="fas fa-angle-double-right"></i> Blog
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="link-wrapper two">
                        <h4 class="f-l-title">
                            Quick Links
                        </h4>
                        <ul class="f-solial-links">
                            <li>
                                <a href="{{ url('faqs') }}">
                                    <i class="fas fa-angle-double-right"></i> Faq's
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('blog') }}">
                                    <i class="fas fa-angle-double-right"></i> Blog
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('membership') }}">
                                    <i class="fas fa-angle-double-right"></i> Pricing Table
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="link-wrapper three">
                        <h4 class="f-l-title">
                            Quick Links
                        </h4>
                        <ul class="f-solial-links">
                            <li>
                                <a href="{{ url('members') }}">
                                    <i class="fas fa-angle-double-right"></i> members
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('privacy_policy') }}">
                                    <i class="fas fa-angle-double-right"></i> Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('terms_of_conditions') }}">
                                    <i class="fas fa-angle-double-right"></i> LLC Terms of Use
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="link-wrapper four">
                        <h4 class="f-l-title">Latest Posts</h4>
                        <ul class="f-solial-links">
                            @foreach(get_random_posts('4', '3') as $lpost)
                            <li>
                                <a href="{{url('blog-detail')}}/{{$lpost->slug}}">
                                    <i class="fas fa-angle-double-right"></i>
                                    @php
                                    echo mb_strimwidth($lpost->title, 0, 25, '');
                                    @endphp
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <hr class="hr2">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 align-self-center">
                    <div class="copyr-text">
                        <span>
                            Copyright &copy; {{ date("Y") }}
                        </span>
                        <a href="{{ url('/') }}"> {{ get_section_content('project', 'site_title') }}</a>.
                        <span>Where Sugar Babies Share Their Experience</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="footer-social-links">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fab fa-dribbble"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade filter-p" id="report_user_modalbox" tabindex="-1" role="dialog" aria-labelledby="btn_report_user_modalboxTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h6 class="modal-title" id="btn_report_user_modalboxTitle">Report Users</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="report_user_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="action" value="report">
                    <input type="hidden" name="id" id="report_user_id">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Attachment</label>
                                <input type="file" name="report_image" class="input_file">
                            </div>
                            <div class="col-md-12">
                                <div class="my-input-box">
                                    <label for="">Report Reason</label>
                                    <input type="text" name="description" placeholder="Add description">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="join-now-box">
                            <div class="joun-button">
                                <button type="button" class="custom-button btn_report_user">Report User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>