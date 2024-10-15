@extends('app')
@section('title', 'Blog')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Blog</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Blog</li>
            </ul>
        </div>
    </div>
</section>
<section class="blog-page single-blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-blog">
                            <div class="img">
                                <img src="{{ asset('assets/images/blog/blog1.png') }}" alt="">
                            </div>
                            <div class="content">
                                <div class="left">
                                    <div class="avatar">
                                        <img src="{{ asset('assets/images/blog/author-avarat.png') }}" alt="">
                                    </div>
                                    <ul class="meta-list">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="far fa-comments"></i>
                                            </a>
                                            <span>30</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                            <span>22</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <p class="date">
                                        December 19, 2021
                                    </p>
                                    <h4 class="title">
                                        Tips You Should Know When You Plan To
                                        Date Online
                                    </h4>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua.Quis ipsum suspendisse ultrices gravida. Risus do viverra maecenas
                                    </p>
                                </div>
                            </div>
                            <div class="post-footer">
                                <div class="left">
                                    <p>
                                        <b>Category:</b> Dating Advice
                                    </p>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0)" class="read-more-btn">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-blog">
                            <div class="img">
                                <img src="{{ asset('assets/images/blog/blog2.png') }}" alt="">
                            </div>
                            <div class="content">
                                <div class="left">
                                    <div class="avatar">
                                        <img src="{{ asset('assets/images/blog/author-avarat.png') }}" alt="">
                                    </div>
                                    <ul class="meta-list">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="far fa-comments"></i>
                                            </a>
                                            <span>30</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                            <span>22</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <p class="date">
                                        December 19, 2021
                                    </p>
                                    <h4 class="title">
                                        Want to Be Successful at Friends Dating? - Top
                                        Online Dating Tips and Techniques
                                    </h4>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua.Quis ipsum suspendisse ultrices gravida. Risus do viverra maecenas
                                    </p>
                                </div>
                            </div>
                            <div class="post-footer">
                                <div class="left">
                                    <p>
                                        <b>Category:</b> Dating Advice
                                    </p>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0)" class="read-more-btn">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-blog">
                            <div class="img">
                                <img src="{{ asset('assets/images/blog/blog3.png') }}" alt="">
                            </div>
                            <div class="content">
                                <div class="left">
                                    <div class="avatar">
                                        <img src="{{ asset('assets/images/blog/author-avarat.png') }}" alt="">
                                    </div>
                                    <ul class="meta-list">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="far fa-comments"></i>
                                            </a>
                                            <span>30</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                            <span>22</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <p class="date">
                                        December 19, 2021
                                    </p>
                                    <h4 class="title">
                                        Welcome the Dating Coach - The New Super
                                        Hero of 21st Century Online Dating
                                    </h4>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua.Quis ipsum suspendisse ultrices gravida. Risus do viverra maecenas
                                    </p>
                                </div>
                            </div>
                            <div class="post-footer">
                                <div class="left">
                                    <p>
                                        <b>Category:</b> Dating Advice
                                    </p>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0)" class="read-more-btn">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-blog">
                            <div class="img">
                                <img src="{{ asset('assets/images/blog/blog4.png') }}" alt="">
                            </div>
                            <div class="content">
                                <div class="left">
                                    <div class="avatar">
                                        <img src="{{ asset('assets/images/blog/author-avarat.png') }}" alt="">
                                    </div>
                                    <ul class="meta-list">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="far fa-comments"></i>
                                            </a>
                                            <span>30</span>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                            <span>22</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <p class="date">
                                        December 19, 2021
                                    </p>
                                    <h4 class="title">
                                        Tips You Should Know When You Plan To
                                        Date Online
                                    </h4>
                                    <p class="text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua.Quis ipsum suspendisse ultrices gravida. Risus do viverra maecenas
                                    </p>
                                </div>
                            </div>
                            <div class="post-footer">
                                <div class="left">
                                    <p>
                                        <b>Category:</b> Dating Advice
                                    </p>
                                </div>
                                <div class="right">
                                    <a href="javascript:void(0)" class="read-more-btn">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget widget-search">
                    <h5 class="title">search</h5>
                    <form class="search-form">
                        <input type="text" placeholder="Enter your Search Content" required>
                        <button type="submit"><i class="flaticon-loupe"></i>Search</button>
                    </form>
                </div>
                <div class="widget widget-categories">
                    <h5 class="title">categories</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Showtimes & Tickets</span><span>50</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Latest Trailers</span><span>43</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Coming Soon </span><span>34</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>In Theaters</span><span>63</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Release Calendar  </span><span>11</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Stars</span><span>30</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span>Horror Movie </span><span>55</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="widget widget-post">
                    <h5 class="title">latest post</h5>
                    <div class="slider-nav">
                        <span class="flaticon-angle-pointing-to-left widget-prev"></span>
                        <span class="flaticon-right-arrow-angle widget-next active"></span>
                    </div>
                    <div class="widget-slider owl-carousel owl-theme">
                        <div class="item">
                            <div class="thumb">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/images/blog/resent-post.png') }}" alt="blog">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="p-title">
                                    <a href="javascript:void(0)">How to Start, Plan, and Keep a
                                    Date Night</a>
                                </h6>
                                <div class="meta-post">
                                    <a href="javascript:void(0)" class="mr-4"><i class="fas fa-user"></i>Admin</a>
                                    <a href="javascript:void(0)"> <i class="far fa-comments"></i> Comments</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="thumb">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/images/blog/resent-post.png') }}" alt="blog">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="p-title">
                                    <a href="javascript:void(0)">How to Start, Plan, and Keep a
                                    Date Night</a>
                                </h6>
                                <div class="meta-post">
                                    <a href="javascript:void(0)" class="mr-4"><i class="fas fa-user"></i>Admin</a>
                                    <a href="javascript:void(0)"> <i class="far fa-comments"></i> Comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-newsletter">
                    <h5 class="title">Newsletter</h5>
                    <form class="search-form">
                        <input type="text" placeholder="Enter your Email Address" required>
                        <button type="submit"><i class="far fa-envelope"></i> Send</button>
                    </form>
                </div>
                <div class="widget widget-tags">
                    <h5 class="title">featured tags</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">creative</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">design</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">skill</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">template</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="active">landing</a>
                        </li>
                    </ul>
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