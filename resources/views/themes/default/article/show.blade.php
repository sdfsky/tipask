@extends('theme::layout.public')

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question widget-article">
                <h3 class="title">
                    {{ $article->title }}
                </h3>



                @if($article->tags)
                    <ul class="taglist--inline">
                        @foreach($article->tags as $tag)
                            <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['name'=>$tag->name]) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                @endif

                <div class="content mt-10">
                    <div class="quote">
                         {{ $article->summary }}
                    </div>
                    <div class="text-fmt ">
                        {!! $article->content !!}
                    </div>
                    <div class="post-opt mt-10">
                        <ul class="list-inline">
                            <li class="text-muted">
                                <i class="fa fa-clock-o"></i>
                                发表于 {{ timestamp_format($article->created_at) }}
                            </li>
                            @if($article->status!==2 && Auth()->check() && (Auth()->user()->id === $article->user_id) )
                            <li><a href="{{ route('ask.question.edit',['id'=>$article->id]) }}" class="edit" data-toggle="tooltip" data-placement="right" title="" data-original-title="进一步完善文章内容"><i class="fa fa-edit"></i> 编辑</a></li>
                            @endif
                        </ul>
                    </div>

                </div>

            </div>

            <div class="widget-answers mt-15">
                <h2 class="h4 post-title">共 {{ $article->comments }} 条评论</h2>
                @include('theme::comment.collapse',['comment_source_type'=>'article','comment_source_id'=>$article->id,'hide_cancel'=>true])
            </div>

        </div>


        <div class="col-xs-12 col-md-3 side">
            <div class="widget-box">
                <div class="article-header media">
                    <a class="pull-left" href="http://www.tipaskx.com/people/11"><img class="media-object avatar-32" src="http://www.tipaskx.com/image/avatar/11_big" alt="不写代码的码农"></a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $article->user->name }}</h4>
                        <p>{{ $article->user->title }}</p>
                        <ul class="sn-inline">
                            <li>web前段</li>
                            <li>测试提问</li>
                            <li>hello</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <h2 class="h4 widget-box__title">相关问题</h2>
                <ul class="widget-links list-unstyled">
                    @foreach($relatedQuestions as $relatedQuestion)
                        @if($relatedQuestion->id != $article->id)
                        <li class="widget-links__item">
                            <a title="{{ $relatedQuestion->title }}" href="{{ route('ask.question.detail',['question_id'=>$relatedQuestion->id]) }}">{{ $relatedQuestion->title }}</a>
                            <small class="text-muted">{{ $relatedQuestion->answers }} 回答</small>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var article_id = "{{ $article->id }}";
            /*评论默认展开*/
            load_comments('article',article_id);
            $("#comments-article-"+article_id).collapse('show');

            /*评论提交*/
            $(".comment-btn").click(function(){
                var source_id = $(this).data('source_id');
                var source_type = $(this).data('source_type');
                var to_user_id = $(this).data('to_user_id');
                var token = $(this).data('token');
                var content = $("#comment-"+source_type+"-content-"+source_id).val();
                add_comment(token,source_type,source_id,content,to_user_id);
                $("#comment-content-"+source_id+"").val('');
            });

            /*收藏问题或文章*/
            $("#collect-button").click(function(){
                $("#collect-button").button('loading');
                var source_type = $(this).data('source_type');
                var source_id = $(this).data('source_id');
                var collection_num = $("#collection-num").html();
                $.get('/collect/'+source_type+'/'+source_id,function(msg){
                    $("#collect-button").removeClass('disabled');
                    $("#collect-button").removeAttr('disabled');
                    if(msg=='collected'){
                        $("#collect-button").html('已收藏');
                        $("#collection-num").html(parseInt(collection_num)+1);
                    }else{
                        $("#collect-button").html('收藏');
                        $("#collection-num").html(parseInt(collection_num)-1);
                    }
                });
            });

        });
    </script>
@endsection