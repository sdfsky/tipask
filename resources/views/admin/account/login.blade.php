
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ Setting()->get('website_name') }}管理后台登录</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/js/scojs/sco.message.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->


</head>
<body class="login-page">
<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg">Tipask 管理后台</p>
        <form action="{{ route('admin.account.login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback @if ($errors->first('email')) has-error @endif">
                <input type="text" name="email" class="form-control" placeholder="邮箱" value="{{ Auth::user()->email }}" readonly/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback @if ($errors->first('password')) has-error @endif">
                <input type="password" name="password" class="form-control" placeholder="密码"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->first('password'))
                 <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group has-feedback @if ($errors->first('captcha')) has-error @endif">
                <input type="text" class="form-control" id="captcha" name="captcha" required="" placeholder="请输入下方的验证码">
                @if ($errors->first('captcha'))
                <span class="help-block">{{ $errors->first('captcha') }}</span>
                @endif
                <div style="margin-top: 10px;"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
           </div>
            <div class="form-group has-feedback">
                <button class="btn bg-olive btn-block btn-flat">登录</button>
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.3 -->
<script type="text/javascript" src="{{ asset('/static/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="{{ asset('/static/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/global.js') }}"></script>

</body>
</html>