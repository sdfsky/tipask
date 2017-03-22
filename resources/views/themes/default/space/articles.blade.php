@extends('theme::layout.space')

@section('seo_title') @if(Auth()->check() && Auth()->user()->id === $userInfo->id )我@else{{ $userInfo->name }} @endif 的文章 - {{ Setting()->get('website_name') }} @endsection

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


