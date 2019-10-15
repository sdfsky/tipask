@if( config('services.geetest_open') )
    <div class="form-group  @if ($errors->first('geetest_challenge')) has-error @endif">
        {!! Geetest::render() !!}
        <span class="help-block">{{ $errors->first('geetest_challenge') }}</span>
    </div>
@else
<div class="form-group @if ($errors->first('captcha')) has-error @endif">
    <input type="text" class="form-control" id="captcha" name="captcha" autocomplete="off" required="" placeholder="请输入下方的验证码">
    @if ($errors->first('captcha'))
        <span class="help-block">{{ $errors->first('captcha') }}</span>
    @endif
    <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
</div>
@endif