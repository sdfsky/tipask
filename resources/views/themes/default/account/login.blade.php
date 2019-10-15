@extends('theme::layout.account')

@section('seo_title')用户登录@endsection

@section('content')
    <div class="header text-center">
        <h1>
            <a href="{{ route('website.index') }}" class="logo">
                <img src="{{ asset('/css/default/login-logo.png') }}" alt="{{ Setting()->get('website_name') }}">
            </a>
        </h1>
        <p class="description text-muted">{{ Setting()->get('register_title','欢迎加入Tipask问答社区') }}</p>
    </div>
    <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
        @if ( session('message') )
            <div class="alert @if(session('message_type')===1) alert-danger @else alert-success @endif alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('message') }}
            </div>
        @endif
        <h1 class="h4 text-center text-muted login-title">用户登录</h1>
        <form role="form" name="loginForm" action="{{ route('auth.user.login') }}"  method="POST" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if ($errors->first('email')) has-error @endif">
                    <label class="required">账户</label>
                    <input type="text" class="form-control" name="email" required placeholder="邮箱或手机号" value="{{ old('email') }}">
                    @if ($errors->first('email'))
                     <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

               <div class="form-group @if ($errors->first('password')) has-error @endif">
                    <label for="" class="required">密码</label>
                    <input type="password" class="form-control" name="password" required placeholder="不少于 6 位">
                    @if ($errors->first('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            @if(Setting()->get('code_login') == 1)
                @include('theme::layout.auth_captcha')
            @endif
            <div class="form-group clearfix">
                <div class="checkbox pull-left">
                    <label><input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                </div>
                <button type="submit" class="btn btn-primary pull-right pl20 pr20">登录</button>
            </div>
            @if(config('services.oauth_open'))
            <hr />
            <div class="widget-login mt-30">
                <p class="text-muted mt-5 mr-10 pull-left hidden-xs">快速登录</p>
                @if(config('services.weixin.open'))
                    <a href="{{ route('auth.oauth.login',['type'=>'weixin']) }}" class="btn btn-default btn-sm btn-sn-weixin hidden-lg" ><span class="icon-sn-bg-weixin"></span> <strong class="visible-xs-inline">微信账号</strong></a>
                @endif
                @if(config('services.weixinweb.open'))
                    <a href="{{ route('auth.oauth.login',['type'=>'weixinweb']) }}" class="btn btn-default btn-sm btn-sn-weixin hidden-xs" ><span class="icon-sn-bg-weixin"></span> <strong class="visible-xs-inline">微信扫码</strong></a>
                @endif
                @if(config('services.qq.open'))
                    <a href="{{ route('auth.oauth.login',['type'=>'qq']) }}" class="btn btn-default btn-sm btn-sn-qq" ><span class="icon-sn-bg-qq"></span> <strong class="visible-xs-inline">QQ 账号</strong></a>
                @endif
                @if(config('services.weibo.open'))
                    <a href="{{ route('auth.oauth.login',['type'=>'weibo']) }}" class="btn btn-default btn-sm btn-sn-weibo" ><span class="icon-sn-bg-weibo"></span> <strong class="visible-xs-inline">新浪微博账号</strong></a>
                @endif
            </div>
            @endif
        </form>
    </div>

    <div class="text-center col-md-12 login-link">
        <a href="{{ route('auth.user.register') }}">注册新账号</a>
        |
        <a href="{{ route('website.index') }}">首页</a>
        |
        <a href="{{ route('auth.user.forgetPassword') }}">找回密码</a>
    </div>
@endsection



