@extends('theme::layout.account')

@section('seo_title')找回密码@endsection

@section('content')
    <div class="header text-center">
        <h1>
            <a href="{{ route('website.index') }}" class="logo">
                <img src="{{ asset('/css/default/login-logo.png') }}" alt="{{ Setting()->get('website_name') }}">
            </a>
        </h1>
        <p class="description text-muted">{{ Setting()->get('register_title','欢迎加入Tipask问答社区') }}</p>
    </div>

    @if(isset($success))
    <div class="col-md-6 col-md-offset-3 bg-white login-wrap" id="success">
        <h1 class="h4 text-center login-title mb-20">找回密码成功</h1>
        <p class="mb-20">感谢你使用 {{ Setting()->get('website_name') }}，我们发送了一封邮件到你的邮箱：<strong>{{ $email }}</strong>，请及时查看（1 小时内有效）。</p>
        <div class="text-center">
            <a href="{{ route('website.index') }}" class="btn btn-lg btn-default">回到首页</a>
        </div>
    </div>
    @else
        <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
            <h1 class="h4 text-center text-muted login-title">找回密码</h1>
            <form role="form" name="loginForm" action="{{ route('auth.user.forgetPassword') }}"  method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if ($errors->first('email')) has-error @endif">
                    <label class="required">邮箱</label>
                    <input type="text" class="form-control" name="email" required placeholder="注册邮箱" value="{{ old('email') }}">
                    @if ($errors->first('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                    <label for="captcha" class="required">验证码</label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required="" placeholder="请输入下方的验证码">
                    @if ($errors->first('captcha'))
                        <span class="help-block">{{ $errors->first('captcha') }}</span>
                    @endif
                    <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">提 交</button>
                </div>
            </form>
        </div>
    @endif


    <div class="text-center col-md-12 login-link">
        <a href="{{ route('auth.user.register') }}">注册新账号</a>
        |
        <a href="{{ route('website.index') }}">首页</a>
        |
        <a href="{{ route('auth.user.forgetPassword') }}">找回密码</a>
    </div>
@endsection



