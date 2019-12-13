@foreach($comments as $comment)
    @include('theme::comment.item')
@endforeach

@if($comments->count()>0)
<div class="text-center mb-20 mt-20">
    @if($comments->hasMorePages())
        <button type="button" class="btn btn-default btn-sm btn-block load-more" data-loading-text="加载中..." data-source_type="{{ $source_type }}" data-source_id="{{ $source_id }}" data-next_page_url="{{ $comments->nextPageUrl() }}" >
            加载更多评论
        </button>
    @elseif($comments->currentPage()>1)
        <button type="button"   class="btn btn-default btn-sm btn-block disabled" disabled="disabled">
            没有更多内容
        </button>
    @endif
</div>
@endif
<script type="text/javascript">
    $(function(){
        $(".widget-comment-list .btn-support").on("click",function(){
            var btn_support = $(this);
            var source_type = btn_support.data('source_type');
            var source_id = btn_support.data('source_id');
            var support_num = parseInt(btn_support.data('support_num'));
            $.get('/support/'+source_type+'/'+source_id,function(msg){
                console.log(msg);
                if(msg =='success'){
                    support_num++
                }
                btn_support.html('<i class="fa fa-thumbs-o-up"></i> '+support_num);
                btn_support.data('support_num',support_num);
            });
        })
    })
</script>

