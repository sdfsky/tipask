<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.notification.index') active @endif" href="{{ route('auth.notification.index') }}">
            我的通知 <span class="badge">4</span>
        </a>
        <a class="widget-message-item" href="/user/bookmarks">
            我的私信
        </a>
    </div>

</div>
