<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="Tipask Team" />
  <meta name="copyright" content="2016 tipask.com" />
  <title>@yield('title')</title>
  <!-- Bootstrap -->
  <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/installer/installer.css') }}" rel="stylesheet" />
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="header text-center">
  <h1>
    <a href="http://www.tipask.com" class="logo">
      <img src="{{ asset('/css/default/logo.png') }}" height="50" alt="Tipask" />
    </a>
  </h1>
  <ol class="step">
    <li @if(request()->route()->getName() == 'website.installer.welcome') class="current" @endif><span>1</span> 欢迎使用</li>
    <li @if(request()->route()->getName() == 'website.installer.requirement') class="current" @endif><span>2</span>环境检测</li>
    <li @if(request()->route()->getName() == 'website.installer.config') class="current" @endif><span>3</span>初始化配置</li>
    <li @if(request()->route()->getName() == 'website.installer.website') class="current" @endif><span>4</span>管理员配置</li>
    <li @if(request()->route()->getName() == 'website.installer.finished') class="current" @endif><span>5</span>安装成功</li>
  </ol>
</div>
<div class="container">
  <div class="row">

    <div class="col-md-10 col-md-offset-1">
      @yield('content')
    </div>
  </div>
</div>


<footer class="main-footer text-center">
  <strong>Copyright © 2010-{{ date("Y-m-d") }} <a href="http://www.tipask.com" target="_blank">tipask.com</a>.</strong> All rights reserved.
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript"></script>
@yield('script')
</body>
</html>