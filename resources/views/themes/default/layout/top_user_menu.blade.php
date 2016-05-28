<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'website.user') active @endif" href="{{ route('website.user') }}">
            活跃用户
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.top.coins') active @endif" href="{{ route('auth.top.coins') }}">
            财富榜
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.top.answers') active @endif" href="{{ route('auth.top.answers') }}">
            回答榜
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.top.articles') active @endif" href="{{ route('auth.top.articles') }}">
            作家榜
        </a>
    </div>

</div>
