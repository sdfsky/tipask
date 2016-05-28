<div class="collapse widget-comments mb-20" id="comments-{{ $comment_source_type }}-{{ $comment_source_id }}" data-source_type="{{ $comment_source_type }}" data-source_id="{{ $comment_source_id }}">
    <div class="widget-comment-list"></div>
    @if(Auth()->check())
    <div class="widget-comment-form row">
            <form class="col-md-12" >
                <div class="form-group">
                    <textarea name="content" placeholder="写下你的评论" class="form-control" id="comment-{{ $comment_source_type }}-content-{{ $comment_source_id }}"></textarea>
                </div>
            </form>
            <div class="col-md-12 text-right">
                @if(!$hide_cancel )
                <a href="#" class="text-muted collapse-cancel" data-collapse_id="comments-{{ $comment_source_type }}-{{ $comment_source_id }}">取消</a>
                @endif
                <button type="submit" class="btn btn-primary btn-sm ml-10 comment-btn" id="{{ $comment_source_type }}-comment-{{ $comment_source_id }}-btn"  data-token="{{ csrf_token() }}" data-source_id="{{ $comment_source_id }}"  data-source_type="{{ $comment_source_type }}" data-to_user_id="0">提交评论</button>
            </div>
        </div>
    @else
        <div class="widget-comment-form row">
            <div class="col-md-12">
                请先 <a  href="{{ route('auth.user.login') }}">登录</a> 后评论
            </div>
        </div>
    @endif
</div>
