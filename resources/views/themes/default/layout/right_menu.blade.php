<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages">
        <a class="widget-messages__item @if(request()->route()->getName() == 'ask.doing.index') active @endif" href="{{ route('ask.doing.index') }}">
            最新动态
        </a>
        <a class="widget-messages__item @if(request()->route()->getName() == 'auth.notification.index') active @endif" href="{{ route('auth.notification.index') }}">
            我的通知
        </a>
        <a class="widget-messages__item" href="/user/bookmarks">
            我的私信
        </a>
        <a id="inviteCount" class="widget-messages__item" href="/user/invited">
            邀请我回答的
        </a>
        <a class="widget-messages__item" href="/user/invitation">邀请朋友加入</a>
    </div>

</div>
