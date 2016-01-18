@extends('theme::layout.public')

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question widget-article">
                <h3 class="title">{{ $article->title }}</h3>
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
                <div class="text-center mt-10 mb-20">

                    <button id="support-button" class="btn btn-success btn-lg mr-5" data-source_id="{{ $article->id }}" data-source_type="article"  data-support_num="{{ $article->supports }}">{{ $article->supports }} 推荐</button>

                    @if(Auth()->check() && Auth()->user()->isCollected(get_class($article),$article->id))
                        <button id="collect-button" class="btn btn-default btn-lg" data-loading-text="加载中..." data-source_type = "article" data-source_id = "{{ $article->id }}" > 已收藏</button>
                    @else
                        <button id="collect-button" class="btn btn-default btn-lg" data-loading-text="加载中..." data-source_type = "article" data-source_id = "{{ $article->id }}" > 收藏</button>
                    @endif
                </div>
            </div>
            <div class="widget-relation">
                <div class="row">
                    <div class="col-md-6">
                        <h4>你可能感兴趣的文章</h4>
                        <ul class="widget-links list-unstyled">
                            @foreach($relatedArticles as $relatedArticle)
                                @if($relatedArticle->id != $article->id)
                                    <li class="widget-links-item">
                                        <a title="{{ $relatedArticle->title }}" href="{{ route('blog.article.detail',['article_id'=>$relatedArticle->id]) }}">{{ $relatedArticle->title }}</a>
                                        <small class="text-muted">{{ $relatedArticle->views }} 浏览</small>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4>相关问题</h4>
                        <ul class="widget-links list-unstyled">
                            @foreach($relatedQuestions as $relatedQuestion)
                                @if($relatedQuestion->id != $article->id)
                                    <li class="widget-links-item">
                                        <a title="{{ $relatedQuestion->title }}" href="{{ route('ask.question.detail',['question_id'=>$relatedQuestion->id]) }}">{{ $relatedQuestion->title }}</a>
                                        <small class="text-muted">{{ $relatedQuestion->answers }} 回答</small>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <div class="widget-answers mt-15">
                <h2 class="h4 post-title">{{ $article->comments }} 条评论</h2>
                @include('theme::comment.collapse',['comment_source_type'=>'article','comment_source_id'=>$article->id,'hide_cancel'=>true])
            </div>

        </div>

        <div class="col-xs-12 col-md-3 side">
            <div class="widget-user">
                <div class="media">
                    <a class="pull-left" href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}"><img class="media-object avatar-64" src="http://www.tipaskx.com/image/avatar/11_big" alt="不写代码的码农"></a>
                    <div class="media-body ">
                        <a href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}" class="media-heading">{{ $article->user->name }}</a>
                        @if($article->user->title)
                        <p class="text-muted">{{ $article->user->title }}</p>
                        @endif
                        <p class="text-muted">{{ $article->user->userData->articles }} 篇文章</p>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <h2 class="h4 widget-box-title">相关问题</h2>
                <ul class="widget-links list-unstyled">
                    @foreach($relatedQuestions as $relatedQuestion)
                        @if($relatedQuestion->id != $article->id)
                        <li class="widget-links-item">
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


            /*文章推荐*/
            $("#support-button").click(function() {
                var btn_support = $(this);
                var source_type = btn_support.data('source_type');
                var source_id = btn_support.data('source_id');
                var support_num = parseInt(btn_support.data('support_num'));
                $.get('/support/' + source_type + '/' + source_id, function (msg) {
                    if (msg == 'success') {
                        support_num++
                    }
                    btn_support.html(support_num+' 已推荐');
                    btn_support.data('support_num', support_num);
                });
            });



            /*收藏问题或文章*/
            $("#collect-button").click(function(){
                $("#collect-button").button('loading');
                var source_type = $(this).data('source_type');
                var source_id = $(this).data('source_id');
                $.get('/collect/'+source_type+'/'+source_id,function(msg){
                    $("#collect-button").removeClass('disabled');
                    $("#collect-button").removeAttr('disabled');
                    if(msg=='collected'){
                        $("#collect-button").html('已收藏');
                    }else{
                        $("#collect-button").html('收藏');
                    }
                });
            });



        });
    </script>
@endsection