<div id="secondary" class="col-md-2">
    <nav class="list-group mt-20">
        <a href="{{ route('auth.profile.base') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.base') active @endif" ><span class="glyphicon glyphicon-user"></span> 个人资料</a>
        <a href="{{ route('auth.profile.password') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.password') active @endif""><span class="glyphicon glyphicon-pencil"></span> 修改密码</a>
        <a href="{{ route('auth.profile.email') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.email') active @endif""><span class="glyphicon glyphicon-envelope"></span> 修改邮箱</a>
        <a href="{{ route('auth.profile.mobile') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.mobile') active @endif""><span class="glyphicon glyphicon-phone"></span> 绑定手机</a>
{{--        <a href="{{ route('auth.profile.oauth') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.oauth') active @endif""><span class="glyphicon glyphicon-retweet"></span> 账号绑定</a>--}}
        <a href="{{ route('auth.profile.notification') }}" class="list-group-item @if(request()->route()->getName() == 'auth.profile.notification') active @endif""><span class="glyphicon glyphicon-bell"></span> 通知提醒</a>
    </nav>
</div>