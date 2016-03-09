@extends('theme::layout.public')

@section('seo')
    <title>修改手机 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">修改手机</h2>
            <div class="row mt30">
                <div class="col-md-8">
                    <form name="baseForm" id="base_form" action="{{ route('auth.profile.mobile')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group @if ($errors->first('mobile')) has-error @endif">
                            <label for="mobile" class="required control-label col-sm-3">手机号码</label>
                            <div class="col-sm-6">
                                <input name="email" id="email" type="text" maxlength="15" placeholder="请填写11位手机号码"  class="form-control" value="{{ old('mobile',Auth()->user()->mobile) }}" />
                                @if ($errors->first('mobile'))
                                    <span class="help-block">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3"><button class="btn btn-xl btn-primary" type="button">发送验证码</button></div>
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

