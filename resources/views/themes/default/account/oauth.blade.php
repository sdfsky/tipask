@extends('theme::layout.account')

@section('seo')
    <title>完善资料 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="header text-center">
        <h1>
            <a href="/" class="logo">
                <img src="{{ asset('/css/default/login-logo.png') }}" alt="{{ Setting()->get('website_name') }}">
            </a>
        </h1>
        <p class="description text-muted">{{ Setting()->get('register_title','欢迎加入Tipask问答社区') }}</p>
    </div>


        <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
            <h1 class="h4 text-center text-muted login-title">完善资料</h1>
            <form role="form" name="loginForm" action="{{ route('auth.oauth.register') }}"  method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="auth_id" value="{{ $oauthUser['id'] }}">

                <div class="form-group @if ($errors->first('email')) has-error @endif">
                    <label class="required">邮箱</label>
                    <input type="text" class="form-control" name="email" required placeholder="邮箱" value="{{ old('email') }}">
                    @if ($errors->first('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->first('name')) has-error @endif">
                    <label class="required">用户名</label>
                    <input type="text" class="form-control" name="name" required placeholder="用户名" value="{{ old('name',$oauthUser['nickname']) }}">
                    @if ($errors->first('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">提 交</button>
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



