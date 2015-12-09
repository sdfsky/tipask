@extends('theme::layout.space')

@section('space_content')
    <h2 class="h4">{{ $answers->total() }} 个回答</h2>
    <div class="stream-list board border-top">
        @foreach($answers as $answer)
        <section class="stream-list__item">
            <div class="qa-rank">
                <div class="votes">
                    {{ $answer->supports }}<small>赞同</small>
                </div>
            </div>
            <div class="summary">
                <h2 class="title"><a href="{{ route('ask.question.detail',['question_id'=>$answer->question_id]) }}" title="{{ $answer->question_title }}">{{ str_limit($answer->question_title,60) }}</a></h2>
                <p class="text-muted mb0">{{ str_limit(strip_tags($answer->content),300) }}</p>
                <p class="text-muted mb0">回答于 {{ timestamp_format($answer->created_at) }}</p>

            </div>
        </section>
        @endforeach
    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $answers->render()) !!}
    </div>
@endsection


