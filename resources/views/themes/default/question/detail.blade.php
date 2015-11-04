@extends('theme::public.layout')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('container')
    <div class="post-topheader">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ol class="breadcrumb">
                        <li><a href="/questions/newest">问答</a></li>
                        <li class="active">问答详情</li>
                    </ol>

                    <h1 class="h3 title" id="questionTitle" data-id="1010000003726585"><a href="{{ route("ask.question.detail",['id'=>$question->id]) }}">{{ $question->title }}</a></h1>

                    <div class="author">
                        <a href="/u/xumenger" class="mr5"><img class="avatar-24 mr10" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_small']) }}" alt="xumenger"><strong>xumenger</strong></a>
                        <strong class="text-black mr10">23</strong>
                        {{ $question->created_at->diffForHumans()  }} 提问
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="widget-action--ver list-unstyled">
                        <li>
                            <button type="button" id="sideFollow" class="btn btn-success btn-sm" data-id="1010000003726585" data-do="follow" data-type="question" data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">关注
                            </button>
                            <strong>9</strong> 关注
                        </li>
                        <li>
                            <button type="button" id="sideBookmark" class="btn btn-default btn-sm" data-id="1010000003726585" data-type="question">收藏
                            </button>
                            <strong id="sideBookmarked">{{ $question->collections }}</strong> 收藏，<strong class="no-stress">{{ $question->views }}</strong> 浏览
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-30">
        <div class="col-xs-12 col-md-9 main">
            <article class="widget-question__item">
                <div class="post-col">
                    <div class="widget-vote">
                        <button type="button" class="like" data-id="1010000003746261" data-type="question" data-do="like" data-toggle="tooltip" data-placement="top" title="" data-original-title="问题对人有帮助，内容完整，我也想知道答案">
                            <span class="sr-only">问题对人有帮助，内容完整，我也想知道答案</span>
                        </button>
                        <span class="count">0</span>
                        <button type="button" class="hate" data-id="1010000003746261" data-type="question" data-do="hate" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="问题没有实际价值，缺少关键内容，没有改进余地">
                            <span class="sr-only">问题没有实际价值，缺少关键内容，没有改进余地</span>
                        </button>
                    </div>
                    <!-- end .widget-vote -->
                </div>

                <div class="post-offset">
                    <div class="question fmt">
                        {!! $question->description !!}
                    </div>
                    <ul class="taglist--inline mb20">
                        <li class="tagPopup"><a class="tag" href="/t/%E5%89%8D%E7%AB%AF%E6%A1%86%E6%9E%B6" data-toggle="popover" data-placement="top" data-original-title="前端框架" data-id="1040000000457749" data-img="">前端框架</a></li>
                    </ul>


                    <div class="post-opt">
                        <ul class="list-inline mb0">
                            <li><a href="/q/1010000003746261">链接</a></li>
                            <li><a href="javascript:void(0);" class="comments" data-id="1010000003746261" data-target="#comment-1010000003746261">
                                    评论</a></li>



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
                <!-- end .post-offset -->
            </article>

            <div class="widget-answers">
                <div class="btn-group pull-right" role="group">
                    <a href="/q/1010000003746261#answers-title" id="sortby-rank" class="btn btn-default btn-xs active">默认排序</a>
                    <a href="?sort=created#answers-title" id="sortby-created" class="btn btn-default btn-xs">时间排序</a>
                </div>

                <h2 class="title h4 mt30 mb20 post-title" id="answers-title">4 个回答</h2>



                @foreach( $answers as $answer )
                <article class="clearfix widget-answers__item" id="a-1020000003746344">
                    <div class="post-col">
                        <div class="widget-vote">
                            <button type="button" class="like" data-id="1020000003746344" data-type="answer" data-do="like" data-toggle="tooltip" data-placement="top" title="" data-original-title="答案对人有帮助，有参考价值">
                                <span class="sr-only">答案对人有帮助，有参考价值</span>
                            </button>
                            <span class="count">{{ $answer->supports }}</span>
                            <button type="button" class="hate" data-id="1020000003746344" data-type="answer" data-do="hate" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="答案没帮助，是错误的答案，答非所问">
                                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
                            </button>

                        </div>
                    </div>

                    <div class="post-offset">
                        <a href="/u/luopengzhan"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/238/440/2384404775-5496d9cbe67be_big64" alt=""></a>
                        <strong><a href="/u/luopengzhan" class="mr5">此刻最好</a> 1.3k</strong>

                        <span class="ml10 text-muted">{{ $answer->created_at->diffForHumans() }} 回答</span>
                        <div class="answer fmt mt10">
                            {!! $answer->content !!}
                        </div>


                        <div class="post-opt">
                            <ul class="list-inline mb0">

                                <li><a href="/q/1010000003746261/a-1020000003746344">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000003746344" data-target="#comment-1020000003746344">2 评论</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li><a href="#911" data-id="1020000003746344" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="widget-comments hidden" id="comment-1020000003746344" data-id="1020000003746344">
                            <div class="widget-comments__form row">
                                <div class="col-md-12">
                                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                                </div>

                            </div><!-- /.widget-comments__form -->
                        </div><!-- /.widget-comments -->


                    </div>
                </article>
                @endforeach

                <div class="text-center">
                    {!! str_replace('/?', '?', $answers->render()) !!}
                </div>
            </div>

            <h4>撰写答案</h4>
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
                        <button type="submit" id="answerIt" data-id="1010000003746261" class="btn btn-lg btn-primary ml20">提交回答</button>
                    </div>
                </div>
            </form>


        </div>
        <!-- /.main -->



        <div class="col-xs-12 col-md-3 side">
            <div class="widget-box no-border">
                <h2 class="h4 widget-box__title">相似问题</h2>
                <ul class="widget-links list-unstyled">
                    <li class="widget-links__item"><a title="关于前端开发单页面的开发" href="/q/1010000003501828">关于前端开发单页面的开发</a>
                        <small class="text-muted">
                            7 回答
                            |                             已解决
                        </small>
                    </li>
                    <li class="widget-links__item"><a title="使用nodejs进行后端渲染，前端还需要框架级的工具吗？" href="/q/1010000002966137">使用nodejs进行后端渲染，前端还需要框架级的工具吗？</a>
                        <small class="text-muted">
                            2 回答
                        </small>
                    </li>

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