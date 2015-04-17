@extends('theme::public.layout')

@section('css')


@endsection

@section('content')
<div class="row">
    <div id="secondary" class="col-md-2">
        <nav class="list-group mt30">
            <a href="/user/settings" class="list-group-item active">个人资料</a>
            <a href="/user/settings?tab=record" class="list-group-item">工作教育经历</a>
            <a href="/user/settings?tab=mail" class="list-group-item">Email 地址</a>
            <a href="/user/settings?tab=password" class="list-group-item">密码修改</a>
            <a href="/user/settings?tab=oauth" class="list-group-item">第三方账号</a>
            <a href="/user/settings?tab=notify" class="list-group-item">通知提醒</a>
            <a href="/user/settings?tab=lab" class="list-group-item">实验功能</a>
        </nav>
    </div><!-- end #secondary -->

    <div id="main" class="settings col-md-10 form-horizontal">
        @yield('main')
    </div>
</div>
@endsection