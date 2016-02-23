@extends('theme::layout.public')

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <ul class="nav nav-tabs nav-tabs-zen mb10">
                <li @if($filter==='newest') class="active" @endif ><a href="{{ route('website.ask') }}">最新的</a></li>
                <li @if($filter==='hottest') class="active" @endif><a href="{{ route('website.ask',['filter'=>'hottest']) }}">热门的</a></li>
                <li @if($filter==='reward') class="active" @endif><a href="{{ route('website.ask',['filter'=>'reward']) }}">悬赏的</a></li>
                <li @if($filter==='unAnswered') class="active" @endif><a href="{{ route('website.ask',['filter'=>'unAnswered']) }}">未回答</a></li>
            </ul>

            <div class="stream-list question-stream">
                @foreach($questions as $question)
                <section class="stream-list-item">
                    <div class="qa-rank">
                        <div class="answers @if($question->status===2) solved @elseif($question->answers>0) answered @endif">
                            {{ $question->answers }}<small>@if($question->status===2) 解决 @else 回答 @endif</small>
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
                                <span class="askDate">{{ timestamp_format($question->created_at) }}</span>
                            </li>
                        </ul>
                        <h2 class="title">
                            @if($question->price>0)
                                <span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span>
                            @endif
                            <a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a>
                        </h2>
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

            </div><!-- /.stream-list -->

            <div class="text-center">
                {!! str_replace('/?', '?', $questions->render()) !!}
            </div>
        </div><!-- /.main -->
        <div class="col-xs-12 col-md-3 side">
            <div class="side-ask alert alert-warning">
                <p>今天，你的网站遇到什么问题呢？</p>
                <a href="{{ route('ask.question.create') }}" class="btn btn-primary btn-block mt-10">提问</a>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">热议标签 <a href="/tags" title="更多">»</a></h2>
                <ul class="taglist--inline multi">
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript" href="/t/javascript">javascript</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089387" data-original-title="php" href="/t/php">php</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089534" data-original-title="python" href="/t/python">python</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089434" data-original-title="css" href="/t/css">css</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089442" data-original-title="ios" href="/t/ios">ios</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089658" data-original-title="android" href="/t/android">android</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089918" data-original-title="node.js" href="/t/node.js">node.js</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089409" data-original-title="html5" href="/t/html5">html5</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000090203" data-original-title="go" href="/t/go">go</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089488" data-original-title="mongodb" href="/t/mongodb">mongodb</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089431" data-original-title="redis" href="/t/redis">redis</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089556" data-original-title="程序员" href="/t/程序员">程序员</a></li>
                </ul>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">最近热门的</h2>
                <ul class="widget-links list-unstyled">
                    @foreach($hotQuestions as $hotQuestion)
                    <li class="widget-links__item">
                        <a href="{{ route('ask.question.detail',['question_id'=>$hotQuestion->id]) }}">{{ $hotQuestion->title }}</a>
                        <small class="text-muted">{{ $hotQuestion->answers }} 回答</small>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection