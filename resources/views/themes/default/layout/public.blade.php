<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Setting()->get('website_name') }}</title>
    <!-- Bootstrap -->
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/default/global.css')}}" rel="stylesheet" />
    @yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--[if lt IE 9]>
<div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，放学别走，升级完浏览器再说
    <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a>
</div>
<![endif]-->
<div class="top-common-nav">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#global-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo"><a class="navbar-brand logo" href="{{ route('website.index') }}"></a></div>
            </div>

            <div class="collapse navbar-collapse" id="global-navbar">
                <form class="navbar-form navbar-left" role="search" id="top-search-form" action="{{ route('auth.search.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="word" id="searchBox" class="form-control" placeholder="请输入关键词搜索" />
                        <span class="input-group-addon btn" ><span id="search-button" class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    </div>
                </form>
                <ul class="nav navbar-nav">
                    <li @if(request()->route()->getName() == 'website.index') class="active" @endif><a href="{{ route('website.index') }}">首页 <span class="sr-only">(current)</span></a></li>
                    <li @if(request()->route()->getName() == 'website.ask') class="active" @endif><a href="{{ route('website.ask') }}">问答</a></li>
                    <li @if(request()->route()->getName() == 'website.blog') class="active" @endif><a href="{{ route('website.blog') }}">文章</a></li>
                    <li @if(request()->route()->getName() == 'website.topic') class="active" @endif><a href="{{ route('website.topic') }}">话题</a></li>
                </ul>
                @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('auth.user.login') }}">登录</a></li>
                        <li><a href="{{ route('auth.user.register') }}">注册</a></li>
                    </ul>
                @else
                    <ul class="nav navbar-nav user-menu navbar-right">
                        <li class="dropdown user-avatar">
                            <a href="{{ route('auth.profile.base') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="avatar-32 mr-5" alt="{{ Auth()->user()->name }}" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_middle'])}}" >
                                <span>{{ Auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @permission('admin.index.index')
                                <li><a href="{{ route('admin.index.index') }}">系统设置</a></li>
                                <li class="divider"></li>
                                @endpermission

                                <li><a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}">我的主页</a></li>
                                <li><a href="{{ route('auth.notification.index') }}">我的通知 <span class="badge badge">4</span></a></li>
                                <li><a href="{{ route('auth.notification.index') }}">我的私信</a></li>
                                <li><a href="{{ route('auth.profile.base') }}">账号设置</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('auth.user.logout') }}">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
                <div class="pull-right mr-10">
                    <a class="btn navbar-btn btn-primary " href="{{ route('ask.question.create') }}">我要提问</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="clearfix"></div>
@yield('space_header')
<div class="wrap mt-60">
    @yield('container')
    <div class="container">
        @if ( session('message') )
        <div class="alert @if(session('message_type')==1) alert-danger @else alert-error @endif alert-dismissible" role="alert" id="alert_message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             {{ session('message') }}
        </div>
        @endif
        @yield('content')
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="copyright">
            Copyright © 2011-2015 SegmentFault. 当前呈现版本 <a href="http://status.segmentfault.com/">14.11.22</a><br><a href="http://www.miibeian.gov.cn/" rel="nofollow">{{ Setting()->get('website_icp') }}</a>
            <p class="text-muted small">Powered by Tipask v2.5 ©2009-2014 tipask.com，Processed in 0.010798 second(s), 1 queries.</p>

        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
@yield('script')

</body>
</html>