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
                    <label class="required">邮箱</label>
                    <input type="text" class="form-control" name="email" required placeholder="注册邮箱" value="{{ old('email') }}">
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
                <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                    <label for="captcha" class="required">验证码</label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required="" placeholder="请输入下方的验证码">
                    @if ($errors->first('captcha'))
                        <span class="help-block">{{ $errors->first('captcha') }}</span>
                    @endif
                    <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                </div>
                @endif
            <div class="form-group clearfix">
                <div class="checkbox pull-left">
                    <label><input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                </div>
                <button type="submit" class="btn btn-primary pull-right pl20 pr20">登录</button>
            </div>
            @if(Setting()->get('oauth_open') == 1)
            <hr />
            <div class="widget-login mt-30">
                <p class="text-muted mt-5 mr-10 pull-left hidden-xs">快速登录</p>
                <a href="{{ route('auth.oauth.login',['type'=>'weibo']) }}" class="btn btn-default btn-sm btn-sn-weibo" ><span class="icon-sn-bg-weibo"></span> <strong class="visible-xs-inline">新浪微博账号</strong></a>
                <a href="{{ route('auth.oauth.login',['type'=>'qq']) }}" class="btn btn-default btn-sm btn-sn-qq" ><span class="icon-sn-bg-qq"></span> <strong class="visible-xs-inline">QQ 账号</strong></a>
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



