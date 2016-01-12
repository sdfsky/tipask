@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/css/default/topic.css')}}" rel="stylesheet" />
@endsection

@section('content')
        <h1 class="h3">话题<br><small>话题是最有效的内容组织形式，正确的使用话题能更快的发现和解决你的问题</small></h1>
        <div class="row tag-list mt-20">
            @foreach($topics as $topic)
            <section class="topic-list-item col-md-3">
                <div class="widget-topic">
                    <h2 class="h4">
                        <a href="{{ route('ask.tag.index',['name'=>$topic->name]) }}" class="tag-img" style="background-image: url(http://sfault-avatar.b0.upaiyun.com/365/152/3651522545-5541ff4b6206e_icon);">{{ $topic->name }}</a>
                    </h2>
                    <p>
                        @if($topic->description)
                            {{ str_limit($topic->description,200) }}
                        @else
                            暂无介绍
                        @endif
                    </p>
                    <div class="widget-topic-action">
                        <button class="btn btn-success btn-xs mr-5 tagfollow" data-id="1040000000089436">加关注</button>
                        <strong class="follows">{{ $topic->followers }}</strong> <span class="text-muted">关注</span>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
        <div class="text-center">
            {!! str_replace('/?', '?', $topics->render()) !!}
        </div>
@endsection