@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question">
                @if($question->tags)
                    <ul class="taglist--inline">
                        @foreach($question->tags() as $tag_name)
                            <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['name'=>$tag_name]) }}">{{ $tag_name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <h4 class="title">
                    {{ $question->title }}
                    @if($question->price>0)
                        <span class="label label-warning">悬赏 <i class="fa fa-jpy"></i> {{ $question->price }}</span>
                    @endif
                </h4>
                <div class="description mt-10">
                    <div class="text-fmt ">
                        {!! $question->description !!}
                    </div>
                    <div class="post-opt mt-10">
                        <ul class="list-inline">
                            <li><a class="comments"  data-toggle="collapse"  href="#comments-question-{{ $question->id }}" aria-expanded="false" aria-controls="comment-{{ $question->id }}"><i class="fa fa-comment-o"></i> {{ $question->comments }} 条评论</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a href="#911" data-id="1010000003746261" data-toggle="modal" data-target="#911" data-type="question" data-typetext="问题">举报</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>

                    @include('theme::comment.collapse',['comment_source_type'=>'question','comment_source_id'=>$question->id])

                </div>

            </div>

            <div class="widget-answers mt-15">
                <div class="btn-group pull-right" role="group">
                    <a href="{{ route('ask.question.detail',['question_id'=>$question->id]) }}" class="btn btn-default btn-xs @if(request()->input('sort','default')=='default') active @endif">默认排序</a>
                    <a href="{{ route('ask.question.detail',['question_id'=>$question->id,'sort'=>'created_at']) }}" id="sortby-created" class="btn btn-default btn-xs @if(request()->input('sort','default')=='created_at') active @endif">时间排序</a>
                </div>

                <h2 class="h4 post-title">{{ $answers->total() }} 个回答</h2>

                @foreach( $answers as $answer )
                <div class="media">
                    <div class="media-left">
                        <a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}">
                            <img class="avatar-40"  src="{{ route('website.image.avatar',['avatar_name'=>$answer->user_id.'_middle']) }}" alt="{{ $answer->user['name'] }}"></a>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <strong><a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="mr5">{{ $answer->user['name'] }}</a></strong>
                            <span class="text-muted"> - {{ $answer->user['title'] }}</span>
                            <span class="answer-time text-muted">{{ timestamp_format($answer->created_at) }}</span>
                        </div>
                        <div class="content"><p>{!! $answer->content !!}</p></div>
                        <div class="media-footer">
                            <ul class="list-inline mb-20">

                                <li><a class="comments"  data-toggle="collapse"  href="#comments-answer-{{ $answer->id }}" aria-expanded="false" aria-controls="comment-{{ $answer->id }}"><i class="fa fa-comment-o"></i> {{ $answer->comments }} 条评论</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"><i class="fa fa-edit"></i> 编辑</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"><i class="fa fa-remove"></i> 删除</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"> 举报</a></li>
                                <li class="pull-right">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-up"></i> 10000</button>
                                    <button class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up"></i> 已赞</button>
                                </li>
                            </ul>
                        </div>
                        @include('theme::comment.collapse',['comment_source_type'=>'answer','comment_source_id'=>$answer->id])

                    </div>
                </div>
                @endforeach
                <div class="text-center">
                    {!! str_replace('/?', '?', $answers->render()) !!}
                </div>

            </div>
            <div class="widget-answer-form mt-15">
                @if(!Auth()->check() || ($question->user_id !== Auth()->user()->id && !Auth()->user()->isAnswered($question->id)) )
                    <h4>我来回答</h4>
                    <form action="{{ route('ask.answer.store') }}" method="post" class="editor-wrap">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" value="{{ $question->id }}" id="question_id" name="question_id" />
                        <div class="editor" id="questionText">
                            <textarea id="answerEditor" name="content" class="form-control" rows="4" placeholder="撰写答案..."></textarea>
                        </div>
                        <div id="answerSubmit" class=" mt15 clearfix">
                            <div class="checkbox pull-left">
                                <label><input type="checkbox" class="" id="shareToWeibo">
                                    同步到新浪微博</label>
                            </div>
                            <div class="pull-right">
                    <span id="editorStatus" class="hidden text-muted">

                    </span>
                                <a id="dropIt" href="javascript:void(0);" class="mr10 hidden">
                                    [舍弃]
                                </a>
                                <button type="submit" id="answerIt" data-id="1010000003746261" class="btn btn-primary ml20">提交回答</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>

        </div>

        <div class="col-xs-12 col-md-3 side">
            <div class="widget-box">
                <ul class="widget-action--ver list-unstyled">
                    <li>
                        <button type="button" id="sideFollow" class="btn btn-success btn-sm" data-id="1010000003726585" data-do="follow" data-type="question" data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">关注
                        </button>
                        <strong>9</strong> 关注
                    </li>
                    <li>
                        <button type="button" id="sideBookmark" class="btn btn-default btn-sm" data-id="1010000003726585" data-type="question">收藏</button>
                        <strong id="sideBookmarked">{{ $question->collections }}</strong> 收藏，<strong class="no-stress">{{ $question->views }}</strong> 浏览
                    </li>
                </ul>
            </div>
            <div class="widget-box">
                <h2 class="h4 widget-box__title">相似问题</h2>
                <ul class="widget-links list-unstyled">
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

@endsection

@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#answerEditor').summernote({
                height: 120,
                placeholder:true,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
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



        });
    </script>
@endsection