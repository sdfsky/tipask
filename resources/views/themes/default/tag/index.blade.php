@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">

            <section class="tag-info mt30">
                <img class="pull-left avatar-32 mr10" src="http://sfault-avatar.b0.upaiyun.com/195/823/1958237468-1040000000089436_small">
                <h1 class="h3">{{ $tag->name }}</h1>
                <ul class="list-inline">
                </ul>

                <div class="mb20">
                    <p>{{ $tag->summary }} <a href="{{ route('ask.tag.index',['name'=>$tag->name,'source_type'=>'details']) }}">[百科]</a></p>
                </div>
            </section>

            <ul class="nav nav-tabs nav-tabs-zen">
                <li @if($source_type==='questions') class="active" @endif ><a href="{{ route('ask.tag.index',['name'=>$tag->name]) }}">问答</a></li>
                <li @if($source_type==='articles') class="active" @endif ><a href="{{ route('ask.tag.index',['name'=>$tag->name,'source_type'=>'articles']) }}">文章</a></li>
                <li @if($source_type==='details') class="active" @endif ><a href="{{ route('ask.tag.index',['name'=>$tag->name,'source_type'=>'details']) }}">百科</a></li>
            </ul>
            <div class="tab-content">
                <div class="stream-list">
                    @if($source_type==='questions')
                        @foreach($sources as $question)
                            <section class="stream-list-item">
                                <div class="qa-rank">
                                    <div class="answers">
                                        {{ $question->answers }}<small>回答</small>
                                    </div>
                                    <div class="views hidden-xs">
                                        {{ $question->views }}<small>浏览</small>
                                    </div>
                                </div>
                                <div class="summary">
                                    <ul class="author list-inline">
                                        <li>
                                            <a href="{{ route('auth.space.index',['user_id'=>$question->user->id]) }}">{{ $question->user->name }}</a>
                                            <span class="split"></span>
                                            <span class="askDate">{{ $question->created_at }}</span>
                                        </li>
                                    </ul>
                                    <h2 class="title"><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a></h2>
                                    @if($question->tags)
                                        <ul class="taglist--inline ib">
                                            @foreach($question->tags as $tag)
                                                <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['name'=>$tag->name]) }}">{{ $tag->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </section>
                        @endforeach
                    @elseif($source_type==='articles')
                        @foreach($sources as $article)
                            <section class="stream-list-item">
                                <div class="blog-rank">
                                    <div class="votes @if($article->supports>0) plus @endif">
                                        {{ $article->supports }}<small>推荐</small>
                                    </div>
                                    <div class="views hidden-xs">
                                        {{ $article->views }}<small>浏览</small>
                                    </div>
                                </div>
                                <div class="summary">
                                    <h2 class="title"><a href="{{ route('blog.article.detail',['id'=>$article->id]) }}">{{ $article->title }}</a></h2>
                                    <p class="excerpt wordbreak hidden-xs">{{ $article->summary }}</p>
                                    <ul class="author list-inline">
                                        <li class="pull-right" title="{{ $article->collections }} 收藏">
                                            <small class="glyphicon glyphicon-bookmark"></small> {{ $article->collections }}
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}">
                                                <img class="avatar-20 mr-10 hidden-xs" src="{{ route('website.image.avatar',['avatar_name'=>$article->user_id.'_small']) }}" alt="{{ $article->user->name }}"> {{ $article->user->name }}
                                            </a>
                                            发布于 {{ timestamp_format($article->created_at) }}
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        @endforeach
                    @else
                        <div class="text-fmt">{!! $tag->description  !!}</div>
                    @endif



                </div>

                @if($source_type!=='details')
                <div class="text-center">
                    {!! str_replace('/?', '?', $sources->render()) !!}
                </div>
                @endif
            </div>
        </div>

        <div class="col-xs-12 col-md-3 side">

            <ul class="widget-action--ver list-unstyled mt30">
                <li>
                    <button type="button" class="btn btn-success btn-sm tagfollow" data-id="1040000000089436">关注</button>
                    <strong class="follows">3847</strong> 人关注
                </li>
            </ul>

            <div class="widget-box">
                <h2 class="h4 widget-box__title">相关标签</h2>
                <ul class="taglist--inline multi">
                    <li class="tagPopup"><a class="tag" href="/t/jquery" data-toggle="popover" data-id="1040000000089733" data-original-title="jquery">jquery</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-id="1040000000117807" data-original-title="web前端开发">web前端开发</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/html" data-toggle="popover" data-id="1040000000089571" data-original-title="html">html</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/css" data-toggle="popover" data-id="1040000000089434" data-original-title="css">css</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/%E5%89%8D%E7%AB%AF" data-toggle="popover" data-id="1040000000089899" data-original-title="前端">前端</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/html5" data-toggle="popover" data-id="1040000000089409" data-original-title="html5">html5</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/node.js" data-toggle="popover" data-id="1040000000089918" data-original-title="node.js">node.js</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/php" data-toggle="popover" data-id="1040000000089387" data-original-title="php">php</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/ajax" data-toggle="popover" data-id="1040000000090169" data-original-title="ajax">ajax</a></li>
                    <li class="tagPopup"><a class="tag" href="/t/angularjs" data-toggle="popover" data-id="1040000000210853" data-original-title="angularjs">angularjs</a></li>
                </ul>
            </div>

            <div class="widget-box widget-taguser">
                <h2 class="h4 widget-box__title">本月新人榜</h2>
                <ol class="widget-top10">
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/187/042/1870427853-1030000000334890_small" class="avatar-24">
                        <a href="/u/xqin" class="ellipsis">小_秦</a>
                        <span class="text-muted pull-right">+858</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/102/267/1022677309-564133a26350a_small" class="avatar-24">
                        <a href="/u/wangfulin" class="ellipsis">wangfulin</a>
                        <span class="text-muted pull-right">+828</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/289/886/2898869684-55f8d08843aa6_small" class="avatar-24">
                        <a href="/u/onemonth" class="ellipsis">jasonintju</a>
                        <span class="text-muted pull-right">+572</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/824/480/824480220-5638b618377e0_small" class="avatar-24">
                        <a href="/u/yangbo" class="ellipsis">看不懂未来</a>
                        <span class="text-muted pull-right">+565</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/612/581/612581822-1030000000518516_small" class="avatar-24">
                        <a href="/u/feihu" class="ellipsis">飞狐</a>
                        <span class="text-muted pull-right">+557</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/893/290/893290401-5621cb66a2ed6_small" class="avatar-24">
                        <a href="/u/116263" class="ellipsis">谦龙</a>
                        <span class="text-muted pull-right">+493</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/550/538/550538601-54b5303a2d493_small" class="avatar-24">
                        <a href="/u/trigkit4" class="ellipsis">trigkit4</a>
                        <span class="text-muted pull-right">+449</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/151/837/1518375183-54f135ef0d731_small" class="avatar-24">
                        <a href="/u/akong" class="ellipsis">kikong</a>
                        <span class="text-muted pull-right">+431</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/631/523/631523902-1030000000479629_small" class="avatar-24">
                        <a href="/u/reeco" class="ellipsis">FullStackDeveloper</a>
                        <span class="text-muted pull-right">+417</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/165/097/1650972814-554628c41daa1_small" class="avatar-24">
                        <a href="/u/jogis" class="ellipsis">Jogis</a>
                        <span class="text-muted pull-right">+405</span>
                    </li>
                </ol>
            </div>

            <div class="widget-box widget-taguser">
                <h2 class="h4 widget-box__title">标签名人榜</h2>
                <ol class="widget-top10">
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/213/644/2136446251-1030000000092523_small" class="avatar-24">
                        <a href="/u/lizheming" class="ellipsis">公子</a>
                        <span class="text-muted pull-right">+11298</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/550/538/550538601-54b5303a2d493_small" class="avatar-24">
                        <a href="/u/trigkit4" class="ellipsis">trigkit4</a>
                        <span class="text-muted pull-right">+10506</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/812/504/812504259-54509cf40aa63_small" class="avatar-24">
                        <a href="/u/justjavac" class="ellipsis">justjavac</a>
                        <span class="text-muted pull-right">+7020</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/263/018/2630188223-1030000000125916_small" class="avatar-24">
                        <a href="/u/nightire" class="ellipsis">nightire</a>
                        <span class="text-muted pull-right">+6900</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/224/935/2249350845-55f2d9cdbce09_small" class="avatar-24">
                        <a href="/u/humphry" class="ellipsis">Humphry</a>
                        <span class="text-muted pull-right">+5020</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/187/042/1870427853-1030000000334890_small" class="avatar-24">
                        <a href="/u/xqin" class="ellipsis">小_秦</a>
                        <span class="text-muted pull-right">+4895</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/134/728/1347286714-552515d3026fd_small" class="avatar-24">
                        <a href="/u/naraku_" class="ellipsis">Naraku_</a>
                        <span class="text-muted pull-right">+4527</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/157/842/1578424531-1030000000455562_small" class="avatar-24">
                        <a href="/u/mcfog" class="ellipsis">mcfog</a>
                        <span class="text-muted pull-right">+4282</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/275/720/275720874-553ae32cd2b02_small" class="avatar-24">
                        <a href="/u/jamesfancy" class="ellipsis">边城</a>
                        <span class="text-muted pull-right">+3973</span>
                    </li>
                    <li>
                        <img src="http://sfault-avatar.b0.upaiyun.com/309/982/3099829444-555ac75eedca6_small" class="avatar-24">
                        <a href="/u/qianjiahao" class="ellipsis">qianjiahao</a>
                        <span class="text-muted pull-right">+3852</span>
                    </li>
                </ol>
            </div>

        </div><!-- /.side -->
    </div>
@endsection