@extends('theme::layout.account')

@section('seo_title')忘记密码@endsection

@section('content')
    <div class="header text-center">
        <h1>
            <a href="{{ route('website.index') }}" class="logo">
                <img src="{{ asset('/css/default/login-logo.png') }}" alt="{{ Setting()->get('website_name') }}">
            </a>
        </h1>
        <p class="description text-muted">{{ Setting()->get('register_title','欢迎加入Tipask问答社区') }}</p>
    </div>

    <div class="col-md-6 col-md-offset-3 bg-white login-wrap" id="success">
        <h1 class="h4 text-center login-title mb-20">选择密码找回方式</h1>
        @if(config('services.sms_open'))
        <p class="mt-20"><a href="{{ route('auth.user.findByMobile') }}" class="btn btn-success btn-lg btn-block">通过手机号找回</a></p>
        @endif
        <p class="mt-20"><a href="{{ route('auth.user.findByEmail') }}" class="btn btn-default btn-lg btn-block">通过邮箱找回</a></p>
    </div>
    <div class="text-center col-md-12 login-link">
        <a href="{{ route('auth.user.register') }}">注册新账号</a>
        |
        <a href="{{ route('website.index') }}">首页</a>
        |
        <a href="{{ route('auth.user.forgetPassword') }}">找回密码</a>
    </div>
@endsection



