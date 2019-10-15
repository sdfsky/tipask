@extends('theme::layout.public')

@section('seo_title')发私信给{{ $toUser->name }} - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <div class="mt-10 text-muted">
                <span>发私信给 <a  href="{{ route('auth.space.index',['id'=>$toUser->id]) }}">{{ $toUser->name }}</a> ： </span>
                <span class="pull-right"><a href="{{ route('auth.message.index') }}" class="text-muted"><i class="fa fa-reply"></i> 返回</a></span>
            </div>
            <div class="mt-15 clearfix">
                <form id="messageForm" method="POST" role="form" action="{{ route('auth.message.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="to_user_id" value="{{ $toUser->id }}" />
                    <div class="form-group">
                        <textarea name="content" id="message_content" placeholder="请输入私信内容" class="form-control" style="height:100px;"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">发&nbsp;&nbsp;送</button>
                    </div>
                </form>
            </div>

            <div class="widget-streams messages mt-15 border-top">
                    @foreach($messages as $message)
                    <section class="hover-show streams-item" id="message_{{ $message->id }}">
                    @if($message->from_user_id == Auth()->user()->id)
                        <div class="stream-wrap media">
                            <div class="pull-left">
                                <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}" target="_blank">
                                    <img class="media-object avatar-40" src="{{ get_user_avatar($message->from_user_id) }}" alt="我">
                                </a>
                            </div>
                            <div class="media-body">
                                我 :
                                <div class="full-text fmt">{{ $message->content }}</div>
                                <div class="meta mt-10">
                                    <span class="text-muted">{{ timestamp_format($message->created_at) }} </span>
                                    <span class="pull-right">
                                        <a href="javascript:void(0)" class="text-muted" onclick="delete_message({{ $message->id }})">删除</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                       @else
                        <div class="stream-wrap media">
                            <div class="pull-left">
                                <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}" target="_blank">
                                    <img class="media-object avatar-40" src="{{ get_user_avatar($message->from_user_id) }}" alt="{{ $toUser->name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <a target="_blank" href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}"> {{ $toUser->name }}</a> :
                                <div class="full-text fmt">{{ $message->content }}</div>
                                <div class="meta mt-10">
                                    <span class="text-muted">{{ timestamp_format($message->created_at) }} </span>
                                <span class="pull-right">
                                    <a href="javascript:void(0)" class="text-muted" onclick="delete_message({{ $message->id }})">删除</a>
                                </span>
                                </div>
                            </div>
                        </div>
                       @endif
                    </section>
                @endforeach
            </div>
            <div class="text-center">
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    function delete_message(message_id)
    {
        if(!confirm('确认删除该信息？')){
            return false;
        }

        $.get('/message/destroy/'+message_id,function(msg){
            if(msg === 'ok'){
                $("#message_"+message_id).remove();
            }else{
                alert('操作失败，请稍后再试！');
            }
        });

    }
</script>
@endsection