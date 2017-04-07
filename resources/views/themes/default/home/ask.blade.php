@extends('theme::layout.public')

@section('seo_title') @if($filter === 'newest')最新的 @elseif($filter === 'hottest')热门的 @elseif($filter === 'reward')悬赏的 @elseif($filter==='unAnswered')未回答的 @endif 问题 @if( $questions->currentPage()>1 ) - 第{{ $questions->currentPage() }}页 @endif - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            @if( $categories )
            <div class="widget-category clearfix">
                    <div class="col-sm-12">
                        <ul class="list">
                            <li><a href="{{ route('website.ask') }}">全部</a></li>
                            @foreach( $categories as $category )
                                <li @if( $category->id == $currentCategoryId ) class="active" @endif ><a href="{{ route('website.ask',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
            </div>
            @endif
            <ul class="nav nav-tabs mb-10 mt-20">
                <li @if($filter==='newest') class="active" @endif ><a href="{{ route('website.ask',['category_slug'=>$categorySlug]) }}">最新的</a></li>
                <li @if($filter==='hottest') class="active" @endif><a href="{{ route('website.ask',['category_slug'=>$categorySlug,'filter'=>'hottest']) }}">热门的</a></li>
                <li @if($filter==='reward') class="active" @endif><a href="{{ route('website.ask',['category_slug'=>$categorySlug,'filter'=>'reward']) }}">悬赏的</a></li>
                <li @if($filter==='unAnswered') class="active" @endif><a href="{{ route('website.ask',['category_slug'=>$categorySlug,'filter'=>'unAnswered']) }}">未回答的</a></li>
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
                                <a href="{{ route('auth.space.index',['user_id'=>$question->user->id]) }}" target="_blank">{{ $question->user->name }}</a>
                                <span class="split"></span>
                                <span class="askDate">{{ timestamp_format($question->created_at) }}</span>
                            </li>
                        </ul>
                        <h2 class="title">
                            @if($question->price>0)
                                <span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span>
                            @endif
                            <a href="{{ route('ask.question.detail',['id'=>$question->id]) }}" target="_blank" >{{ $question->title }}</a>
                        </h2>
                        @if($question->tags)
                        <ul class="taglist-inline ib">
                            @foreach($question->tags as $tag)
                                <li class="tagPopup"><a class="tag" target="_blank" href="{{ route('ask.tag.index',['id'=>$tag->id]) }}">{{ $tag->name }}</a></li>
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
            <div class="side-alert alert alert-warning">
                <p>今天，你的网站遇到什么问题呢？</p>
                <a href="{{ route('ask.question.create') }}" class="btn btn-primary btn-block mt-10">立即提问</a>
            </div>
            @include('theme::layout.auth_menu')
            <div class="widget-box">
                <h2 class="h4 widget-box-title">热议话题 <a href="{{ route('website.topic') }}" title="更多">»</a></h2>
                <ul class="taglist-inline multi">
                    @foreach($hotTags as $hotTag)
                        <li class="tagPopup"><a class="tag" data-toggle="popover"  href="{{ route('ask.tag.index',['id'=>$hotTag->tag_id]) }}">{{ $hotTag->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="widget-box mt30">
                <h2 class="widget-box-title">
                    活跃用户
                    <a href="{{ route('website.user') }}" title="更多">»</a>
                </h2>
                <ol class="widget-top10">
                    @foreach($hotUsers as $index => $hotUser)
                        <li class="text-muted">
                            <img class="avatar-32" src="{{ get_user_avatar($hotUser['id']) }}">
                            <a href="{{ route('auth.space.index',['user_id'=>$hotUser['id']]) }}" class="ellipsis">{{ $hotUser['name'] }}</a>
                            <span class="text-muted pull-right">{{ $hotUser['credits'] }} 经验</span>
                        </li>
                    @endforeach

                </ol>
            </div>

        </div>
    </div>
@endsection