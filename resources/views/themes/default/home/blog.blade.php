@extends('theme::layout.public')
@section('seo_title')@section('seo_title')@if($filter === 'newest')最新的@elseif($filter === 'hottest')热门的@elseif($filter === 'recommended')推荐的@endif文章 - 第{{ $articles->currentPage() }}页 - {{ Setting()->get('website_name') }}@endsection
@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            @if( $categories )
                <div class="row widget-category">
                    <div class="col-sm-12">
                        <ul class="list">
                            @foreach( $categories as $category )
                                <li @if( $category->id == $currentCategoryId ) class="active" @endif ><a href="{{ route('website.ask',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <ul class="nav nav-tabs mb-10 mt-20">
                <li @if($filter==='recommended') class="active" @endif><a href="{{ route('website.blog',['category_slug'=>$categorySlug]) }}">推荐的</a></li>
                <li @if($filter==='hottest') class="active" @endif><a href="{{ route('website.blog',['category_slug'=>$categorySlug,'filter'=>'hottest']) }}">热门的</a></li>
                <li @if($filter==='newest') class="active" @endif ><a href="{{ route('website.blog',['category_slug'=>$categorySlug,'filter'=>'newest']) }}">最新的</a></li>
            </ul>
            <div class="stream-list blog-stream">
                @foreach($articles as $article)
                <section class="stream-list-item clearfix">
                    <div class="blog-rank">
                        <a href="http://lanxi.baijia.baidu.com/article/691745" target="_blank" mon="col=13&amp;pn=1&amp;a=12"><img style="width: 200px;height:120px;" src="http://f.hiphotos.baidu.com/news/crop%3D84%2C1%2C609%2C365%3Bw%3D638/sign=a4daf82ccf5c1038303194828f29a73f/1c950a7b02087bf4475bafdffbd3572c11dfcf55.jpg"></a>
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