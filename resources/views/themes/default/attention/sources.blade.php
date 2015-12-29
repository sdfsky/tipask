@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <ul class="nav nav-tabs" roles="tablist">
                <li role="presentation" class="active"><a href="{{ route('auth.attention.sources',['source_type'=>'questions']) }}">我关注的问题</a></li>
            </ul>
            <div class="stream-list question-stream">
                @foreach($questions as $question)

                    <section class="stream-list-item">

                        <div class="bookmark-rank">
                            <div class="answers">
                                {{ $question->answers }}<small>回答</small>
                            </div>
                            <div class="followers">
                                {{ $question->followers }} <small>关注</small>
                            </div>
                        </div>

                        <div class="summary">
                            <ul class="author list-inline">
                                <li>
                                    <a href="{{ route('auth.space.index',['user_id'=>$question->user->id]) }}">{{ $question->user->name }}</a>
                                    <span class="split"></span>
                                    {{ timestamp_format($question->created_at) }}
                                </li>
                                <li class="pull-right">
                                    <a href="#" class="cancel-follow ml10" data-id="1010000000350507" data-title="javascript是面向对象的，怎么体现javascript的继承关系？" data-do="follow/cancel" data-type="question">取消关注</a>
                                </li>
                            </ul>
                            <h2 class="title">
                                <a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a>
                            </h2>
                            @if($question->tags)
                                <ul class="taglist--inline ib">
                                    @foreach($question->tags() as $tag_name)
                                        <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['name'=>$tag_name]) }}">{{ $tag_name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
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