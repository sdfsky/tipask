@extends('theme::layout.public')

@section('seo')
    <title>通知提醒 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">通知提醒</h2>
            <div class="row mt-30">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">邮件提醒</label>
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input name="answer" id="answer" type="checkbox" checked=""> 当有其他人回答我关注的问题时
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="comment" id="comment" type="checkbox" checked=""> 当有人对我发布的内容评论时
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="content_handled" id="content_handled" type="checkbox" checked=""> 当我的内容被删除/关闭/忽略/采纳时
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="comment_reply" id="comment_reply" type="checkbox" checked=""> 当有人回复我的评论时
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="invite" id="invite" type="checkbox" checked=""> 当有人邀请我回答问题时
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">短信通知</label>
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input name="invite" id="invite" type="checkbox" checked=""> 当我的提问有了新回答时
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="invite" id="invite" type="checkbox" checked=""> 当我的回答被采纳时
                                </label>
                            </div>
                            <button class="btn btn-xl btn-primary notify-sub mt-20">提交</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
