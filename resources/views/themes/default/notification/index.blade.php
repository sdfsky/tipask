@extends('theme::layout.public')

@section('seo_title')我的通知 - {{ Setting()->get('website_name') }}@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">
                我的通知
                <a href="{{ route('auth.notification.readAll') }}" class="btn btn-default btn-xs  ml-10">全部标记为已读</a>
            </h2>
            <div class="stream-list widget-notify border-top">
                @foreach($notifications as $notification)
                <section class="stream-list-item @if($notification->is_read==0) not_read @endif">
                    <a href="{{ route('auth.space.index',['user_id'=>$notification->user_id]) }}">{{ $notification->user->name }}</a> {{ $notification->type_text }}

                    @if(in_array($notification->type,['answer','follow_question','comment_question','invite_answer','adopt_answer']))
                        <a href="{{ route('ask.question.detail',['question_id'=>$notification->source_id]) }}" target="_blank">{{ $notification->subject }}</a>
                    @elseif(in_array($notification->type,['comment_answer']))
                        回答 <a href="{{ route('ask.answer.detail',['question_id'=>$notification->refer_id,'id'=>$notification->source_id]) }}" target="_blank">{{ str_limit($notification->subject,80) }}</a>
                    @elseif(in_array($notification->type,['comment_article']))
                        <a href="{{ route('blog.article.detail',['id'=>$notification->source_id]) }}" target="_blank">{{ $notification->subject }}</a>
                    @elseif(in_array($notification->type,['reply_comment']))
                        @if($notification->refer_type == 'question')
                            问题 <a href="{{ route('ask.question.detail',['question_id'=>$notification->source_id]) }}" target="_blank">{{ $notification->subject }}</a>
                        @elseif($notification->refer_type == 'answer')
                            回答 <a href="{{ route('ask.answer.detail',['question_id'=>$notification->refer_id,'id'=>$notification->source_id]) }}" target="_blank">{{ str_limit($notification->subject,80) }}</a>
                        @elseif($notification->refer_type == 'article')
                            文章 <a href="{{ route('blog.article.detail',['id'=>$notification->source_id]) }}" target="_blank">{{ $notification->subject }}</a>
                        @endif
                        中你的评论
                    @endif

                    <span class="text-muted ml-10">{{ timestamp_format($notification->created_at) }}</span>

                    @if($notification->content)
                        <blockquote class="text-fmt">{{ str_limit(strip_tags($notification->content),450) }}</blockquote>
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