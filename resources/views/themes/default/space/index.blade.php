@extends('theme::layout.space')

@section('space_content')
    <h2 class="h4">最近动态</h2>
    <div class="steam-doing clearfix">
        @foreach($doings as $doing)
        <section class="steam-doing-item">
            <p class="steam-doing-item-info">{{ timestamp_format($doing->created_at) }} {{ $doing->action_text }}</p>
            <div class="steam-doing-item-title">
                <h4><a href="{{ route('ask.question.detail',['question_id'=>$doing->source_id]) }}">{{ $doing->subject }}</a></h4>
            </div>
            @if(in_array($doing->action,['answer']))
            <p class="steam-doing-item-quote">
                {{ $doing->content }}
            </p>
            @endif
        </section>
        @endforeach
    </div>
@endsection


