@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">
                我的私信
                <a href="{{ route('auth.notification.readAll') }}" class="btn btn-primary btn-xs pull-right">写消息</a>
            </h2>
            <div class="widget-streams messages">
                @foreach($messages as $message)
                <section class="hover-show streams-item @if($message->is_read===0) not_read @endif ">
                    <div class="stream-wrap media">
                        <div class="pull-left">
                            <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}" >
                                <img class="media-object avatar-40" src="{{ route('website.image.avatar',['avatar_name'=>$message->from_user_id.'_middle']) }}" alt="{{ $message->fromUser->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}"> {{ $message->fromUser->name }}</a> :
                            <div class="full-text fmt">{{ $message->content }}</div>
                            <div class="meta mt-10">
                                <span class="text-muted">{{ timestamp_format($message->created_at) }}</span>
                                <span class="pull-right">
                                    <a href="{{ route('auth.message.show',['use_id'=>$message->from_user_id]) }}">查看对话详情</a> <span class="span-line">|</span>
                                    <a href="javascript:;" class="text-muted" onclick="#">删除</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
             @endforeach
            </div>
            <div class="text-center">
                {!! str_replace('/?', '?', $messages->render()) !!}

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection