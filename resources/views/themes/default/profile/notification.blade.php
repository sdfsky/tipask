@extends('theme::layout.public')

@section('seo_title')通知提醒 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal main">
            <h2 class="h3 post-title">通知提醒</h2>
            <div class="row mt-30">
                <form name="notify_form" method="post" action="{{ route('auth.profile.notification') }}">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="" class="control-label col-sm-2">站内通知</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]" type="checkbox" value="answer" @if(in_array('answer',$siteNotifications))) checked @endif /> 当有人回答我问题时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]" type="checkbox" value="follow_user" @if(in_array('follow_user',$siteNotifications))) checked @endif /> 当有人关注我时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]" type="checkbox" value="invite_answer" @if(in_array('invite_answer',$siteNotifications))) checked @endif /> 当有人邀请我回答问题时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="comment_question" @if(in_array('comment_question',$siteNotifications))) checked @endif> 当有人评论我的问题时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]" type="checkbox" value="comment_article" @if(in_array('comment_article',$siteNotifications))) checked @endif> 当有人评论我的文章时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]" type="checkbox" value="adopt_answer" @if(in_array('adopt_answer',$siteNotifications))) checked @endif> 当有人采纳我的回答时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="comment_answer" @if(in_array('comment_answer',$siteNotifications))) checked @endif > 当有人评论我的回答时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="reply_comment" @if(in_array('reply_comment',$siteNotifications))) checked @endif > 当有人回复我的评论时
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="remove_answer" @if(in_array('remove_answer',$siteNotifications))) checked @endif > 当有人删除我的回答时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="remove_question" @if(in_array('remove_question',$siteNotifications))) checked @endif > 当有人删除我的问题时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="site_notifications[]"  type="checkbox" value="remove_article" @if(in_array('remove_article',$siteNotifications))) checked @endif > 当有人删除我的文章时
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-2">邮件通知</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        <input name="email_notifications[]" type="checkbox" value="adopt_answer" @if(in_array('adopt_answer',$emailNotifications))) checked @endif  > 当有人采纳我的回答时
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="email_notifications[]" type="checkbox" value="invite_answer" @if(in_array('invite_answer',$emailNotifications))) checked @endif  > 当有人邀请我回答问题时
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-action row mb-30">
                            <label for="" class="control-label col-sm-2"></label>

                            <div class="col-sm-8">
                                <button class="btn btn-xl btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
