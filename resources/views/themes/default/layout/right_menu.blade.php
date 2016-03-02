<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.notification.index') active @endif" href="{{ route('auth.notification.index') }}">
            我的通知
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.message.index') active @endif"" href="{{ route('auth.message.index') }}">
            我的私信
        </a>
    </div>

</div>
