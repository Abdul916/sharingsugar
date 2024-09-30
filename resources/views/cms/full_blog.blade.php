@extends('app')
@section('title', $blog->title)

@section('meta_description', $blog->short_description)
@section('meta_keywords', $blog->keywords)
@section('meta_canonical_url', url('blog-detail').'/'.$blog->slug)
@section('meta_image', asset('assets/posts_img').'/'.$blog->thumbnail)

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
            <div class="col-lg-12">
                <div class="single-blog post-details">
                    <div class="img">
                        @if(empty($blog->thumbnail))
                        <img src="{{ asset('assets/posts_img/no_image.png') }}">
                        @else
                        <img src="{{asset('assets/posts_img')}}/{{$blog->thumbnail }}">
                        @endif
                    </div>
                    <div class="content">
                        <div class="right">
                            <h4 class="date">By: {{ get_single_value('admin_users', 'username', $blog->created_by) }} {{ date_with_month($blog->created_at)}}</h4>
                            <p class="category"> Category:
                                <a href="{{url('category')}}/{{ optional($blog->PostCategory)->slug }}">
                                    {{ optional($blog->PostCategory)->name }}
                                </a>
                            </p>
                            <br>
                            <div class="post-header">
                                <h4 class="m-title">{{$blog->title}}</h4>
                                <?php echo $blog->description; ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(isset($blog->next))
                                    <strong>
                                        <em>If you enjoyed this read, you might also find this interesting:</em>
                                        <a href="{{url('blog-detail')}}/{{$blog->next->slug}}" style="color: blue; text-transform: uppercase;">
                                            {{ mb_strimwidth($blog->next->title, 0, 50, '') }}
                                        </a>
                                    </strong>
                                    @else
                                    <strong>
                                        <em>If you enjoyed this read, you might also find this interesting:</em>
                                        <a href="{{url('blog-detail')}}/{{$blog->previous->slug}}" style="color: blue; text-transform: uppercase;">
                                            {{ mb_strimwidth($blog->previous->title, 0, 50, '') }}
                                        </a>
                                    </strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="join-now-section">
    <img class="shape1" src="{{ asset('assets/images/join/heartshape.png') }}" alt="">
    <img class="shape2" src="{{ asset('assets/images/join/img.png') }}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content text-center">
                    <div class="section-header white-color">
                        <p class=" section_header_title">EARN BY SHARING</p>
                        <h2 class="title wow fadeInUp text-center">We paid Sugar Babies</h2>
                        <p class="section_header_title">Questions or Comments</p>
                    </div>
                    <a href="javascript:void(0)" class="custom-button">Share Your Experience</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title wow fadeInUp">YOU MIGHT ALSO LIKE</h6>
                        <h2 class="title wow fadeInUp">Related Posts</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach(get_random_posts('1', '3') as $rpost)
            <div class="col-lg-4 col-md-6">
                <a href="{{url('blog-detail')}}/{{$rpost->slug}}">
                    <div class="single-story-box wow fadeInUp" data-wow-delay="0.3s">
                        <div class="img">
                            @if(!empty($rpost->thumbnail))
                            <img src="{{asset('assets/posts_img')}}/{{$rpost->thumbnail }}" style="width: 340px; height: 240px;">
                            @else
                            <img src="{{ asset('assets/posts_img/no_image.png') }}" style="width: 340px; height: 240px;">
                            @endif
                        </div>
                        <div class="content">
                            <h4 class="title">
                                @php
                                echo mb_strimwidth($rpost->title, 0, 35, '...');
                                @endphp
                            </h4>
                            <p class="date text-dark">{{ date_with_month($rpost->created_at)}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
</script>
@endpush