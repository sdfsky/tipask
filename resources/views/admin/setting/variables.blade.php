@extends('admin/public/layout')
@section('title')变量设置@endsection
@section('content')
    <section class="content-header">
        <h1>
            变量设置
            <small>网站变量管理</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.irrigation') }}">
                    {{ csrf_field() }}
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">显示数目设置</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="index_question_new_num">首页最新问题显示数目</label>
                                <input type="text" name="index_question_new_num" placeholder="请填写整数" />
                            </div>
                            <div class="form-group">
                                <label for="index_question_new_num">首页悬赏问题显示数目</label>
                                <input type="text" name="index_question_regard_num" placeholder="请填写整数" />
                            </div>
                            <div class="form-group">
                                <label for="website_url">开启回答审核</label>
                                <span class="text-muted">(开启后，用户的回答需要在回答管理中审核才能正常显示)</span>
                                <div class="radio">
                                    <label><input type="radio" name="verify_answer" value="1" @if(Setting()->get('verify_answer') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="verify_answer" value="0" @if(Setting()->get('verify_answer') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website_url">开启文章审核</label>
                                <span class="text-muted">(开启后，用户撰写的文章需要在文章管理中审核才能正常显示)</span>
                                <div class="radio">
                                    <label><input type="radio" name="verify_article" value="1" @if(Setting()->get('verify_article') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="verify_article" value="0" @if(Setting()->get('verify_article') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website_url">开启评论审核</label>
                                <span class="text-muted">(开启后，用户的评论需要在评论管理中审核才能正常显示)</span>
                                <div class="radio">
                                    <label><input type="radio" name="verify_comment" value="1" @if(Setting()->get('verify_comment') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="verify_comment" value="0" @if(Setting()->get('verify_comment') != 1) checked @endif> 关闭 </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">验证码策略</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">启用验证码</label>
                                <span class="text-muted">(验证码可以避免恶意注册及恶意灌水，请选择需要打开验证码的操作)</span>
                                <div class="checkbox">
                                    <input type="checkbox" name="code_login" value="1"  @if(Setting()->get('code_login') == 1) checked @endif /> 登录
                                    <label><input type="checkbox" name="code_register" value="1" @if(Setting()->get('code_register') == 1) checked @endif /> 注册</label>
                                    <label><input type="checkbox" name="code_create_question" value="1" @if(Setting()->get('code_create_question') == 1) checked @endif /> 发起提问</label>
                                    <label><input type="checkbox" name="code_create_answer" value="1" @if(Setting()->get('code_create_answer') == 1) checked @endif /> 回答问题</label>
                                    <label><input type="checkbox" name="code_create_article" value="1" @if(Setting()->get('code_create_article') == 1) checked @endif /> 发布文章</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">内容写入限制策略</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">1小时内最大提问数</label>
                                <span class="text-muted">(设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="question_limit_num" placeholder="0为不限制" value="{{ old('question_limit_num',Setting()->get('question_limit_num' , 0)) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="website_url">1小时内最大回答数</label>
                                <span class="text-muted">(设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="answer_limit_num" placeholder="0为不限制" value="{{ old('answer_limit_num',Setting()->get('answer_limit_num' , 0)) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="website_url">1小时内最大文章发表次数</label>
                                <span class="text-muted">(设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="article_limit_num" placeholder="0为不限制" value="{{ old('article_limit_num',Setting()->get('article_limit_num' , 0)) }}"  />
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="website_url">提问后编辑内容时效</label>
                                <span class="text-muted">(默认单位是秒，设置后用户只能在编辑时间有效期内进行修改，设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="edit_question_timeout" placeholder="0为不限制" value="{{ old('edit_question_timeout',Setting()->get('edit_question_timeout' , 0)) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="website_url">发起文章后编辑内容时效</label>
                                <span class="text-muted">(默认单位是秒，设置后用户只能在编辑时间有效期内进行修改，设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="edit_article_timeout" placeholder="0为不限制" value="{{ old('edit_article_timeout',Setting()->get('edit_article_timeout' , 0)) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="website_url">撰写回答后编辑内容时效</label>
                                <span class="text-muted">(默认单位是秒，设置后用户只能在编辑时间有效期内进行修改，设置为0则不做任何限制)</span>
                                <input type="text" class="form-control" name="edit_answer_timeout" placeholder="0为不限制" value="{{ old('edit_answer_timeout',Setting()->get('edit_answer_timeout' , 0)) }}"  />
                            </div>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" >保存</button>
                        <button type="reset" class="btn btn-success">重置</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection
@section('script')
    <script type="text/javascript">
        set_active_menu('global',"{{ route('admin.setting.irrigation') }}");
    </script>
@endsection