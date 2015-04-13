@extends('theme::account.layout');

@section('seo')
    <title>用户注册</title>
@stop

@section('content')
    <div class="header text-center">
        <h1>
            <a href="/" class="logo">
                <img src="//sf-static.b0.upaiyun.com/global/img/logo-b.f7391d73.svg" alt="SegmentFault">
            </a>
        </h1>
        <p class="description text-muted">欢迎加入最专业的中文开发者社区</p>
    </div>
    <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
        <h1 class="h4 text-center text-muted login-title">创建新账号</h1>
        <form role="form" id="user">
            <input type="hidden" name="ref" value="">
            <div class="form-group">
                <label class="required">用户名</label>
                <input type="text" class="form-control" name="name" required="" placeholder="字母、数字等，用户名唯一">
            </div>
            <div class="form-group">
                <label class="required">Email</label>
                <input type="email" class="form-control" name="mail" required="" placeholder="hello@segmentfault.com">
            </div>
            <div class="form-group">
                <label for="" class="required">密码</label>
                <input type="password" class="form-control" name="password" required="" placeholder="不少于 6 位">
            </div>
            <div class="form-group" style="display: none;">
                <label class="required">验证码</label>
                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="请输入下方的验证码">
                <div class="mt10"><a id="reloadCaptcha" href="javascript:void(0)"><img src="/user/captcha?w=240&amp;h=50" width="240" height="50"></a></div>
            </div>
            <div class="form-group">
                同意并接受<a href="/tos" target="_blank">《服务条款》</a>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">注册</button>
            </div>
        </form>
    </div>

    <div class="hide col-md-6 col-md-offset-3 bg-white login-wrap" id="success">
        <h1 class="h4 text-center login-title mb20">注册成功</h1>
        <p class="mb20">感谢你注册 SegmentFault，我们发送了一封验证邮件到你的邮箱：<a id="successMail"></a>，请及时激活（1 小时内有效）。</p>
        <div class="text-center">
            <a href="javascript:void(0);" id="successGotoMail" class="btn btn-lg btn-primary mr10">前往邮箱</a>
            <a href="javascript:void(0);" id="successBack" class="btn btn-lg btn-default">回到之前页面</a>
        </div>
    </div>

    <div class="text-center col-md-12 login-link">
        <a href="{{ route('login') }}">用户登录</a>
        |
        <a href="{{ route('url') }}">首页</a>
        |
        <a href="{{ route('forgetPassword') }}">找回密码</a>
    </div>
@endsection



