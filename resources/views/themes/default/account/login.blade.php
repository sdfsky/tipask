@extends('theme::layout.account')

@section('seo')
    <title>用户登录 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="header text-center">
        <h1>
            <a href="/" class="logo">
                <img src="{{ asset('/css/default/login-logo.png') }}" alt="SegmentFault">
            </a>
        </h1>
        <p class="description text-muted">欢迎加入最专业站长问答社区</p>
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

            <div class="form-group clearfix">
                <div class="checkbox pull-left">
                    <label><input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                </div>
                <button type="submit" class="btn btn-primary pull-right pl20 pr20">登录</button>
            </div>
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



