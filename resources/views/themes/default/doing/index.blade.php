@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <div class="main--title">
                <h1 class="h4 text--stress title--top pull-left">最新动态</h1>
            </div>
            <div class="streams">

                @foreach($doings as $doing)
                <section class="hover-show streams__item">
                    <div class="stream-wrap media">
                        <div class="pull-left">
                            <a href="{{ route('auth.space.index',['user_id'=>$doing->user_id]) }}" target="_blank">
                                <img class="media-object avatar-40" src="{{ route('website.image.avatar',['avatar_name'=>$doing->user_id.'_middle'])}}" alt="{{ $doing->user->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <a data-toggle="tooltip" data-placement="left" title="" class="packup" href="javascript:;" data-original-title="收起"></a>

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
                    <div class="close-blur text-center hidden">
                        <a href="javascript:void(0);" type="button" class="close hover-show-obj"><span aria-hidden="true">×</span><span class="sr-only">Close</span></a>
                        <button class="streamUnfollow btn btn-default btn-sm mr10">停止接收  动态</button>
                        <button class="btn btn-default btn-sm streamDel">不再显示</button>
                    </div>
                </section>
                @endforeach
            </div>

            <div class="text-center">

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection