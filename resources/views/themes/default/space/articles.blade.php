@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif文章 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('space_content')
    <h4 class="space-stream-heading">{{ $articles->total() }} 篇文章</h4>
    <ul class="space-stream-list">
        <li>
            <div class="row">
                <div class="col-md-8 space-stream-item-title-warp">
                    <strong>标题</strong>
                </div>
                <div class="col-md-2">
                    <strong>推荐/浏览</strong>
                </div>
                <div class="col-md-2">
                    <strong>发布日期</strong>
                </div>
            </div>
        </li>
        @foreach($articles as $article)
        <li>
            <div class="row">
                <div class="col-md-8 space-stream-item-title-warp">
                    <a class="space-stream-item-title" href="{{ route('blog.article.detail',['id'=>$article->id]) }}">{{ $article->title }}</a>
                </div>
                <div class="col-md-2"><span class="text-muted">{{ $article->supports }}/{{ $article->views }}</span></div>
                <div class="col-md-2">
                    <span class="space-stream-item-date">{{ timestamp_format($article->created_at) }}</span>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="text-center">
        {!! str_replace('/?', '?', $articles->render()) !!}
    </div>
@endsection


