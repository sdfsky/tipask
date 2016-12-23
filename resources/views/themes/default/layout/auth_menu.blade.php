@if(Auth()->check())
    <div class="widget-user-nav">
        <div class="row">
            <div class="col-sm-6 col-xs-6 widget-nav-item ">
                <a  class="widget-nav-item-link" href="{{ route('auth.space.questions',['user_id'=>Auth()->user()->id]) }}">
                    我的提问
                </a>
            </div>
            <div class="col-sm-6 widget-nav-item ">
                <a class="widget-nav-item-link " href="{{ route('auth.space.answers',['user_id'=>Auth()->user()->id]) }}">
                    我的回答
                </a>
            </div>
            <div class="col-sm-6 col-xs-6 widget-nav-item ">
                <a id="inviteCount" class="widget-nav-item-link" href="{{ route('auth.questionInvitation.index') }}">
                    受邀回答
                </a>
            </div>
            <div class="col-sm-6 col-xs-6  widget-nav-item ">
                <a id="inviteCount" class="widget-nav-item-link" href="{{ route('auth.space.questions',['user_id'=>Auth()->user()->id]) }}">
                    我的文章
                </a>
            </div>
            <div class="col-sm-6 col-xs-6 widget-nav-item ">
                <a class="widget-nav-item-link" href="{{ route('auth.space.collections',['user_id'=>Auth()->user()->id,'source_type'=>'questions']) }}">
                    我的收藏
                </a>
            </div>
            <div class="col-sm-6 col-xs-6 widget-nav-item ">
                <a class="widget-nav-item-link" href="{{ route('auth.space.attentions',['user_id'=>Auth()->user()->id,'source_type'=>'questions']) }}">
                    我关注的
                </a>
            </div>
        </div>
    </div>
@endif