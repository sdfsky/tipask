@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <ul class="nav nav-tabs mt-30" roles="tablist">
                <li role="presentation" class="active"><a href="{{ route('auth.attention.sources',['source_type'=>'questions']) }}">收藏的问题</a></li>
                <li role="presentation"><a href="{{ route('auth.attention.sources',['source_type'=>'questions']) }}">收藏的文章</a></li>
            </ul>

            <div class="stream-list mt-10 widget-notify">

                @foreach($questions as $question)
                <section class="stream-list-item ">
                    <a href="http://www.tipaskx.com/question/24" target="_blank">{{ $question->subject }}</a>
                    <span class="text-muted ml-10">{{ timestamp_format($question->created_at) }}</span>
                </section>
                @endforeach
            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $questions->render()) !!}
            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection