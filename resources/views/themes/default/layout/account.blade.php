<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('seo_title') - {{ Setting()->get('website_name') }} </title>
    <meta name="keywords" content="@yield('seo_title',parse_seo_template('seo_index_keyword','default'))" />
    <meta name="description" content="@yield('seo_title',parse_seo_template('seo_index_description','default'))" />
    <!-- Bootstrap -->
        <link href="{{ asset('static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/default/account.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
<div class="container">
    @yield('content')
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('static/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
</body>
</html>