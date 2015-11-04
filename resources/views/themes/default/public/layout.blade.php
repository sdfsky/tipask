<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tipask问答系统</title>
    <!-- Bootstrap -->
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/static/js/scojs/sco.message.css') }}" rel="stylesheet" type="text/css" />
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
                <div class="logo"><a class="navbar-brand logo" href="{{ route('website.index') }}"></a></div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" role="search">
                    <div class="input-group">
                        <input type="text" id="searchBox" class="form-control" placeholder="请输入关键词搜索" />
                        <span class="input-group-addon btn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    </div>
                </form>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('website.index') }}">首页 <span class="sr-only">(current)</span></a></li>
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
                        <li><a href="{{ route('auth.user.login') }}">登录</a></li>
                        <li><a href="{{ route('auth.user.register') }}">注册</a></li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown  user-menu">
                            <a href="/profile/index" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="user-avatar" alt="宋登峰" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_small'])}}" >
                                <span>宋登峰</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @permission('admin.index.index')
                                <li><a href="{{ route('admin.index.index') }}">系统设置</a></li>
                                @endpermission
                                <li><a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}">我的主页</a></li>
                                <li><a href="{{ url('profile/base') }}">账号设置</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('auth.user.logout') }}">退出</a></li>
                            </ul>
                        </li>

                    </ul>
                @endif
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<div class="clearfix"></div>
@yield('space_header')
<div class="wrap">
    @yield('container')
    <div class="container">
        @yield('content')
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="row hidden-xs">
            <dl class="col-sm-2 site-link">
                <dt>网站相关</dt>
                <dd><a href="/about">关于我们</a></dd>
                <dd><a href="/tos">服务条款</a></dd>
                <dd><a href="/faq">帮助中心</a></dd>
                <dd><a href="/repu">声望与权限</a></dd>
                <dd><a href="/markdown">编辑器语法</a></dd>
                <dd><a href="http://weekly.segmentfault.com/">每周精选</a></dd>
                <dd><a href="/app">App 下载</a></dd>
            </dl>
            <dl class="col-sm-2 site-link">
                <dt>联系合作</dt>
                <dd><a href="/contact">联系我们</a></dd>
                <dd><a href="/hiring">加入我们</a></dd>
                <dd><a href="/link">合作伙伴</a></dd>
                <dd><a href="/press">媒体报道</a></dd>
                <dd><a href="http://0x.segmentfault.com">建议反馈</a></dd>
                <dd><a href="http://pan.baidu.com/share/link?shareid=604288&amp;uk=839272106" target="_blank">Logo 下载</a></dd>
            </dl>
            <dl class="col-sm-2 site-link">
                <dt>常用链接</dt>
                <dd><a href="http://mirrors.segmentfault.com/" target="_blank">文档镜像</a></dd>
                <dd>订阅：<a href="/feeds">问答</a> / <a href="/feeds/blogs">文章</a></dd>
                <dd><a href="http://segmentfault.com/events?category=4">黑客马拉松</a></dd>
                <!--             <dd><a href="http://zs.segmentfault.com/" target="_blank">一起涨姿势</a></dd> -->
                <dd><a href="http://namebeta.com/" target="_blank">域名搜索注册</a></dd>
            </dl>
            <dl class="col-sm-2 site-link">
                <dt>关注我们</dt>
                <dd><a href="http://twitter.com/segment_fault" target="_blank">Twitter</a></dd>
                <!-- <dd><a href="http://page.renren.com/699146294" target="_blank">人人网</a></dd> -->
                <dd><a href="https://www.linkedin.com/company/segmentfault" target="_blank">LinkedIn</a></dd>
                <dd><a href="http://weibo.com/segmentfault" target="_blank">新浪微博</a></dd>
                <dd><a href="http://i.youku.com/segmentfault" target="_blank">优酷主页</a></dd>
                <dd><a href="/giveaways" target="_blank">开发者福利</a></dd>
                <dd><a href="/blog/segmentfault" target="_blank">开发日志</a></dd>
            </dl>
            <dl class="col-sm-4 site-link" id="license">
                <dt>内容许可</dt>
                <dd>除特别说明外，用户内容均采用 <a rel="license" target="_blank" href="http://creativecommons.org/licenses/by-sa/3.0/cn/">知识共享署名-相同方式共享 3.0 中国大陆许可协议</a> 进行许可</dd>
                <dd>本站由 <a target="_blank" href="http://qingcloud.com/">青云 QingCloud</a> 提供云计算服务<br><a target="_blank" href="https://www.upyun.com/?utm_source=segmentfault&amp;utm_medium=link&amp;utm_campaign=upyun&amp;md=segmentfault">又拍云</a> 提供 CDN 存储服务</dd>

            </dl>
        </div>
        <div class="copyright">
            Copyright © 2011-2015 SegmentFault. 当前呈现版本 <a href="http://status.segmentfault.com/">14.11.22</a><br><a href="http://www.miibeian.gov.cn/" rel="nofollow">浙 ICP 备 15005796 号 - 2</a>
        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/static/js/scojs/sco.message.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/global.js') }}"></script>
@yield('script')

@if ( session('message') )
    <script type="text/javascript">
        $(function(){
            $.scojs_message('{{ session('message') }}',{{ session('message_type') }});
        });
    </script>
@endif

</body>
</html>