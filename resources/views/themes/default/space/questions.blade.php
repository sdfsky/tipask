@extends('theme::layout.space')

@section('space_content')
    <h2 class="h4">{{ $questions->total() }} 个提问</h2>
    <div class="stream-list border-top board">
        @foreach($questions as $question)
            <section class="stream-list__item">
                <div class="qa-rank">
                    <div class="answers">
                        {{ $question->answers }}<small>回答</small>
                    </div>
                    <div class="views">
                        {{ $question->views }}<small>浏览</small>
                    </div>
                </div>
                <div class="summary">
                    <p class="text-muted mb0">{{ timestamp_format($question->created_at) }}</p>
                    <h2 class="title">
                        <a href="{{ route('ask.question.detail',['question_id'=>$question->id]) }}">{{ $question->title }}</a>
                    </h2>
                    <ul class="taglist--inline ib">
                        <li class="tagPopup"><a class="tag tag-sm" href="/t/segmentfault" data-toggle="popover" data-original-title="segmentfault" data-id="1040000000089399">segmentfault</a></li>
                        <li class="tagPopup"><a class="tag tag-sm" href="/t/jsfiddle" data-toggle="popover" data-original-title="jsfiddle" data-id="1040000000169634">jsfiddle</a></li>
                        <li class="tagPopup"><a class="tag tag-sm" href="/t/https" data-toggle="popover" data-original-title="https" data-id="1040000000090541">https</a></li>
                    </ul>
                </div>
            </section>
        @endforeach
    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $questions->render()) !!}
    </div>
@endsection


