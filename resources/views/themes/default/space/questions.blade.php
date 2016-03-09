@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif提问 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('space_content')

    <h4 class="space-stream-heading">{{ $questions->total() }} 个问题</h4>
    <ul class="space-stream-list">
        <li>
            <div class="row">
                <div class="col-md-8 space-stream-item-title-warp">
                    <strong>标题</strong>
                </div>
                <div class="col-md-2">
                    <strong>回答/浏览</strong>
                </div>
                <div class="col-md-2">
                    <strong>发布日期</strong>
                </div>
            </div>
        </li>
        @foreach($questions as $question)
            <li>
                <div class="row">
                    <div class="col-md-8 space-stream-item-title-warp">
                        @if($question->price>0)
                            <span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span>
                        @endif
                        <a class="space-stream-item-title" href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a>
                        @if($question->status===2) <span class="label label-success ml-5">已解决</span> @endif
                    </div>
                    <div class="col-md-2"><span class="text-muted">{{ $question->answers }}/{{ $question->views }}</span></div>
                    <div class="col-md-2">
                        <span class="space-stream-item-date">{{ timestamp_format($question->created_at) }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="text-center">
        {!! str_replace('/?', '?', $questions->render()) !!}
    </div>
@endsection


