@extends('theme::layout.public')

@section('seo_title')搜索 - 第{{ $list->currentPage() }}页 -  {{ Setting()->get('website_name') }}@endsection

@section('content')
    @if(Setting()->get("xunsearch_open",0))
        <div class="container mt-20">
            <div class="row">
                <div class="container">
                    <ul class="search-category nav nav-pills">
                        <li @if($filter==='all') class="active" @endif ><a href="{{ route('auth.search.index') }}?word={{ $word }}">全部</a></li>
                        <li @if($filter==='questions') class="active" @endif ><a href="{{ route('auth.search.index',['filter'=>'questions']) }}?word={{ $word }}">问答</a></li>
                        <li @if($filter==='articles') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'articles']) }}?word={{ $word }}">文章</a></li>
                        <li @if($filter==='courses') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'courses']) }}?word={{ $word }}">讲堂</a></li>
                        <li @if($filter==='tags') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'tags']) }}?word={{ $word }}">话题</a></li>
                        <li @if($filter==='users') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'users']) }}?word={{ $word }}">用户</a></li>
                    </ul>
                    <form action="{{ route('auth.search.index',['filter'=>$filter]) }}" class="row" method="GET">
                        <div class="col-md-9">
                            <input class="input-lg form-control" type="text" name="word" value="{{ $word }}" placeholder="输入关键字搜索">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block search-btn">搜索</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 main search-result">
                    <h3 class="h5">找到约 <strong>{{ $list->count() }}</strong> 条结果</h3>
                    @foreach( $list as $item )
                        @if( $item['class_uid'] === 'a071d30e96787d46b4e6e5191b452c1d' )
                        <section class="widget-item">
                            <h2 class="h4">
                                @if( $item['status'] == 2 )
                                    <span class="label label-success pull-left mr-5">问题</span>
                                @else
                                    <span class="label label-warning pull-left mr-5">问题</span>
                                @endif
                                <a href="{{ route('ask.question.detail',['question_id'=>$item['id']]) }}" target="_blank">{!! $item['subject'] !!}</a>
                            </h2>
                            <p class="excerpt">{!! $item['content'] !!}</p>
                        </section>
                        @elseif( $item['class_uid'] === 'db04ed18cd04b43c64ab9d592dbebc40' )
                            <section class="widget-item">
                                <h2 class="h4">
                                    <span class="label label-success pull-left mr-5">文章</span>
                                    <a href="{{ route('blog.article.detail',['article_id'=>$item['id']]) }}" target="_blank">{!! $item['subject'] !!}</a>
                                </h2>
                                <p class="excerpt">{!! $item['content'] !!}</p>
                            </section>
                        @elseif( $item['class_uid'] === '7c4b2df66ec878ccfab0c03ed7f61989' )
                            <section class="widget-item">
                                <h2 class="h4">
                                    <span class="label label-success pull-left mr-5">用户</span>
                                    <a href="{{ route('auth.space.index',['user_id'=>$item['id']]) }}" target="_blank">{!! $item['subject'] !!}</a>
                                </h2>
                                <p class="excerpt">{!! $item['content'] !!}</p>
                            </section>
                        @elseif( $item['class_uid'] === '7118e6ddaa8fea122e7df7a9b79fc104' )
                            <section class="widget-item">
                                <h2 class="h4">
                                    <span class="label label-default pull-left mr-5">话题</span>
                                    <a href="{{ route('ask.tag.index',['id'=>$item['id']]) }}" target="_blank">{!! $item['subject'] !!}</a>
                                </h2>
                                <p class="excerpt">{!! $item['content'] !!}</p>
                            </section>
                        @elseif( $item['class_uid'] === '0cbb2dbe0943b26c88809cee41ce8e8c' )
                            <section class="widget-item">
                                <h2 class="h4">
                                    <span class="label label-success pull-left mr-5">讲堂</span>
                                    <a href="{{ route('live.course.show',['id'=>$item['id']]) }}" target="_blank">{!! $item['subject'] !!}</a>
                                </h2>
                                <p class="excerpt">{!! $item['content'] !!}</p>
                            </section>
                        @endif
                    @endforeach

                    <div class="text-center">
                        {!! str_replace('/?', '?', $list->render()) !!}
                    </div>
                </div>
                <div class="col-md-3 side"></div>
            </div>
        </div>
    @else
        <div class="container mt-20">
            <div class="row">
                <div class="container">
                    <ul class="search-category nav nav-pills">
                        <li @if($filter==='questions') class="active" @endif ><a href="{{ route('auth.search.index',['filter'=>'questions']) }}?word={{ $word }}">问答</a></li>
                        <li @if($filter==='articles') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'articles']) }}?word={{ $word }}">文章</a></li>
                        <li @if($filter==='courses') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'courses']) }}?word={{ $word }}">讲堂</a></li>
                        <li @if($filter==='tags') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'tags']) }}?word={{ $word }}">话题</a></li>
                        <li @if($filter==='users') class="active" @endif><a href="{{ route('auth.search.index',['filter'=>'users']) }}?word={{ $word }}">用户</a></li>
                    </ul>
                    <form action="{{ route('auth.search.index') }}" class="row" method="GET">
                        <div class="col-md-9">
                            <input class="input-lg form-control" type="text" name="word" value="{{ $word }}" placeholder="输入关键字搜索">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block search-btn">搜索</button>
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
                                    <a href="{{ route('ask.question.detail',['question_id'=>$question->id]) }}" target="_blank">{!! $question->title !!}</a>
                                </h2>
                                <p class="excerpt">{!! str_limit(strip_tags($question->description,"<em>"),200) !!} </p>
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
                                    <a href="{{ route('ask.tag.index',['id'=>$tag->id]) }}" target="_blank">{{ $tag->name }}</a>
                                </h2>
                                <p class="excerpt">{{ str_limit(strip_tags($tag->description),200) }}</p>
                            </section>
                        @endforeach

                    @elseif($filter==='courses')
                        @foreach($list as $course)
                            <section class="widget-tag">
                                <h2 class="h4">
                                    <a href="{{ route('live.course.show',['id'=>$course->id]) }}" target="_blank">{{ $course->title }}</a>
                                </h2>
                                <p class="excerpt">{{ str_limit(strip_tags($course->description),200) }}</p>
                            </section>
                        @endforeach

                    @endif
                    <div class="text-center">
                        {!! str_replace('/?', '?', $list->appends(['word'=>$word])->links()) !!}
                    </div>
                </div>
                <div class="col-md-3 side">
                    <ul class="list-unstyled">
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endsection
