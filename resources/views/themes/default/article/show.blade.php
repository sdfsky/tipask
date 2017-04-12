@extends('theme::layout.public')

@section('seo_title'){{ parse_seo_template('seo_article_title',$article) }}@endsection
@section('seo_keyword'){{ parse_seo_template('seo_article_keyword',$article) }}@endsection
@section('seo_description'){{ parse_seo_template('seo_article_description',$article) }}@endsection
@section('css')
    <link href="{{ asset('/static/js/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question widget-article">
                <h3 class="title">{{ $article->title }}</h3>
                @if($article->tags)
                    <ul class="taglist-inline">
                        @foreach($article->tags as $tag)
                            <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['id'=>$tag->id]) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="content mt-10">
                    <div class="quote mb-20">
                         {{ $article->summary }}
                    </div>
                    <div class="text-fmt">
                        {!! $article->content !!}
                    </div>
                    <div class="post-opt mt-30">
                        <ul class="list-inline text-muted">
                            <li>
                                <i class="fa fa-clock-o"></i>
                                发表于 {{ timestamp_format($article->created_at) }}
                            </li>
                            <li>阅读 ( {{$article->views}} )</li>
                            @if($article->category)
                            <li>分类：<a href="{{ route('website.blog',['category_slug'=>$article->category->slug]) }}" target="_blank">{{ $article->category->name }}</a>
                            @endif
                            </li>
                            @if($article->status !== 2 && Auth()->check() && (Auth()->user()->id === $article->user_id || Auth()->user()->is('admin') ) )
                            <li><a href="{{ route('blog.article.edit',['id'=>$article->id]) }}" class="edit" data-toggle="tooltip" data-placement="right" title="" data-original-title="进一步完善文章内容"><i class="fa fa-edit"></i> 编辑</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="text-center mt-10 mb-20">

                    <button id="support-button" class="btn btn-success btn-lg mr-5" data-source_id="{{ $article->id }}" data-source_type="article"  data-support_num="{{ $article->supports }}">{{ $article->supports }} 推荐</button>
                    @if($article->user->qrcode)
                        <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#payment-qrcode-modal-article-{{ $article->id  }}" ><i class="fa fa-heart-o" aria-hidden="true"></i> 打赏</button>
                    @endif
                    @if(Auth()->check() && Auth()->user()->isCollected(get_class($article),$article->id))
                        <button id="collect-button" class="btn btn-default btn-lg" data-loading-text="加载中..." data-source_type = "article" data-source_id = "{{ $article->id }}" > 已收藏</button>
                    @else
                        <button id="collect-button" class="btn btn-default btn-lg" data-loading-text="加载中..." data-source_type = "article" data-source_id = "{{ $article->id }}" > 收藏</button>
                    @endif
                </div>
                @if(Setting()->get('website_share_code')!='')
                <div class="mb-10">
                    {!! Setting()->get('website_share_code')  !!}
                </div>
                @endif
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
                    <a class="pull-left" href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}"><img class="media-object avatar-64" src="{{ get_user_avatar($article->user_id) }}" alt="不写代码的码农"></a>
                    <div class="media-body ">
                        <a href="{{ route('auth.space.index',['user_id'=>$article->user_id]) }}" class="media-heading">{{ $article->user->name }}</a>
                        @if($article->user->title)
                        <p class="text-muted">{{ $article->user->title }}</p>
                        @endif
                        <p class="text-muted">{{ $article->user->userData->articles }} 篇文章</p>
                    </div>
                </div>
            </div>
            <div class="widget-box mt-30">
                <h2 class="widget-box-title">
                    作家榜
                    <a href="{{ route('auth.top.articles') }}" title="更多">»</a>
                </h2>
                <ol class="widget-top10">
                    @foreach($topUsers as $index => $topUser)
                        <li class="text-muted">
                            <img class="avatar-32" src="{{ get_user_avatar($topUser['id'],'middle') }}">
                            <a href="{{ route('auth.space.index',['user_id'=>$topUser['id']]) }}" class="ellipsis">{{ $topUser['name'] }}</a>
                            <span class="text-muted pull-right">{{ $topUser['articles'] }} 文章</span>
                        </li>
                    @endforeach

                </ol>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('theme::layout.qrcode_pament',['source_id'=>'article-'.$article->id,'paymentUser'=>$article->user,'message'=>'如果觉得我的文章对您有用，请随意打赏。你的支持将鼓励我继续创作！'])
    <script type="text/javascript" src="{{ asset('/static/js/fancybox/jquery.fancybox.min.js') }}"></script>
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