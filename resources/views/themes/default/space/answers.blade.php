@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif回答 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('space_content')
    <h2 class="h4">{{ $answers->total() }} 个回答</h2>
    <div class="stream-list board border-top">
        @foreach($answers as $answer)
        <section class="stream-list-item">
            <div class="qa-rank">
                <div class="answers answered ">
                    {{ $answer->supports }} <small> 赞同 </small>
                </div>
            </div>
            <div class="summary">
                <h2 class="title">
                    <a href="{{ route('ask.question.detail',['question_id'=>$answer->question_id]) }}" title="{{ $answer->question_title }}">{{ str_limit($answer->question_title,60) }}</a>
                    @if($answer->adopted_at>0) <label class="label label-warning ml-5">已采纳</label> @endif
                </h2>
                <p class="text-muted mt-10">{{ str_limit(strip_tags($answer->content),300) }}</p>
                <p class="text-muted">回答于 {{ timestamp_format($answer->created_at) }}</p>

            </div>
        </section>
        @endforeach
    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $answers->render()) !!}
    </div>
@endsection


