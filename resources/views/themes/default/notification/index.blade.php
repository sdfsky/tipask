@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4 mt0 mb20">
                我的通知
                <a href="{{ route('auth.notification.readAll') }}" class="btn btn-default btn-xs  ml-10">全部标记为已读</a>
            </h2>
            <div class="stream-list widget-notify border-top">
                @foreach($notifications as $notification)
                <section class="stream-list-item @if($notification->is_read==0) not_read @endif">
                    <a href="{{ route('auth.space.index',['user_id'=>$notification->user_id]) }}">{{ $notification->user->name }}</a> {{ $notification->type_text }}
                    @if(in_array($notification->type,['answer','comment_question','comment_answer','comment_user']))
                    <a href="{{ route('ask.question.detail',['question_id'=>$notification->source_id]) }}" target="_blank">{{ $notification->subject }}</a>
                        @if($notification->type == 'comment_answer')
                            中你的回答
                        @elseif($notification->type == 'comment_user')
                            中你的评论
                        @endif
                    @endif
                    <span class="text-muted ml-10">{{ timestamp_format($notification->created_at) }}</span>

                    @if($notification->refer_content)
                    <blockquote class="text-fmt">{{ str_limit(strip_tags($notification->refer_content),300) }}</blockquote>
                    @endif

                </section>
                @endforeach
            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $notifications->render()) !!}
            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection