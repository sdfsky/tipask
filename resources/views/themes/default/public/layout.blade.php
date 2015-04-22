<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tipask问答系统</title>

    <!-- Bootstrap -->
    <link href="{{ asset('/css/default/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/default/common.css')}}" rel="stylesheet">
    @yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="logo"><a class="navbar-brand logo" href="{{ route('url') }}"></a></div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" role="search">
                <div class="input-group">

                    <span class="input-group-addon btn" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    <input type="text" class="form-control" placeholder="请输入关键词搜索" />
                </div>
            </form>
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('url') }}">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">问答</a></li>
                <li><a href="#">文章</a></li>
                <li><a href="#">讨论</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">更多 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">商城</a></li>
                        <li><a href="#">标签库</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            @if (Auth::guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="/profile/index" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @role('admin')
                            <li><a href="{{ url('admin') }}">系统设置</a></li>
                            @endrole
                            <li><a href="{{ url('profile/index') }}">我的主页</a></li>
                            <li><a href="#">账号设置</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出</a></li>
                        </ul>
                    </li>

                </ul>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="wrap">
    <div class="container">
        @yield('content')
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="copyright">
            Copyright © 2011-2015 SegmentFault. 当前呈现版本 <a href="http://status.segmentfault.com/">14.11.22</a><br><a href="http://www.miibeian.gov.cn/" rel="nofollow">浙 ICP 备 15005796 号 - 2</a>
        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('css/default/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
</body>
</html>