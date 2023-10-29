<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=raleway:400,300,500,600,700,800,900,100,200&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>

    <!--Scripts-->

{{--    <script src="{{asset('/plugins/jquery.min.js')}}"></script>--}}
{{--    <script src="{{asset('/plugins/jquery.easing.min.js')}}"></script>--}}
{{--    <script src="{{asset('/plugins/modernizr.custom.42534.js')}}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('/plugins/jquery.waitforimages.js')}}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('/plugins/typed.js')}}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('/plugins/masonry.pkgd.min.js')}}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('/plugins/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('/plugins/jquery.jkit.1.2.16.min.js')}}"></script>--}}

{{--    <script src="{{asset('/plugins/script.js')}}" type="text/javascript"></script>--}}


</html>
