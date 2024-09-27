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

</head>
<body>
    @include('common.header')

    @yield('content')

    @include('common.footer')
    @include('common.scripts')
</body>
</html>