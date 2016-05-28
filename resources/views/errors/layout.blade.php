<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="author" content="Tipask Team" />
    <meta name="copyright" content="2016 tipask.com" />
    {!! Setting()->get('website_header') !!}
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <style>
        /* Error Page Inline Styles */
        body {
            padding-top: 50px;
        }
        /* Layout */
        .jumbotron {
            font-size: 21px;
            font-weight: 200;
            line-height: 2.1428571435;
            color: inherit;
            padding: 10px 0px;
        }
        /* Everything but the jumbotron gets side spacing for mobile-first views */
        .masthead, .body-content, {
            padding-left: 15px;
            padding-right: 15px;
        }
        /* Main marketing message and sign up button */
        .jumbotron {
            text-align: center;
            background-color: transparent;
        }
        /* Colors */
        .green {color:#5cb85c;}
        .orange {color:#f0ad4e;}
        .red {color:#d9534f;}
    </style>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="jumbotron">
        @yield('content')
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>
{!! Setting()->get('website_footer') !!}

</body>
</html>