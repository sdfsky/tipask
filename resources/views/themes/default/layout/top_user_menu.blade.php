<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'website.experts') active @endif" href="{{ route('website.experts') }}">
            推荐专家
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'website.user') active @endif" href="{{ route('website.user') }}">
            活跃用户
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.top.coins') active @endif" href="{{ route('auth.top.coins') }}">
            财富榜
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.top.articles') active @endif" href="{{ route('auth.top.articles') }}">
            热门作者
        </a>
    </div>
</div>
