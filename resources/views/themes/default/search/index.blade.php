@extends('theme::layout.public')

@section('seo')
    <title>搜索 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="container mt-20">
        <div class="row">
            <div class="container">
                <ul class="search-category nav nav-pills">
                    <li @if($filter==='questions') class="active" @endif ><a href="{{ route('auth.search.index') }}?word={{ $word }}">问答</a></li>
                    <li @if($filter==='articles') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'articles']) }}?word={{ $word }}">文章</a></li>
                    <li @if($filter==='tags') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'tags']) }}?word={{ $word }}">标签</a></li>
                    <li @if($filter==='users') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'users']) }}?word={{ $word }}">用户</a></li>
                </ul>
                <form action="{{ route('auth.search.index') }}" class="row" method="GET">
                    <div class="col-md-9">
                        <input class="input-lg form-control" type="text" name="word" value="{{ $word }}" placeholder="输入关键字搜索">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">搜索</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 main search-result">
                <h3 class="h5 mt0">找到约 <strong>{{ $list->count() }}</strong> 条结果</h3>
                @if($filter==='questions')
                    @foreach($list as $question)
                    <section class="widget-question">
                        <h2 class="h4">
                            @if($question->status==2)
                            <span class="label label-success pull-left mr-5">解决</span>
                            @endif
                            <a href="{{ route('ask.question.detail',['question_id'=>$question->id]) }}" target="_blank">{{ $question->title }}</a>
                        </h2>
                        <p class="excerpt">{{ str_limit(strip_tags($question->description),200) }}</p>
                    </section>
                    @endforeach
                @elseif($filter==='articles')
                    @foreach($list as $article)
                    <section class="widget-blog">
                        <h2 class="h4">
                            <a href="{{ route('blog.article.detail',['article_id'=>$article->id]) }}" target="_blank">{{ $article->title }}</a>
                        </h2>
                        <p class="excerpt">{{ str_limit(strip_tags($article->summary),200) }}</p>
                    </section>
                    @endforeach
                @elseif($filter==='users')
                    @foreach($list as $user)
                        <section class="widget-member">
                            <h2 class="h4">
                                <a href="{{ route('auth.space.index',['user_id'=>$user->id]) }}" target="_blank">{{ $user->name }}</a>
                                @if($user->title) <span class="text-muted"> - {{ $user->title }}</span> @endif

                            </h2>
                            <p class="excerpt">{{ str_limit(strip_tags($user->description),200) }}</p>
                        </section>
                    @endforeach
                @elseif($filter==='tags')
                    @foreach($list as $tag)
                        <section class="widget-tag">
                            <h2 class="h4">
                                <a href="{{ route('ask.tag.index',['name'=>$tag->name]) }}" target="_blank">{{ $tag->name }}</a>
                            </h2>
                            <p class="excerpt">{{ str_limit(strip_tags($tag->description),200) }}</p>
                        </section>
                    @endforeach

                @endif
                <div class="text-center">
                    {!! str_replace('/?', '?', $list->render()) !!}
                </div>
            </div>
            <div class="col-md-3 side">
                <ul class="list-unstyled">
                </ul>
            </div>
        </div>
    </div>
@endsection
