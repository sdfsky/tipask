@extends('theme::account.layout');

@section('seo')
    <title>用户登陆</title>
@stop

@section('content')
    <div class="header text-center">
        <h1>
            <a href="/" class="logo">
                <img src="//sf-static.b0.upaiyun.com/global/img/logo-b.f7391d73.svg" alt="SegmentFault">
            </a>
        </h1>
        <p class="description text-muted">欢迎加入最专业的中文开发者社区</p>
    </div>
    <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
        <h1 class="h4 text-center text-muted login-title">创建新账号</h1>
        <form role="form" name="loginForm" action="{{ route('login') }}"  method="POST" >
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

            <div class="form-group clearfix">
                <div class="checkbox pull-left">
                    <label><input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                </div>
                <button type="submit" class="btn btn-primary pull-right pl20 pr20">登录</button>
            </div>
        </form>
    </div>

    <div class="text-center col-md-12 login-link">
        <a href="{{ route('register') }}">注册新账号</a>
        |
        <a href="{{ route('url') }}">首页</a>
        |
        <a href="{{ route('forgetPassword') }}">找回密码</a>
    </div>
@endsection



