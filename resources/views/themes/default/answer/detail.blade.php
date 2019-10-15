@extends('theme::layout.public')

@section('seo_title'){{ parse_seo_template('seo_question_title',$question) }}@endsection
@section('seo_keyword'){{ parse_seo_template('seo_question_keyword',$question) }}@endsection
@section('seo_description'){{ parse_seo_template('seo_question_description',$question) }}@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question">
                <h4 class="title">
                    @if($question->price>0)
                        <span class="text-gold">
                            <i class="fa fa-database"></i> {{ $question->price }}
                        </span>
                    @endif
                    {{ $question->title }}
                </h4>
                @if($question->tags)
                    <ul class="taglist-inline">
                        @foreach($question->tags as $tag)
                            <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['id'=>$tag->id]) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="description mt-10">
                    <div class="text-fmt ">
                        {!! $question->description !!}
                    </div>

                    <div class="post-opt mt-10">
                        <ul class="list-inline">
                            <li><a class="comments"  data-toggle="collapse"  href="#comments-question-{{ $question->id }}" aria-expanded="false" aria-controls="comment-{{ $question->id }}"><i class="fa fa-comment-o"></i> {{ $question->comments }} 条评论</a></li>
                            @if($question->status!==2 && Auth()->check() && (Auth()->user()->id === $question->user_id) )
                                <li><a href="{{ route('ask.question.edit',['id'=>$question->id]) }}" class="edit" data-toggle="tooltip" data-placement="right" title="" data-original-title="补充细节，以得到更准确的答案"><i class="fa fa-edit"></i> 编辑</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#appendReward"  ><i class="fa fa-database"></i> 追加悬赏</a></li>
                            @endif
                        </ul>
                    </div>

                    @include('theme::comment.collapse',['comment_source_type'=>'question','comment_source_id'=>$question->id,'hide_cancel'=>false])
                    @if(Setting()->get('website_share_code')!='')
                        <div class="mb-10">
                            {!! Setting()->get('website_share_code')  !!}
                        </div>
                    @endif
                </div>

            </div>
            <h2 class="title h5 mt-30 mb-20 post-title text-center">
                <a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">查看全部 {{ $question->answers }} 个回答</a>
            </h2>
            <div class="widget-answers mt-15">

                <div class="media">
                        <div class="media-left">
                            <a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="avatar-link user-card" target="_blank">
                                <img class="avatar-40 hidden-xs"  src="{{ get_user_avatar($answer->user_id,'middle') }}" alt="{{ $answer->user['name'] }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <strong><a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="mr-5 user-card">{{ $answer->user['name'] }}</a></strong>
                                @if($answer->user->title)
                                    <span class="text-muted"> - {{ $answer->user->title }}</span>
                                @endif
                                <span class="answer-time text-muted hidden-xs">{{ timestamp_format($answer->created_at) }}</span>
                            </div>
                            <div class="content">
                                <div class="text-fmt mt-10 mb-10">{!! $answer->content !!}</div>
                            </div>
                            <div class="media-footer">
                                <ul class="list-inline mb-20">
                                    <li><a class="comments"  data-toggle="collapse"  href="#comments-answer-{{ $answer->id }}" aria-expanded="false" aria-controls="comment-{{ $answer->id }}"><i class="fa fa-comment-o"></i> {{ $answer->comments }} 条评论</a></li>
                                    @if(Auth()->check())
                                        @if($question->status!==2 &&  (Auth()->user()->id === $answer->user_id  || Auth()->user()->can('admin.login')))
                                            <li><a href="{{ route('ask.answer.edit',['id'=>$answer->id]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="继续完善回答内容"><i class="fa fa-edit"></i> 编辑</a></li>
                                        @endif
                                        @if($question->status!==2 &&  (Auth()->user()->id === $question->user_id || Auth()->user()->can('admin.login') ))
                                            <li><a href="#" class="adopt-answer" data-toggle="modal" data-target="#adoptAnswer" data-answer_id="{{ $answer->id }}" data-answer_content="{{ str_limit($answer->content,200) }}"><i class="fa fa-check-square-o"></i> 采纳为最佳答案</a></li>
                                        @endif
                                    @endif
                                    <li class="pull-right">
                                        <button class="btn btn-default btn-sm btn-support" data-source_id="{{ $answer->id }}" data-source_type="answer"  data-support_num="{{ $answer->supports }}"><i class="fa fa-thumbs-o-up"></i> {{ $answer->supports }}</button>
                                    </li>
                                </ul>
                            </div>
                            @include('theme::comment.collapse',['comment_source_type'=>'answer','comment_source_id'=>$answer->id,'hide_cancel'=>false])
                        </div>
                    </div>
                <div class="text-center">
                    <h2 class="title h5 mt30 mb20 post-title">
                        <a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">查看全部 {{ $question->answers }} 个回答</a>
                    </h2>
                </div>

            </div>


        </div>

        <div class="col-xs-12 col-md-3 side">
            <div class="widget-box">
                <ul class="widget-action list-unstyled">
                    <li>
                        @if(Auth()->check() && Auth()->user()->isFollowed(get_class($question),$question->id))
                            <button type="button" id="follow-button" class="btn btn-success btn-sm active" data-source_type = "question" data-source_id = "{{ $question->id }}" data-show_num="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">已关注</button>
                        @else
                            <button type="button" id="follow-button" class="btn btn-success btn-sm" data-source_type = "question" data-source_id = "{{ $question->id }}" data-show_num="true"  data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">关注</button>
                        @endif
                        <strong id="follower-num">{{ $question->followers }}</strong> 关注
                    </li>
                    <li>
                        @if(Auth()->check() && Auth()->user()->isCollected(get_class($question),$question->id))
                            <button id="collect-button" class="btn btn-default btn-sm" data-loading-text="加载中..." data-source_type = "question" data-source_id = "{{ $question->id }}" > 已收藏</button>
                        @else
                            <button id="collect-button" class="btn btn-default btn-sm" data-source_type = "question" data-source_id = "{{ $question->id }}" > 收藏</button>
                        @endif
                        <strong id="collection-num">{{ $question->collections }}</strong> 收藏，<strong class="no-stress">{{ $question->views }}</strong> 浏览
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        @if($question->hide==0)
                            <a href="{{ route('auth.space.index',['user_id'=>$question->user_id]) }}" target="_blank">{{ $question->user->name }}</a>
                        @endif
                        提出于 {{ timestamp_format($question->created_at) }}</li>
                </ul>
            </div>
            <div class="widget-box">
                <h2 class="h4 widget-box__title">相似问题</h2>
                <ul class="widget-links list-unstyled list-text">
                    @foreach($relatedQuestions as $relatedQuestion)
                        @if($relatedQuestion->id != $question->id)
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

    @if(Auth()->check())
        <div class="modal" id="appendReward" tabindex="-1" role="dialog" aria-labelledby="appendRewardLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="appendModalLabel">追加悬赏</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert" id="rewardAlert">
                            <i class="fa fa-exclamation-circle"></i> 提高悬赏，以提高问题的关注度！
                        </div>

                        <form class="form-inline" id="rewardForm" action="{{ route('ask.question.appendReward',['id'=>$question->id]) }}" method="post">
                            <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="reward">追加</label>
                                <select class="form-control" name="coins" id="question_coins">
                                    <option value="3" selected>3</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="30">30</option><option value="50">50</option><option value="80">80</option><option value="100">100</option>
                                </select> 个金币
                            </div>
                            <div class="form-group">
                                （您目前共有 <span class="text-gold">{{ Auth()->user()->userData->coins }}</span> 个金币）
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="appendRewardSubmit">确认追加</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="adoptAnswer" tabindex="-1" role="dialog" aria-labelledby="adoptAnswerLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="adoptModalLabel">采纳回答</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert" id="adoptAnswerAlert">
                            <i class="fa fa-exclamation-circle"></i> 确认采纳该回答为最佳答案？
                        </div>
                        <blockquote id="answer_quote"></blockquote>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="adoptAnswerSubmit">采纳该回答</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            @if(Auth()->check())
            /*问题悬赏*/
            $("#appendRewardSubmit").click(function(){
                var user_total_conis = '{{ Auth()->user()->userData->coins }}';
                var reward = $("#question_coins").val();

                if(reward>parseInt(user_total_conis)){
                    $("#rewardAlert").attr('class','alert alert-warning');
                    $("#rewardAlert").html('金币数不能大于'+user_total_conis);
                }else{
                    $("#rewardAlert").empty();
                    $("#rewardAlert").attr('class','');
                    $("#rewardForm").submit();
                }
            });
            @endif


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


            $(".widget-comments").on('show.bs.collapse', function () {
                load_comments($(this).data('source_type'),$(this).data('source_id'));
            });

            $(".widget-comments").on('hide.bs.collapse', function () {
                clear_comments($(this).data('source_type'),$(this).data('source_id'));
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



            /*采纳回答为最佳答案*/
            $(".adopt-answer").click(function(){
                var answer_id = $(this).data('answer_id');
                $("#adoptAnswerSubmit").attr('data-answer_id',answer_id);
                $("#answer_quote").html($(this).data('answer_content'));
            });


            $("#adoptAnswerSubmit").click(function(){
                document.location = "/answer/adopt/"+$(this).data('answer_id');
            });


        });
    </script>
@endsection