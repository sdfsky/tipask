@extends('theme::layout.space')

@section('seo_title')@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我 @else 他 @endif 收藏的@if($source_type==='questions')问题 @else 文章 @endif - {{ Setting()->get('website_name') }}@endsection

@section('space_content')
    <div class="stream-following">
        <ul class="nav nav-tabs mt-20">
            <li @if($source_type==='questions') class="active" @endif ><a href="{{ route('auth.space.collections',['user_id'=>$userInfo->id,'source_type'=>'questions']) }}">收藏的问题</a></li>
            <li @if($source_type==='articles') class="active" @endif ><a href="{{ route('auth.space.collections',['user_id'=>$userInfo->id,'source_type'=>'articles']) }}">收藏的文章</a></li>
        </ul>

        <div class="stream-list question-stream mt-10">
            @foreach($collections as $collection)

                @if($source_type==='questions')
                <section class="stream-list-item">
                    <div class="bookmark-rank">
                        <div class="collections">
                            {{ $collection['info']->collections }}<small>收藏</small>
                        </div>
                    </div>

                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="{{ route('auth.space.index',['user_id'=>$collection['info']->user->id]) }}">{{ $collection['info']->user->name }}</a>
                                <span class="split"></span>
                                {{ timestamp_format($collection['info']->created_at) }}
                            </li>
                        </ul>
                        <h2 class="title">
                            <a href="{{ route('ask.question.detail',['id'=>$collection['info']->id]) }}">{{ $collection->subject }}</a>
                        </h2>
                    </div>
                </section>
                @else
                    <section class="stream-list-item">
                        <div class="bookmark-rank">
                            <div class="collections">
                                {{ $collection['info']->collections }}<small>收藏</small>
                            </div>
                        </div>

                        <div class="summary">
                            <ul class="author list-inline">
                                <li>
                                    <a href="{{ route('auth.space.index',['user_id'=>$collection['info']->user->id]) }}">{{ $collection['info']->user->name }}</a>
                                    <span class="split"></span>
                                    {{ timestamp_format($collection['info']->created_at) }}
                                </li>
                            </ul>
                            <h2 class="title">
                                <a href="{{ route('blog.article.detail',['id'=>$collection['info']->id]) }}">{{ $collection->subject }}</a>
                            </h2>
                        </div>
                    </section>
                @endif
            @endforeach
        </div>

        <div class="text-center">
            {!! str_replace('/?', '?', $collections->render()) !!}
        </div>
    </div>

@endsection


