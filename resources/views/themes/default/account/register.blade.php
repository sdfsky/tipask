@extends('theme::layout.account')

@section('seo_title')用户注册@endsection

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
        <h1 class="h4 text-center text-muted login-title">创建新账号</h1>
        <form role="form" id="registerForm" action="{{ route('auth.user.register') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group @if ($errors->first('name')) has-error @endif">
                <label class="required">姓名</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required  placeholder="姓名">
                @if ($errors->first('name'))
                 <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            @if(Setting()->get('register_type') == 'mobile')
                <div class="form-group @if ($errors->first('mobile')) has-error @endif">
                    <label for="mobile" class="required control-label">手机号码</label>
                    <input name="mobile" id="mobile" type="text" maxlength="15" placeholder="请填写11位手机号码"  class="form-control" value="{{ old('mobile','') }}" />
                    @if ($errors->first('mobile'))
                        <span class="help-block">{{ $errors->first('mobile') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->first('code')) has-error @endif">
                    <label for="mobile" class="required control-label">短信验证码</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input name="code" id="code" type="text" maxlength="6" placeholder="收到的手机验证码"  class="form-control" value="{{ old('code','') }}" />
                            @if ($errors->first('code'))
                                <span class="help-block">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                        <div class="col-xs-6"><button class="btn btn-xl btn-default btn-send-code" data-mobile_id="mobile" data-send_type="register"  data-toggle="modal" data-target="#verify_code_modal" type="button">发送验证码</button></div>
                    </div>
                </div>
            @else
            <div class="form-group @if ($errors->first('email')) has-error @endif">
                <label class="required">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="hello@tipask.com">
                @if ($errors->first('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            @endif
            <div class="form-group">
                <label for="" class="required">密码</label>
                <input type="password" class="form-control" name="password" required placeholder="不少于 6 位">
            </div>
            <div class="form-group @if ($errors->first('password')) has-error @endif">
                <label for="" class="required">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation" required placeholder="不少于 6 位">
                @if ($errors->first('password'))
                 <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            @if(Setting()->get('code_register') == 1)
                @include('theme::layout.auth_captcha')
            @endif
            <div class="form-group">
                同意并接受 <a href="#" target="_blank" data-toggle="modal" data-target="#register_license_modal">《服务条款》</a>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">注册</button>
            </div>
        </form>
    </div>


    <div class="text-center col-md-12 login-link">
        <a href="{{ route('auth.user.login') }}">用户登录</a>
        |
        <a href="{{ route('website.index') }}">首页</a>
        |
        <a href="{{ route('auth.user.forgetPassword') }}">找回密码</a>
    </div>
    <div class="modal fade " id="register_license_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center">{{ Setting()->get('website_name') }}服务条款</h4>
                </div>
                <div class="modal-body">
                    <div style="height: 450px;overflow:scroll;">
                        {!! Setting()->get('register_license','') !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if(Setting()->get("register_type")=='mobile')
        @include('theme::layout.sms_code_modal')
    @endif
@endsection



