@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-question-item">
                <h3 class="title">{{ $question->title }}</h3>
                <div class="author">
                    <a href="{{ route('auth.space.index',['user_id'=>$question->user_id]) }}" target="_blank" class="mr5"><img class="avatar-24 mr10" src="{{ route('website.image.avatar',['avatar_name'=>$question->user_id.'_small']) }}" alt="xumenger"><strong>{{ $question->user['name'] }}</strong></a>
                    {{ timestamp_format($question->created_at) }}
                </div>
                <div class="description mt-10">
                    <div class="question fmt">
                        {!! $question->description !!}
                    </div>
                    @if($question->tags)
                    <ul class="taglist--inline mt-10">
                        @foreach($question->tags() as $tag_name)
                        <li class="tagPopup"><a class="tag" href="{{ route('ask.tag.index',['name'=>$tag_name]) }}">{{ $tag_name }}</a></li>
                        @endforeach
                    </ul>
                    @endif

                    <div class="post-opt">
                        <ul class="list-inline mb0">
                            <li><a href="/q/1010000003746261">链接</a></li>
                            <li><a href="javascript:void(0);" class="comments" data-id="1010000003746261" data-target="#comment-1010000003746261">评论</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a href="#911" data-id="1010000003746261" data-toggle="modal" data-target="#911" data-type="question" data-typetext="问题">举报</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="answer-box">
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

            <div class="widget-answers">
                <div class="btn-group pull-right" role="group">
                    <a href="/q/1010000003746261#answers-title" id="sortby-rank" class="btn btn-default btn-xs active">默认排序</a>
                    <a href="?sort=created#answers-title" id="sortby-created" class="btn btn-default btn-xs">时间排序</a>
                </div>

                <h2 class="title h4 mt30 mb20 post-title" id="answers-title">{{ $answers->total() }} 个回答</h2>



                @foreach( $answers as $answer )
                <article class="clearfix widget-answers__item" id="a-1020000003746344">
                    <div class="post-col">
                        <a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}"><img class="avatar-40"  src="{{ route('website.image.avatar',['avatar_name'=>$answer->user_id.'_middle']) }}" alt="{{ $answer->user['name'] }}"></a>
                    </div>
                    <div class="post-offset">

                        <strong><a href="{{ route('auth.space.index',['user_id'=>$answer->user_id]) }}" class="mr5">{{ $answer->user['name'] }}</a></strong>
                        <span class="text-muted"> - {{ $answer->user['title'] }}</span>
                        <span class="answer-time text-muted">{{ timestamp_format($answer->created_at) }}</span>

                        <div class="fmt mt10">
                            {!! $answer->content !!}
                        </div>

                        <div class="post-opt">
                            <ul class="list-inline mt-10">

                                <li><a class="comments" data-toggle="collapse" href="#comments-{{ $answer->id }}" aria-expanded="false" aria-controls="comment-{{ $answer->id }}"><i class="fa fa-comment-o"></i> {{ $answer->comments }} 条评论</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"><i class="fa fa-edit"></i> 编辑</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"><i class="fa fa-remove"></i> 删除</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344"> 举报</a></li>
                                <li class="pull-right">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-up"></i> 10000</button>
                                    <button class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up"></i> 已赞</button>
                                </li>
                            </ul>
                        </div>

                        <div class="collapse widget-comments mt-15" id="comments-{{ $answer->id }}">
                            @if(Auth()->check())
                            <div class="widget-comments__item hover-show">
                                <div class="comment-content">
                                    <div class="content fmt"><p>其实这种问答等于没有回答....最好还是给题主一点思路吧。</p> </div>
                                    <p class="comment-meta">
                                        <a href="/u/manager" class="commentUser" data-userid="1030000000654149" data-username="洪旭" data-userslug="manager" data-useravatar="http://sfault-avatar.b0.upaiyun.com/122/455/1224550765-1030000000654149_medium40"><strong>洪旭</strong></a> · <span class="createdDate">1 小时前</span> · <a href="#" class="commentReply" data-userid="1030000000654149" data-id="1050000004020243" data-username="洪旭">回复</a>
                                        <span class="pull-right commentTools hover-show-obj">
                                            <a href="#911" class="ml10" data-toggle="modal" data-target="#911" data-type="comment" data-id="1050000004020243" data-typetext="评论" data-placement="top" title="举报">举报</a>
                                        </span>
                                    </p>
                                </div>
                                <div class="comment-content">
                                    <div class="content fmt"><p>刚才刷空间看到一个大一学弟发状态感觉挺难过 “你说陪伴是最长情的告白，我说四年四年又四年，我愿从意气风发的少年到雪鬓霜鬟的沧桑一直陪伴在你左右。我的生命还久，所以我愿意等。过了今天就代表我又瞬间老了四岁，希望我的泪水不要白流。即使我平常骂你喷你，但是你要知道，那都是因为我爱你。</p> </div>
                                    <p class="comment-meta">
                                        <a href="/u/manager" class="commentUser" data-userid="1030000000654149" data-username="洪旭" data-userslug="manager" data-useravatar="http://sfault-avatar.b0.upaiyun.com/122/455/1224550765-1030000000654149_medium40"><strong>洪旭</strong></a> · <span class="createdDate">1 小时前</span> · <a href="#" class="commentReply" data-userid="1030000000654149" data-id="1050000004020243" data-username="洪旭">回复</a>
                                        <span class="pull-right commentTools hover-show-obj">
                                            <a href="#911" class="ml10" data-toggle="modal" data-target="#911" data-type="comment" data-id="1050000004020243" data-typetext="评论" data-placement="top" title="举报">举报</a>
                                        </span>
                                    </p>
                                </div>
                                <div class="widget-comments__form row">
                                <form class="col-md-12" >
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" id="comment-content-{{ $answer->id }}"></textarea>
                                    </div>
                                </form>
                                <div class="col-md-12 text-right">
                                    <a href="#" class="text-muted">取消</a>
                                    <button type="submit" class="btn btn-primary btn-sm ml-10 comment-btn" data-answer_id="{{ $answer->id }}" data-token="{{ csrf_token() }}">提交评论</button>
                                </div>

                                </div>
                        </div>
                            @else
                            <div class="widget-comments">
                                <div class="widget-comments__form row">
                                    <div class="col-md-12">
                                        请先 <a  href="{{ route('auth.user.login') }}">登录</a> 后评论
                                    </div>
                                </div>
                            </div>
                            @endif
                         </div>

                </article>
                @endforeach

                <div class="text-center">
                    {!! str_replace('/?', '?', $answers->render()) !!}
                </div>

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
        });
    </script>
@endsection