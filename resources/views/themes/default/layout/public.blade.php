<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('seo_title',Setting()->get('website_name'))</title>
    <meta name="keywords" content="@yield('seo_keyword',parse_seo_template('seo_index_keyword','default'))" />
    <meta name="description" content="@yield('seo_description',parse_seo_template('seo_index_description','default'))" />
    <meta name="author" content="Tipask Team" />
    <meta name="copyright" content="2018 tipask.com" />
    {!! Setting()->get('website_header') !!}
    <!-- Bootstrap -->
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/default/global.css')}}?v={{ config('tipask.release') }}" rel="stylesheet" />
    <link href="{{ asset('/css/default/skins/'.config('tipask.skin').'.css')}}?v={{ config('tipask.release') }}" rel="stylesheet" />
@yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="global-nav mb-50">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container nav">
            <div class="visible-xs header-response">
                <a href="{{ route('auth.search.show') }}" style="display:block"><i class="fa fa-search" aria-hidden="true"></i></a>
                <div class="m-header-logo m-header-logo-response"><h1><a href="/" style="height:34px; background-size: auto 44px;"></a></h1></div>
                @if(Auth()->check())
                    <a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}" class="pull-right login-btn"><i class="fa fa-user" aria-hidden="true"></i></a>
                @else
                    <a href="{{ route('auth.user.login') }}" class="pull-right login-btn"><i class="fa fa-user" aria-hidden="true"></i></a>
                @endif
                <div class="bottom-nav">
                    <div class="opts">
                        <a class="opts-group @if(request()->route()->getName() == 'auth.doing.index') active @endif" href="{{ route('auth.doing.index') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>发现</span></a>
                        <a class="opts-group @if(request()->route()->getName() == 'website.ask') active @endif" href="{{ route('website.ask') }}"><i class="fa fa-question-circle" aria-hidden="true"></i><span>问答</span></a>
                        <div class="opts-group">
                            <div class="btn-group dropup">
                                <i class="fa fa-plus dropdown hoverDropdown" data-toggle="dropdown" aria-hidden="true" aria-expanded="false"><span>发起</span></i>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('ask.question.create') }}">提问</a></li>
                                    <li><a href="{{ route('blog.article.create') }}">文章</a></li>
                                </ul>
                            </div>
                        </div>
                        <a class="opts-group @if(request()->route()->getName() == 'website.blog') active @endif" href="{{ route('website.blog') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>文章</span></a>
                        <div class="opts-group">
                            <div class="btn-group dropup">
                                <i class="fa fa-bars dropdown hoverDropdown" data-toggle="dropdown" aria-hidden="true" aria-expanded="false"><span>更多</span></i>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('website.experts') }}">专家</a></li>
                                    <li><a href="{{ route('website.topic') }}">话题</a></li>
                                    <li><a href="{{ route('auth.top.coins') }}">财富榜</a></li>
                                    <li><a href="{{ route('website.shop') }}">商城</a></li>
                                    @if(Auth()->check())
                                    <li><a href="{{ route('auth.user.logout') }}">退出</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-sm-8 col-md-9 col-lg-9">
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
                        <ul class="nav navbar-nav">
                            <li @if(request()->route()->getName() == 'website.index') class="active" @endif><a href="{{ route('website.index') }}">首页 <span class="sr-only">(current)</span></a></li>
                            @if(Auth()->check())
                                <li @if(request()->route()->getName() == 'auth.doing.index') class="active" @endif><a href="{{ route('auth.doing.index') }}">发现</a></li>
                            @endif
                            <li @if(request()->route()->getName() == 'website.ask') class="active" @endif><a href="{{ route('website.ask') }}">问答</a></li>
                            <li @if(request()->route()->getName() == 'website.blog') class="active" @endif><a href="{{ route('website.blog') }}">文章</a></li>
                            <li @if(request()->route()->getName() == 'website.topic') class="active" @endif><a href="{{ route('website.topic') }}">话题</a></li>
                            <li @if(request()->route()->getName() == 'website.shop') class="active" @endif><a href="{{ route('website.shop') }}">商城</a></li>
                        </ul>
                        <form role="search" id="top-search-form" action="{{ route('auth.search.index') }}" method="GET" class="navbar-form hidden-sm hidden-xs pull-right">
                            <span class="btn btn-link"><span class="sr-only">搜索</span><span class="glyphicon glyphicon-search"></span></span>
                            <input type="text" name="word" id="searchBox" class="form-control" placeholder="{{ Setting()->get('search_placeholder','') }}" />
                        </form>
                </div>
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3 text-right">
                    @if ( Auth()->guest() )
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ route('auth.user.login') }}">登录</a></li>
                            <li><a href="{{ route('auth.user.register') }}">注册</a></li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav user-menu navbar-right">
                            <li><a href="{{ route('auth.notification.index') }}" class="active" id="unread_notifications"><span class="fa fa-bell-o fa-lg"></span></a></li>
                            <li><a href="{{ route('auth.message.index') }}" class="active" id="unread_messages"><i class="fa fa-envelope-o fa-lg"></i></a></li>
                            <li class="dropdown user-avatar">
                                <a href="{{ route('auth.profile.base') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img class="avatar-32 mr-5" alt="{{ Auth()->user()->name }}" src="{{ get_user_avatar(Auth()->user()->id,'middle','jpg',true) }}" >
                                    <span>{{ Auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                        @can('admin.login')
                                        <li><a href="{{ route('admin.index.index') }}">系统设置</a></li>
                                        <li class="divider"></li>
                                        @endif
                                        <li><a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}">我的主页</a></li>
                                        @if(config('pay.open'))
                                            <li><a href="{{ route('auth.profile.charge') }}">金币管理</a></li>
                                        @endif
                                        <li><a href="{{ route('auth.notification.index') }}">我的私信</a></li>
                                        <li><a href="{{ route('auth.profile.base') }}">账号设置</a></li>
                                        <li><a href="{{ route('auth.draft.index') }}">草稿箱</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('auth.user.logout') }}">退出</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </div>
                </div>
        </div>
    </nav>
</div>
<div class="top-alert mt-60 clearfix text-center">
    <!--[if lt IE 9]>
    <div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，放学别走，升级完浏览器再说
        <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a>
    </div>
    <![endif]-->

    @if ( session('message') )
        <div class="alert @if(session('message_type')===1) alert-danger @else alert-success @endif alert-dismissible" role="alert" id="alert_message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('message') }}
        </div>
    @endif


    @if(Auth()->check() && Auth()->user()->status === 0)
        @if(Auth()->user()->created_at->diffInMinutes() < 5)
            <div class="alert alert-success" role="alert">
                一封注册验证邮件已经发到您的邮箱 {{ Auth()->user()->email }} ，请前往邮箱完成注册.<a href="javascript:void(0);" class="send-mail btn btn-default btn-xs ml-5" onclick="$('#email_validate').modal('show');">遇到问题 <i class="fa fa-question"></i></a>
                <button type="button" class="close"></button>
            </div>
        @else
            <div class="alert alert-warning topframe" role="alert">
                你的邮箱 {{ Auth()->user()->email }} 尚未验证，部分功能将无法使用 <a href="javascript:void(0);" class="send-mail btn btn-default btn-xs ml-5" onclick="$('#email_validate').modal('show');">遇到问题 <i class="fa fa-question"></i></a>
                <button type="button" class="close"></button>
            </div>
        @endif
    @endif
</div>

<div class="wrap">
    @yield('jumbotron')
    @yield('container')
    <div class="container">
        @yield('content')
    </div>
</div>



<footer id="footer">
    <div class="container">
        @if(request()->route()->getName() == 'website.index')
        <ul class="list-unstyled list-inline">
            <li>友情链接</li>
            @foreach($friendshipLinks as $link)
            <li><a target="_blank" href="{{ $link->url }}" title="{{ $link->slogan }}">{{ $link->name }}</a></li>
            @endforeach
        </ul>
        @endif
        <div class="text-center">
            <a href="{{ route('website.index') }}">{{ Setting()->get('website_name') }}</a><span class="span-line">|</span>
            <a href="mailto:{{ Setting()->get('website_admin_email') }}" target="_blank">联系我们</a><span class="span-line">|</span>
            @if( Setting()->get('website_icp') )
            <a href="http://www.miibeian.gov.cn" target="_blank">{{ Setting()->get('website_icp') }}</a><span class="span-line">|</span>
            @endif
            <a href="{{ route('website.sitemap') }}">sitemap</a>
        </div>
        <div class="copyright mt-10">
            Powered By <a href="http://www.tipask.com" target="_blank">{{ Config('tipask.version') }}</a> Release {{ config('tipask.release') }} ©2009-{{ gmdate('Y') }} tipask.com
        </div>
    </div>
</footer>
@if(Auth()->check() && Auth()->user()->status===0)
    <div id="email_validate" class="modal in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">请激活邮箱</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="alert alert-warning">
                        为了正常使用提问、回答、撰写文章等功能，请验证你的邮箱、激活账号
                    </div>
                    <div class="mt-30 mb-30">
                        <span class="text-muted activate-label pull-left">你的注册邮箱：</span>
                    <span>
                        <strong class="h4 session-mail">{{ Auth()->user()->email }}</strong>
                        <a href="{{ route('auth.profile.email') }}" class="ml-10">修改</a>
                    </span>
                    </div>
                    <p class="text-muted">
                        如果你没收到激活邮件，请注意检查垃圾箱，或者
                        <a href="javascript:void(0);" class="send-email-token">重新发送激活邮件</a>
                    </p>
                    <div class="send-email-tips" style="display: none">
                        <div class="alert alert-success">一封验证邮件已经发送至 <strong>{{ Auth()->user()->email }}</strong>，请登录邮箱根据提示完成操作</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


<div class="modal fade" id="sendTo_message_model" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">发送私信</h4>
            </div>
            <div class="modal-body">
                <form name="messageForm" id="sendTo_message_form">
                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="to_user_id" name="to_user_id" value="0" />
                    <div class="form-group">
                        <label for="to_user_name" class="control-label">发给:</label>
                        <span id="to_user_name"></span>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">内容:</label>
                        <textarea class="form-control" id="message-text" name="content"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="sendTo_submit">发送</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    var is_login = Boolean("{{ Auth()->check() }}");
</script>
<script src="{{ asset('js/global.js') }}?v={{ config('tipask.release') }}"></script>
@yield('script')

{!! Setting()->get('website_footer') !!}

</body>
</html>