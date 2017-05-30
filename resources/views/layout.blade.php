<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">

        <title>@yield('title')</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('navbar')

        @yield('content')

        @include('footer')

        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/helper.js') }}"></script>

        @yield('js-content')
        
    </body>
</html>
