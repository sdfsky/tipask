@extends('theme::layout.public')

@section('seo_title')修改密码 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">修改密码</h2>
            <div class="row mt-30">
                <div class="col-md-8">
                    <form name="baseForm" id="base_form" action="{{ route('auth.profile.password')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group @if ($errors->first('old_password')) has-error @endif">
                            <label for="old_password" class="required control-label col-sm-3">当前密码</label>
                            <div class="col-sm-9">
                                <input name="old_password" id="old_password" type="password" maxlength="32" placeholder="当前密码" class="form-control" value="" />
                                @if ($errors->first('old_password'))
                                    <span class="help-block">{{ $errors->first('old_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('password')) has-error @endif">
                            <label for="password" class="required control-label col-sm-3">新密码</label>
                            <div class="col-sm-9">
                                <input name="password" id="password" type="password" maxlength="32" placeholder="新密码" class="form-control" value="" />
                                @if ($errors->first('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('password_confirmation')) has-error @endif">
                            <label for="password_confirmation" class="required control-label col-sm-3">确认新密码</label>
                            <div class="col-sm-9">
                                <input name="password_confirmation" id="password_confirmation" type="password" maxlength="32" placeholder="再次输入新密码" class="form-control" value="" />
                                @if ($errors->first('password_confirmation'))
                                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                            <label for="old_password" class="required control-label col-sm-3">验证码</label>
                            <div class="col-sm-4">
                                <input name="captcha" type="text" maxlength="32" placeholder="请输入下方验证码" class="form-control" value="{{ old('captcha') }}" />
                                @if ($errors->first('captcha'))
                                    <span class="help-block">{{ $errors->first('captcha') }}</span>
                                @endif
                                <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                            </div>
                        </div>
                        <div class="form-action row">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-xl btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

