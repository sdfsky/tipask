@extends('theme::layout.account')

@section('seo_title')手机找回密码@endsection

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
        <h1 class="h4 text-center text-muted login-title">设置新密码</h1>
        <form role="form" name="loginForm" action="{{ route('auth.user.findByMobile') }}"  method="POST" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group @if ($errors->first('mobile')) has-error @endif">
                <label class="required">手机号码</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="请填写11位手机号码" />
                @if ($errors->first('mobile'))
                    <span class="help-block">{{ $errors->first('mobile') }}</span>
                @endif
            </div>

            <div class="form-group @if ($errors->first('code')) has-error @endif">
                <label for="mobile" class="required control-label">短信验证码</label>
                <div class="row">
                    <div class="col-xs-6">
                        <input name="code" id="code" type="text" maxlength="6" placeholder="收到的手机验证码"  class="form-control" value="{{ old('code','') }}" />
                        @if ($errors->first('mobile'))
                            <span class="help-block">{{ $errors->first('code') }}</span>
                        @endif
                    </div>
                    <div class="col-xs-6"><button class="btn btn-xl btn-default btn-send-code" data-mobile_id="mobile" data-send_type="findPassword"  data-toggle="modal" data-target="#verify_code_modal" type="button">发送验证码</button></div>
                </div>
            </div>
            <div class="form-group @if ($errors->first('password')) has-error @endif">
                <label class="required">新密码</label>
                <input type="text" class="form-control" name="password" required placeholder="新密码" />
                @if ($errors->first('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
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

@section('script')
    @include('theme::layout.sms_code_modal')
@endsection



