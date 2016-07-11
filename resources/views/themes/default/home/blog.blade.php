@extends('theme::layout.public')
@section('seo_title')@section('seo_title')@if($filter === 'newest')最新的@elseif($filter === 'hottest')热门的@elseif($filter === 'recommended')推荐的@endif问题 - {{ Setting()->get('website_name') }}@endsection文章 - {{ Setting()->get('website_name') }}@endsection
@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <ul class="nav nav-tabs nav-tabs-zen mb-10">
                <li @if($filter==='recommended') class="active" @endif><a href="{{ route('website.blog') }}">推荐的</a></li>
                <li @if($filter==='hottest') class="active" @endif><a href="{{ route('website.blog',['filter'=>'hottest']) }}">热门的</a></li>
                <li @if($filter==='newest') class="active" @endif ><a href="{{ route('website.blog',['filter'=>'newest']) }}">最新的</a></li>
            </ul>
            <div class="stream-list blog-stream">
                @foreach($articles as $article)
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
                        <h2 class="title"><a href="{{ route('blog.article.detail',['id'=>$article->id]) }}" target="_blank" >{{ $article->title }}</a></h2>
                        <p class="excerpt wordbreak hidden-xs">{{ $article->summary }}</p>
                        <ul class="author list-inline">
                            <li class="pull-right" title="{{ $article->collections }} 收藏">
                                <small class="glyphicon glyphicon-bookmark"></small> {{ $article->collections }}
                            </li>
                            <li>
                                <a href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}" target="_blank">
                                    <img class="avatar-20 mr-10 hidden-xs" src="{{ route('website.image.avatar',['avatar_name'=>$article->user_id.'_small']) }}" alt="{{ $article->user->name }}"> {{ $article->user->name }}
                                </a>
                                发布于 {{ timestamp_format($article->created_at) }}
                            </li>
                        </ul>
                    </div>
                </section>
                @endforeach

            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $articles->render()) !!}
            </div>
        </div><!-- /.main -->
        <div class="col-xs-12 col-md-3 side">
            <div class="side-alert alert alert-warning">
                <p>今天，有什么经验需要分享呢？</p>
                <a href="{{ route('blog.article.create') }}" class="btn btn-primary btn-block mt-10">立即撰写</a>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">热议话题 <a href="{{ route('website.topic') }}" title="更多">»</a></h2>
                <ul class="taglist-inline multi">
                    @foreach($hotTags as $hotTag)
                        <li class="tagPopup"><a class="tag" data-toggle="popover"  href="{{ route('ask.tag.index',['name'=>$hotTag->name]) }}">{{ $hotTag->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">热门作者 <a href="{{ route('auth.top.articles') }}">»</a></h2>
                <ul class="list-unstyled">
                    @foreach($hotUsers as $hotUser)
                    <li class="media  widget-user-item ">
                        <a href="{{ route('auth.space.index',['user_id'=>$hotUser['id']]) }}" class="user-card pull-left" target="_blank">
                            <img class="avatar-50"  src="{{ route('website.image.avatar',['avatar_name'=>$hotUser['id'].'_middle']) }}" alt="{{ $hotUser->name }}"></a>
                        </a>
                        <div class="media-object">
                            <strong><a href="{{ route('auth.space.index',['user_id'=>$hotUser['id']]) }}">{{ $hotUser['name'] }}</a></strong>

                            <p class="text-muted"> {{ $hotUser['articles'] }} 篇文章，{{ $hotUser['supports'] }} 赞同</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>


        </div>
    </div>
@endsection