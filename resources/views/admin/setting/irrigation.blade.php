@extends('admin/public/layout')
@section('title')防灌水设置@endsection
@section('content')
    <section class="content-header">
        <h1>
            防灌水设置
            <small>全站防灌水策略设置</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.irrigation') }}">
                    {{ csrf_field() }}
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">审核策略</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启问题审核</label>
                                <span class="text-muted">(开启后，用户发起的问题需要在问题管理中审核才能正常显示)</span>
                                <div class="radio">
                                    <label><input type="radio" name="verify_question" value="1" @if(Setting()->get('verify_question') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="verify_question" value="0" @if(Setting()->get('verify_question') != 1) checked @endif > 关闭 </label>
                                </div>
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
                                    <label><input type="checkbox" name="code_login" value="1"  @if(Setting()->get('code_login') == 1) checked @endif /> 登录页面 </label>
                                    <label><input type="checkbox" name="code_register" value="1" @if(Setting()->get('code_register') == 1) checked @endif /> 注册页面</label>
                                </div>
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