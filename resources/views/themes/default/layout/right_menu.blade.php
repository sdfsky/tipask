<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.doing.index') active @endif" href="{{ route('auth.doing.index') }}">
            最新动态
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.notification.index') active @endif" href="{{ route('auth.notification.index') }}">
            我的通知
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.message.index') active @endif" href="{{ route('auth.message.index') }}">
            我的私信
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.questionInvitation.index') active @endif" href="{{ route('auth.questionInvitation.index') }}">
            邀请我回答的
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'shop.exchange.index') active @endif" href="{{ route('shop.exchange.index') }}">
            我的兑换
        </a>
    </div>

</div>
