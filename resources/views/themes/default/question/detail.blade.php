@extends('theme::layout.public')

@section('seo_title'){{ parse_seo_template('seo_question_title',$question) }}@endsection
@section('seo_keyword'){{ parse_seo_template('seo_question_keyword',$question) }}@endsection
@section('seo_description'){{ parse_seo_template('seo_question_description',$question) }}@endsection

@section('css')
    <link href="{{ asset('/static/js/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
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
                            @if(Auth()->check())
                                @if(($question->status !== 2 && Auth()->user()->id === $question->user_id) || Auth()->user()->is('admin') )
                                <li><a href="{{ route('ask.question.edit',['id'=>$question->id]) }}" class="edit" data-toggle="tooltip" data-placement="right" title="" data-original-title="补充细节，以得到更准确的答案"><i class="fa fa-edit"></i> 编辑</a></li>
                                @endif
                                @if( $question->status !== 2 && Auth()->user()->id === $question->user_id )
                                <li><a href="#" data-toggle="modal" data-target="#appendReward"  ><i class="fa fa-database"></i> 追加悬赏</a></li>
                                @endif
                                @if( $question->status !== 2 )
                                    <li><a href="#" data-toggle="modal" data-target="#inviteAnswer"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> 邀请回答</a></li>
                                @endif
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


                {{--最佳答案--}}
                @if($question->status===2 && $bestAnswer)
                <div class="best-answer mt-10">
                    <div class="trophy-title">
                        <h3>
                            <i class="fa fa-trophy"></i> 最佳答案
                            <span class="pull-right text-muted adopt_time">{{ timestamp_format($bestAnswer->created_at) }}</span>
                        </h3>
                    </div>
                    <div class="text-fmt">
                        {!! $bestAnswer->content !!}
                    </div>
                    <div class="options clearfix mt-10">
                        <ul class="list-inline pull-right">
                            <li class="pull-right">
                                <a class="comments mr-10" data-toggle="collapse" href="#comments-answer-{{ $bestAnswer->id }}" aria-expanded="false" aria-controls="comment-{{ $bestAnswer->id }}"><i class="fa fa-comment-o"></i> {{ $bestAnswer->comments }} 条评论</a>
                                <button class="btn btn-default btn-sm btn-support" data-source_id="{{ $bestAnswer->id }}" data-source_type="answer" data-support_num="{{ $bestAnswer->supports }}"><i class="fa fa-thumbs-o-up"></i> {{ $bestAnswer->supports }}</button>
                                @if($bestAnswer->user->qrcode)
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#payment-qrcode-modal-answer-{{ $bestAnswer->id }}" ><i class="fa fa-heart-o" aria-hidden="true"></i> 打赏</button>
                                @endif
                            </li>
                        </ul>
                    </div>
                    @include('theme::comment.collapse',['comment_source_type'=>'answer','comment_source_id'=>$bestAnswer->id,'hide_cancel'=>false])
                    @if($bestAnswer->user->qrcode)
                        @include('theme::layout.qrcode_pament',['source_id'=>'answer-'.$bestAnswer->id,'paymentUser'=>$bestAnswer->user,'message'=>'如果觉得我的回答对您有用，请随意打赏。你的支持将鼓励我继续创作！'])
                    @endif
                    <div class="media user-info border-top">
                        <div class="media-left">
                            <a href="{{ route('auth.space.index',['user_id'=>$bestAnswer->user_id]) }}" target="_blank">
                                <img class="avatar-40 hidden-xs"  src="{{ get_user_avatar($bestAnswer->user_id) }}" alt="{{ $bestAnswer->user->name }}"></a>
                            </a>
                        </div>
                        <div class="media-body">

                            <div class="media-heading">
                                <strong><a href="{{ route('auth.space.index',['user_id'=>$bestAnswer->user_id]) }}" class="mr5">{{ $bestAnswer->user->name }}</a> <span class="text-gold">@if($bestAnswer->user->authentication && $bestAnswer->user->authentication->status === 1)<i class="fa fa-graduation-cap" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="已通过行家认证"></i>@endif</span></strong>
                                @if($bestAnswer->user->title)
                                    <span class="text-muted"> - {{ $bestAnswer->user->title }}</span>
                                @endif
                            </div>

                            <div class="content">
                                <span class="answer-time text-muted hidden-xs">@if($bestAnswer->user->authentication && $bestAnswer->user->authentication->status === 1)擅长：{{ $bestAnswer->user->authentication->skill }} | @endif 采纳率 {{ $bestAnswer->user->userData->adoptPercent() }}% | 回答于 {{ timestamp_format($bestAnswer->created_at) }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                @endif
            </div>

            <div class="widget-answers mt-15">
                <div class="btn-group pull-right" role="group">
                    <a href="{{ route('ask.question.detail',['question_id'=>$question->id]) }}" class="btn btn-default btn-xs @if(request()->input('sort','default')=='default') active @endif">默认排序</a>
                    <a href="{{ route('ask.question.detail',['question_id'=>$question->id,'sort'=>'created_at']) }}" id="sortby-created" class="btn btn-default btn-xs @if(request()->input('sort','default')=='created_at') active @endif">时间排序</a>
                </div>

                <h2 class="h4 post-title">@if($question->status===2) 其它 @endif {{ $answers->total() }} 个回答</h2>

                @foreach( $answers as $answer )
                <div class="media">
                    <div class="media-left">
                        <a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="avatar-link user-card" target="_blank">
                            <img class="avatar-40 hidden-xs"  src="{{ get_user_avatar($answer->user_id) }}" alt="{{ $answer->user['name'] }}"></a>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <strong>
                                <a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="mr-5 user-card">{{ $answer->user['name'] }}</a><span class="text-gold">@if($answer->user->authentication && $answer->user->authentication->status === 1)<i class="fa fa-graduation-cap" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="已通过行家认证"></i>@endif
                                </span>
                            </strong>
                            @if($answer->user->title)
                            <span class="text-muted"> - {{ $answer->user->title }}</span>
                            @endif
                            <span class="answer-time text-muted hidden-xs">{{ timestamp_format($answer->created_at) }}</span>
                        </div>
                        <div class="content">
                            @if($answer->user->authentication && $answer->user->authentication->status === 1)
                                <span class="text-muted">擅长：{{ $answer->user->authentication->skill }}</span>
                            @endif
                            <p>{!! $answer->content !!}</p>
                        </div>
                        <div class="media-footer">
                            <ul class="list-inline mb-20">
                                <li><a class="comments"  data-toggle="collapse"  href="#comments-answer-{{ $answer->id }}" aria-expanded="false" aria-controls="comment-{{ $answer->id }}"><i class="fa fa-comment-o"></i> {{ $answer->comments }} 条评论</a></li>
                                @if(Auth()->check())
                                    @if($question->status!==2 &&  (Auth()->user()->id === $answer->user_id  || Auth()->user()->is('admin')) )
                                    <li><a href="{{ route('ask.answer.edit',['id'=>$answer->id]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="继续完善回答内容"><i class="fa fa-edit"></i> 编辑</a></li>
                                    @endif
                                    @if($question->status!==2 &&  ( Auth()->user()->id === $question->user_id || Auth()->user()->is('admin') ))
                                    <li><a href="#" class="adopt-answer" data-toggle="modal" data-target="#adoptAnswer" data-answer_id="{{ $answer->id }}" data-answer_content="{{ str_limit($answer->content,200) }}"><i class="fa fa-check-square-o"></i> 采纳</a></li>
                                    @endif
                                    @if($answer->user->qrcode)
                                        <li><a href="#" data-toggle="modal" data-target="#payment-qrcode-modal-answer-{{ $answer->id }}" ><i class="fa fa-heart-o" aria-hidden="true"></i> 打赏</a></li>
                                    @endif
                                @endif
                                <li class="pull-right">
                                    <button class="btn btn-default btn-sm btn-support" data-source_id="{{ $answer->id }}" data-source_type="answer"  data-support_num="{{ $answer->supports }}"><i class="fa fa-thumbs-o-up"></i> {{ $answer->supports }}</button>
                                </li>
                            </ul>
                        </div>
                        @include('theme::comment.collapse',['comment_source_type'=>'answer','comment_source_id'=>$answer->id,'hide_cancel'=>false])
                        @if($answer->user->qrcode)
                            @include('theme::layout.qrcode_pament',['source_id'=>'answer-'.$answer->id,'paymentUser'=>$answer->user,'message'=>'如果觉得我的回答对您有用，请随意打赏。你的支持将鼓励我继续创作！'])
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="text-center">
                    {!! str_replace('/?', '?', $answers->render()) !!}
                </div>

            </div>
            @if($question->status!==2)
            <div class="widget-answer-form mt-15">

                @if(Auth()->guest())
                    <div class="answer_login_tips mb-20">
                        您需要登录后才可以回答问题，<a href="{{ route('auth.user.login') }}" rel="nofollow">登录</a>&nbsp;或者&nbsp;<a rel="nofollow" href="{{ route('auth.user.register') }}">注册</a>
                    </div>
                @elseif( Auth()->check() && ($question->user_id !== Auth()->user()->id && !Auth()->user()->isAnswered($question->id)) )
                    <form  name="answerForm" id="answer_form" action="{{ route('ask.answer.store') }}" method="post" class="editor-wrap">
                        <input type="hidden" id="answer_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" value="{{ $question->id }}" id="question_id" name="question_id" />
                        <div class="form-group  @if($errors->has('content')) has-error @endif">
                            <div id="answer_editor">{!! old('content','') !!}</div>
                            @if($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
                        </div>

                        <div class="row mt-20">
                            <div class="col-xs-12 col-md-10">
                                <ul class="list-inline">
                                        <li class="checkbox"> <label><input type="checkbox" id="attendTo" name="followed" value="1" checked />关注该问题</label></li>
                                    @if( Setting()->get('code_create_answer') )
                                        <li class="pull-right">
                                            <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                                                <input type="text" class="form-control" name="captcha" required="" placeholder="验证码" />
                                                @if ($errors->first('captcha'))
                                                    <span class="help-block">{{ $errors->first('captcha') }}</span>
                                                @endif
                                                <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input type="hidden" id="answer_editor_content"  name="content" value="{{ old('content','') }}"  />
                                <button type="submit" class="btn btn-primary pull-right">提交回答</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            @endif

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
    <div class="modal" id="inviteAnswer" tabindex="-1" role="dialog" aria-labelledby="inviteAnswerLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="appendModalLabel">邀请回答</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert" id="rewardAlert">
                        <i class="fa fa-exclamation-circle"></i> 不知道答案？你还可以邀请他人进行解答，每天可以邀请{{ config('tipask.user_invite_limit') }}次。
                    </div>
                    <form class="invite-popup" id="inviteEmailForm"  action="{{ route('ask.question.inviteEmail',['question_id'=>$question->id]) }}" method="get">
                        <div style="position: relative;">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-by="username" href="#by-username" data-toggle="tab">站内邀请</a></li>
                                <li><a data-by="email" href="#by-email" data-toggle="tab">Email 邀请</a></li>
                            </ul>
                            <div class="tab-content invite-tab-content mt-10">
                                <div class="tab-pane active" id="by-username" data-type="username">
                                    <div class="search-user" id="questionSlug">
                                        <input id="invite_word" class="text-28 form-control" type="text" name="word" autocomplete="off" placeholder="搜索你要邀请的人">
                                    </div>
                                    <p class="help-block" id="questionInviteUsers"></p>
                                    <div class="invite-question-modal">
                                        <div class="row invite-question-list" id="invite_user_list">
                                            <div class="text-center" id="invite_loading">
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="by-email" data-type="email">
                                    <div class="mb-10">
                                        <input class="text-28 form-control" type="email" name="sendTo" placeholder="Email 地址">
                                    </div>
                                    <p><textarea class="textarea-13 form-control" name="message" rows="5">我在 {{ Setting()->get('website_name') }} 上遇到了问题「{{ $question->title }}」 → {{ route('ask.question.detail',['question_id'=>$question->id]) }}，希望您能帮我解答 </textarea></p>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer" style="display:none;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary invite-email-btn">确认</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.min.js') }}"></script>
    <link href="{{ asset('/static/js/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
    <script type="text/javascript">
        var invitation_timer = null;
        var question_id = "{{ $question->id }}";
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

            /*回答编辑器初始化*/
            $('#answer_editor').summernote({
                lang: 'zh-CN',
                height: 160,
                placeholder:'撰写答案',
                toolbar: [ {!! config('tipask.summernote.ask') !!} ],
                callbacks: {
                    onChange:function (contents, $editable) {
                        var code = $(this).summernote("code");
                        $("#answer_editor_content").val(code);
                    },
                    onImageUpload:function(files) {
                        upload_editor_image(files[0],'answer_editor');
                    }
                }
            });

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

            /*邀请回答模块逻辑处理*/
            /*私信模块处理*/

            $('#inviteAnswer').on('show.bs.modal', function (event) {

                var button = $(event.relatedTarget);
                var modal = $(this);
                loadInviteUsers(question_id,'');
                loadQuestionInvitedUsers(question_id,'part');

            });


            $("#invite_word").on("keydown",function(){
                if(invitation_timer){
                    clearTimeout(invitation_timer);
                }
                invitation_timer = setTimeout(function() {
                    var word = $("#invite_word").val();
                    console.log(word);
                    loadInviteUsers(question_id,word);
                }, 500);
            });

            $(".invite-question-list").on("click",".invite-question-item-btn",function(){
                var invite_btn = $(this);
                var question_id = invite_btn.data('question_id');
                var user_id = invite_btn.data('user_id');

                $.ajax({
                    type: "get",
                    url:"/question/invite/"+question_id+"/"+user_id,
                    success: function(data){
                        if(data.code > 0){
                            alert(data.message);
                            return false;
                        }
                        invite_btn.html('已邀请');
                        invite_btn.attr("class","btn btn-default btn-xs invite-question-item-btn disabled");
                        loadQuestionInvitedUsers(question_id,'part');
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });

            $("#inviteAnswer").on("click","#showAllInvitedUsers",function(){
                loadQuestionInvitedUsers({{ $question->id }},'all');
            });

            /*tag切换*/
            $('#inviteAnswer a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var tabBy = $(this).data("by");
                if( tabBy == 'email' ){
                    $("#inviteAnswer .modal-footer").show();
                }else{
                    $("#inviteAnswer .modal-footer").hide();
                }

            });

            /*邀请邮箱回答*/
            $("#inviteAnswer .invite-email-btn").click(function(){
                var formData = $("#inviteEmailForm").serialize();
                $.ajax({
                    type: "post",
                    url: "/question/inviteEmail/{{ $question->id }}",
                    data:formData,
                    success: function(data){
                        if(data.code>0){
                            alert(data.message);
                        }else{
                            alert("邀请成功，邀请邮件已发送！");
                        }
                        $("#inviteAnswer").modal("hide");

                    },
                    error: function(data){
                        console.log(data);
                        alert("操作出错，请稍后再试");
                        $("#inviteAnswer").modal("hide");
                    }
                });
            });


        });


        /**
         * @param questionId
         * @param word
         */
        function loadInviteUsers(questionId,word){
            $.ajax({
                type: "get",
                url: "/ajax/loadInviteUsers",
                data:{question_id:questionId,word:word},
                success: function(data){
                    console.log(data);
                    var inviteItemHtml = '';
                    if(data.code > 0){
                        inviteItemHtml = '<div class="text-center" id="invite_loading"><p>暂无数据</p></div>';
                    }else{
                        $.each(data.message,function(i,item){
                            inviteItemHtml+= '<div class="col-md-12 invite-question-item">' +
                                    '<img src="'+item.avatar+'" />'+
                                    '<div class="invite-question-user-info">'+
                                    '<a class="invite-question-user-name" target="_blank" href="'+item.url+'">'+item.name+'</a>'+
                                    '<span class="invite-question-user-desc">'+item.tag_name+' 标签下有 '+item.tag_answers+' 个回答</span>'+
                                    '</div>';
                            if(item.isInvited>0){
                               inviteItemHtml += '<button type="button" class="btn btn-default btn-xs invite-question-item-btn disabled" data-question_id="{{ $question->id }}"  data-user_id="'+item.id+'">已邀请</button>';
                            }else{
                               inviteItemHtml += '<button type="button" class="btn btn-default btn-xs invite-question-item-btn" data-question_id="{{ $question->id }}"  data-user_id="'+item.id+'">邀请回答</button>';
                            }
                            inviteItemHtml += '</div>';
                        });
                    }
                    $("#invite_user_list").html(inviteItemHtml);
                },
                error: function(data){
                    console.log(data);
                    $("#invite_user_list").html('<div class="text-center" id="invite_loading"><p>操作出错</p></div>');

                }
            });
        }

        /*加载已被邀请的用户信息*/
        function loadQuestionInvitedUsers(questionId,type){
            $("#questionInviteUsers").load('/question/'+questionId+'/invitations/'+type);
        }

    </script>
@endsection