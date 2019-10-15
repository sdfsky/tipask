@extends('theme::layout.public')
@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')
        <div id="main" class="settings col-md-10 form-horizontal main">
            <h2 class="h3 post-title">修改手机</h2>
            @if(Auth()->user()->userData->mobile_status == 1)
            <div class="alert alert-success" role="alert">
                您的手机已绑定，如需修改，请按照下方提示进行操作！
            </div>
            @else
                <div class="alert alert-warning" role="alert">
                    您还未进行手机绑定，绑定后可通过手机号码登录系统.
                </div>
            @endif
            <div class="row mt30">
                <div class="col-md-8">
                    <form name="baseForm" id="base_form" action="{{ route('auth.profile.mobile')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group @if ($errors->first('mobile')) has-error @endif">
                            <label for="mobile" class="required control-label col-sm-3">手机号码</label>
                            <div class="col-sm-6">
                                <input name="mobile" id="mobile" type="text" maxlength="15" placeholder="请填写11位手机号码"  class="form-control" value="{{ old('mobile',Auth()->user()->mobile) }}" />
                                @if ($errors->first('mobile'))
                                    <span class="help-block">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('code')) has-error @endif">
                            <label for="mobile" class="required control-label col-sm-3">短信验证码</label>
                            <div class="col-sm-4">
                                <input name="code" id="code" type="text" maxlength="6" placeholder="收到的手机验证码"  class="form-control" value="{{ old('code','') }}" />
                                @if ($errors->first('mobile'))
                                    <span class="help-block">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-3"><button class="btn btn-xl btn-default btn-send-code" data-mobile_id="mobile" data-send_type="bind" data-toggle="modal" data-target="#verify_code_modal" type="button">发送验证码</button></div>
                        </div>
                        <div class="form-action row mb-30">
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
@section('script')
    @include('theme::layout.sms_code_modal')
@endsection