
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="MyWishList">
        <meta property="og:description" content="Создай свой список желаний и они обязательно сбудутся">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{asset('/img/twitter.png')}}">
        <meta property="og:image:width" content="400">
        <meta property="og:image:hight" content="300">
	<meta property="og:url" content="http://my-wishlist.ru/">
	<meta property="og:locale" content="ru_RU" />


        <meta name="twitter:site" content="@bobross">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="MyWishList">
        <meta name="twitter:description" content="Создай свой список желаний и они обязательно сбудутся">
        <meta name="twitter:image" content="{{asset('/img/twitter.png')}}">
        <meta name="twitter:url" content="http://my-wishlist.ru/">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=raleway:400,300,500,600,700,800,900,100,200&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

       <meta name="google-site-verification" content="PLyD9sJtBzMQwVbaXt0QspRu7n4tSyharXhGXbALp1k" />
       <meta name="yandex-verification" content="6e05c28d5bddf5f7" />

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
