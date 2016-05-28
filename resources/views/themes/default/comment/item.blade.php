<div class="media">
    <div class="media-left">
        <a href="{{ route('auth.space.index',['user_id'=>$comment->user->id]) }}" target="_blank">
            <img class="media-object avatar-27" alt="{{ $comment->user->name }}" src="{{ route('website.image.avatar',['avatar_name'=>$comment->user->id.'_small'])}}" >
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
            <span class="text-muted">{{ timestamp_format($comment->created_at) }}</span>
            @if(Auth()->check() && $comment->user_id != Auth()->user()->id)
                <a href="#" class="ml-10 comment-reply" data-source_id="{{ $source_id }}" data-to_user_id="{{ $comment->user->id }}" data-source_type="{{ $source_type }}" data-message="回复 {{ $comment->user->name }}"><i class="fa fa-reply"></i> 回复</a>
            @endif
        </div>

    </div>
</div>



