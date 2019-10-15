@extends('theme::layout.public')

@section('seo_title')最新动态 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <ul class="nav nav-tabs mb-10 mt-20">
                <li @if($filter==='newest') class="active" @endif ><a href="{{ route('auth.doing.index') }}">最新的</a></li>
                <li @if($filter==='concerned') class="active" @endif><a href="{{ route('auth.doing.index',['filter'=>'concerned']) }}">关注的</a></li>
            </ul>
            <div class="widget-streams">
                @foreach($doings as $doing)
                <section class="hover-show streams-item">
                    <div class="stream-wrap media">
                        <div class="pull-left">
                            <a href="{{ route('auth.space.index',['user_id'=>$doing->user_id]) }}" target="_blank">
                                <img class="media-object avatar-40" src="{{ get_user_avatar($doing->user_id) }}" alt="{{ $doing->user->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="text-muted">
                                <a target="_blank" href="{{ route('auth.space.index',['user_id'=>$doing->user_id]) }}"> {{ $doing->user->name }}</a> {{ $doing->action_text }} ·
                                <time class="timeago">{{ timestamp_format($doing->created_at) }} </time>
                            </p>
                            <h2 class="h4 title"><a href="{{ route('ask.question.detail',['question_id'=>$doing->source_id]) }}" target="_blank">{{ $doing->subject }}</a></h2>
                            @if(in_array($doing->action,['answer','follow_question','append_reward']))
                                <div class="full-text fmt">
                                    {{ str_limit(strip_tags($doing->content),300) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endforeach
            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $doings->render()) !!}

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection