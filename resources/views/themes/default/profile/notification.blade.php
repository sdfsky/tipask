@extends('theme::profile.layout')

@section('main')
    <h2 class="h3 mt30 post-title">修改邮箱</h2>
    <div class="row mt30">
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
                        <div class="checkbox">
                            <label>
                                <input name="weekly" id="weekly" type="checkbox" checked=""> 精选内容周报
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="feature_news" id="feature_news" type="checkbox" checked=""> 当有新功能或其它相关新闻时
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
                                <input name="weekly" id="weekly" type="checkbox" checked=""> 精选内容周报
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="feature_news" id="feature_news" type="checkbox" checked=""> 当有新功能或其它相关新闻时
                            </label>
                        </div>
                        <button class="btn btn-xl btn-primary notify-sub mt20">提交</button>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('script')

@endsection
