@extends('app')
@section('title', 'Blog')
@section('content')

@php
$slug = Request::segment(1);
@endphp
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            <h2 class="title extra-padding">The Latest Blog</h2>
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                @if ($slug === 'blog')
                <li>Blog</li>
                @else
                <li><a href="{{ url('blog') }}">Blog</a></li>
                <li>{{ $category->name }}</li>
                @endif
            </ul>
        </div>
    </div>
</section>
<section class="blog-page single-blog-page">
    <div class="container">
        @foreach($blogs as $blog)
        <div class="single-blog">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 blog-lft-col">
                    <a href="{{url('blog-detail')}}/{{$blog->slug}}">
                        <div class="img">
                            @if(!empty($blog->thumbnail))
                            <img src="{{asset('assets/posts_img')}}/{{$blog->thumbnail }}">
                            @else
                            <img src="{{ asset('assets/posts_img/no_image.png') }}">
                            @endif
                        </div>
                    </a>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 blog-lft-middle d-flex">
                    <div class="align-self-center">
                        <div class="content">
                            <div class="right">
                                <p class="category"> Category:
                                    <a href="{{url('category')}}/{{ optional($blog->PostCategory)->slug }}">
                                        {{ optional($blog->PostCategory)->name }}
                                    </a>
                                </p>
                                <a href="{{url('blog-detail')}}/{{$blog->slug}}">
                                    <h4 class="title">
                                        @php
                                        echo mb_strimwidth($blog->title, 0, 50, '');
                                        @endphp
                                    </h4>
                                    <p class="text text-dark">
                                        @php
                                        $content = $blog->description;
                                        echo mb_strimwidth(strip_tags($content), 0, 320, '...');
                                        @endphp
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
@push('scripts')
<script>
</script>
@endpush