<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.styles')
    <title>@yield('title') &#8211; {{ get_section_content('project', 'site_title') }}</title>
</head>
<body>
    @include('common.header')

    @yield('content')

    @include('common.footer')
    @include('common.scripts')
</body>
</html>