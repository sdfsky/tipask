@extends('theme::layout.space')

@section('space_content')
    <h2 class="h4">最近动态</h2>
    <div class="widget-active clearfix">

        @foreach($doings as $doing)
        <section class="widget-active__answer">
            <div class="widget-active--left">
                <span class="glyphicon glyphicon-comment"></span>
            </div>
            <div class="widget-active--right">
                <p class="widget-active--right__info">{{ timestamp_format($doing->created_at) }} {{ $doing->action_text }}
                </p>
                <div class="widget-active--right__title">
                    <h4><a href="{{ route('ask.question.detail',['question_id'=>$doing->source_id]) }}">{{ $doing->subject }}</a></h4>
                </div>
                @if(in_array($doing->action,['answer']))
                <p class="widget-active--right__quote">
                    {{ $doing->content }}
                </p>
                @endif
            </div>
        </section>
        @endforeach
    </div>
@endsection


