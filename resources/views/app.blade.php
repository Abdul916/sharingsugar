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

       /* .container1 {
            position: relative;
            width: 100%;
            height: 0px;
            margin-top: 5px;
            border: none !important;
        }

        input[type="range"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 100%;
            outline: none;
            position: absolute;
            margin: auto;
            top: 0;
            bottom: 0;
            background-color: transparent;
            pointer-events: none;
        }

        .slider-track {
            width: 100%;
            height: 5px;
            position: absolute;
            margin: auto;
            top: 0;
            bottom: 0;
            border-radius: 5px;
        }

        input[type="range"]::-webkit-slider-runnable-track {
            -webkit-appearance: none;
            height: 5px;
        }

        input[type="range"]::-moz-range-track {
            -moz-appearance: none;
            height: 5px;
        }

        input[type="range"]::-ms-track {
            appearance: none;
            height: 5px;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 10px;
            width: 10px;
            -webkit-box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            cursor: pointer;
            margin-top: -9px;
            pointer-events: auto;
            border-radius: 50%;
        }

        input[type="range"]::-moz-range-thumb {
            -webkit-appearance: none;
            height: 10px;
            width: 10px;
            cursor: pointer;
            border-radius: 50%;
            pointer-events: auto;
        }

        input[type="range"]::-ms-thumb {
            appearance: none;
            height: 10px;
            width: 10px;
            cursor: pointer;
            border-radius: 50%;
            -webkit-box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            pointer-events: auto;
        }

        input[type="range"]:active::-webkit-slider-thumb {
            border: 3px solid #3264fe;
        }

        .values {
            background-image: -o-linear-gradient(284deg, rgb(242, 40, 118) 0%, rgb(148, 45, 217) 100%);
            background-image: linear-gradient(166deg, rgb(242, 40, 118) 0%, rgb(148, 45, 217) 100%);
            -webkit-box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            box-shadow: 0.872px 9.962px 20px 0px rgba(12, 78, 165, 0.3);
            width: 26%;
            position: relative;
            margin: auto;
            padding: 2px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
            font-size: 16px;
            color: #ffffff;
        }*/

        .xl_bordernone {
            background: transparent;
            border: 0px solid #2d4186;
            padding-left: 0px;
        }

        .xl_bordernone:focus {
            border: 0px solid #2d4186;
        }
    </style>
</head>

<body>
    @include('common.header')

    @yield('content')

    @include('common.footer')
    @include('common.scripts')
</body>

</html>