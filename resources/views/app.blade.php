<!DOCTYPE html>
<html lang="en">

<head>
    @include('common.styles')
    <title>@yield('title') &#8211; {{ get_section_content('project', 'site_title') }}</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <link rel="canonical" href="@yield('meta_canonical_url')">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('meta_description')">

    <meta property="og:image" content="@yield('meta_image')">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <style>
        .active .page-link {
            background: #5650ce;
        }

        .pac-container {
            z-index: 10000 !important;
            position: relative;
        }

        .xl_bordernone {
            background: transparent;
            border: 0px solid #2d4186;
            padding-left: 0px;
        }

        .xl_bordernone:focus {
            border: 0px solid #2d4186;
        }
        .cls_trial .breadcrumb-area {
            padding: 130px 0 10px !important;
        }
    </style>
</head>
@php
    $trial = auth()->guest() ? ['status' => 0] : trial_checker();
@endphp
<body <?= $trial['status'] != 0 ? 'class="cls_trial"' : '' ?> >
    @include('common.header')

    @yield('content')

    @include('common.footer')
    @include('common.scripts')
</body>

</html>