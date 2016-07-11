@extends('theme::layout.account')

@section('seo_title')完善资料@endsection

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
            <h1 class="h4 text-center text-muted login-title">完善资料</h1>
            <form role="form" name="loginForm" action="{{ route('auth.oauth.register') }}"  method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="auth_id" value="{{ old('auth_id' , $userOauth->id) }}">

                <div class="form-group @if ($errors->first('email')) has-error @endif">
                    <label class="required">邮箱</label>
                    <input type="text" class="form-control" name="email" required placeholder="邮箱" value="{{ old('email') }}">
                    @if ($errors->first('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->first('name')) has-error @endif">
                    <label class="required">用户名</label>
                    <input type="text" class="form-control" name="name" required placeholder="用户名" value="{{ old('name',$userOauth->nickname) }}">
                    @if ($errors->first('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    同意并接受 <a href="#" target="_blank" data-toggle="modal" data-target="#register_license_modal">《服务条款》</a>
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



