<div class="col-xs-12 col-md-3 side">
    <div class="widget-messages mt-30">
        <a class="widget-message-item @if(request()->route()->getName() == 'ask.doing.index') active @endif" href="{{ route('ask.doing.index') }}">
            最新动态
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.notification.index') active @endif" href="{{ route('auth.notification.index') }}">
            我的通知 <span class="badge">4</span>
        </a>
        <a class="widget-message-item" href="/user/bookmarks">
            我的私信 <span class="badge">4</span>
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.attention.sources') active @endif" href="{{ route('auth.attention.sources',['source_type'=>'questions']) }}">
            我的关注
        </a>
        <a class="widget-message-item @if(request()->route()->getName() == 'auth.collection.sources') active @endif" href="{{ route('auth.collection.sources',['source_type'=>'questions']) }}">
            我的收藏
        </a>
    </div>

</div>
