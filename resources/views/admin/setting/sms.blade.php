@extends('admin/public/layout')
@section('title')短信发送@endsection
@section('content')
    <section class="content-header">
        <h1>
            短信整合
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info" role="alert">
                    支持阿里云短信平台整合，相关账号申请流程请参见阿里云官网
                </div>
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.sms',['type'=>'sms']) }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启短信功能</label>
                                <span class="text-muted">(关闭后系统将不会发送短信通知)</span>
                                <div class="radio">
                                    <label><input type="radio" name="sms_open" value="1" @if(config('services.sms_open')) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="sms_open" value="0" @if(!config('services.sms_open')) checked @endif > 关闭 </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sms_sign_name">短信签名</label>
                                <input type="text" name="sms_sign_name" class="form-control" value="{{ config('aliyunsms.sign_name') }}" placeholder="短信签名"  />
                            </div>

                            <div class="form-group">
                                <label for="sms_app_key">Access Key Id</label>
                                <input type="text" name="sms_key_id" class="form-control" value="{{ config('aliyunsms.access_key') }}" placeholder="Access Key Id"  />
                            </div>

                            <div class="form-group">
                                <label for="sms_app_secret">Access Key Secret</label>
                                <input type="text" name="sms_key_secret" class="form-control" value="{{ config('aliyunsms.access_secret')  }}" placeholder="Access Key Secret"  />
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h3>消息模板设置</h3>
                <div class="alert alert-info" role="alert">
                    要使用短信通知以及验证码功能需要在阿里大于里面配置好消息模板，并且消息模板需要通过审核。<br />
                    系统中的消息模板变量如下：
                    <ol>
                        <li>发送验证码:您的验证码是：${code}，工作人员不会索取，请勿泄漏。</li>
                    </ol>
                </div>
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.sms',['type'=>'template']) }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sms_code_template">验证码消息模板ID</label>
                                <input type="text" name="sms_code_template" class="form-control" value="{{ Setting()->get('sms_code_template') }}" placeholder="SMS_XXXXX"  />
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            set_active_menu('third_part',"{{ route('admin.setting.sms') }}");
        });
    </script>
@endsection