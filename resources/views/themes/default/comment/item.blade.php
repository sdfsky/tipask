<div class="media">
    <div class="media-left">
        <a href="{{ route('auth.space.index',['user_id'=>$comment->user->id]) }}" target="_blank">
            <img class="media-object avatar-27" alt="{{ $comment->user->name }}" src="{{ get_user_avatar($comment->user_id,'small') }}" >
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading">
            <a href="{{ route('auth.space.index',['user_id'=>$comment->user->id]) }}" target="_blank">{{ $comment->user->name }}</a>
            @if($comment->to_user_id)
                <span class="text-muted">回复 </span>
                <a href="{{ route('auth.space.index',['user_id'=>$comment->to_user_id]) }}" target="_blank">{{ $comment->toUser->name }}</a>
            @endif
        </div>
        <div class="content"><p>{{ $comment->content }}</p></div>
        <div class="media-footer">
            <ul class="list-inline text-muted">
                <li>
                    {{ timestamp_format($comment->created_at) }}
                </li>
                <li>
                    @if(Auth()->check() && $comment->user_id != Auth()->user()->id )
                        <a href="#" class="ml-10 comment-reply" data-source_id="{{ $source_id }}" data-to_user_id="{{ $comment->user->id }}" data-source_type="{{ $source_type }}" data-message="回复 {{ $comment->user->name }}"><i class="fa fa-reply"></i> 回复</a>
                    @endif
                </li>
                <li class="pull-right">
                    <button class="btn btn-default btn-xs btn-support" data-source_id="{{ $comment->id }}" data-source_type="comment" data-support_num="{{ $comment->supports }}"><i class="fa fa-thumbs-o-up"></i> {{ $comment->supports }}</button>
                </li>
            </ul>
        </div>

    </div>
</div>



