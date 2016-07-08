@extends('admin/public/layout')
@section('title')邮箱配置@endsection
@section('content')
    <section class="content-header">
        <h1>邮箱配置</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="settingForm" method="POST" action="{{ route('admin.setting.email') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">


                            <div class="form-group">
                                <label for="website_url">开启邮件功能</label>
                                <span class="text-muted">(若关闭则不会有邮件通知)</span>
                                <div class="radio">
                                    <label><input type="radio" name="mail_open" value="1" @if(Setting()->get('mail_open') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="mail_open" value="0" @if(Setting()->get('mail_open') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('mail_from_address')) has-error @endif">
                                <label for="mail_from_address">邮件来源地址</label>
                                <span class="text-muted">(默认跟发送账号保持一致，例如tipask@qq.com)</span>
                                <input type="text" name="mail_from_address" class="form-control " placeholder="邮件来源地址" value="{{ old('mail_from_address',Setting()->get('mail_from_address')) }}">
                                @if ($errors->has('mail_from_address')) <p class="help-block">{{ $errors->first('mail_from_address') }}</p> @endif
                            </div>

                            <div class="form-group @if ($errors->has('mail_from_name')) has-error @endif">
                                <label for="mail_from_name">邮件来源名称</label>
                                <span class="text-muted">(显示邮件名称部分，例如tipask)</span>
                                <input type="text" name="mail_from_name" class="form-control " placeholder="邮件来源名称" value="{{ old('mail_from_name',Setting()->get('mail_from_name')) }}">
                                @if ($errors->has('mail_from_name')) <p class="help-block">{{ $errors->first('mail_from_name') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label for="mail_driver" >邮件类型</label>
                                <span class="text-muted">(邮件发送方式)</span>
                                <select name="mail_driver" id="mail_driver" class="form-control">
                                    @foreach(config('tipask.mail_drivers') as $name => $text)
                                    <option value="{{ $name }}" @if(Setting()->get('mail_driver','smtp') == $name ) selected @endif >{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group smtp-item @if ($errors->has('mail_host')) has-error @endif">
                                <label for="mail_host">SMTP 服务器</label>
                                <span class="text-muted">(例如smtp.qq.com)</span>
                                <input type="text" name="mail_host" class="form-control " placeholder="邮件服务器地址" value="{{ old('mail_host',Setting()->get('mail_host')) }}">
                                @if ($errors->has('mail_host')) <p class="help-block">{{ $errors->first('mail_host') }}</p> @endif
                            </div>

                            <div class="form-group smtp-item @if ($errors->has('mail_port')) has-error @endif">
                                <label for="mail_port">SMTP 端口</label>
                                <span class="text-muted">(设置 SMTP 服务器的端口，默认为 25)</span>
                                <input type="text" name="mail_port" class="form-control " placeholder="SMTP 端口 默认25" value="{{ old('mail_port',Setting()->get('mail_port')) }}">
                                @if ($errors->has('mail_port')) <p class="help-block">{{ $errors->first('mail_port') }}</p> @endif
                            </div>

                            <div class="form-group smtp-item">
                                <label>邮件安全加密方式</label>
                                <span class="text-muted">(请根据邮件实际情况进行配置)</span>
                                <div class="radio">
                                    <label><input type="radio" name="mail_encryption" value="null" @if(Setting()->get('mail_encryption','null') == 'null') checked @endif > 无 </label>&nbsp;&nbsp;
                                    <label><input type="radio" name="mail_encryption" value="ssl" @if(Setting()->get('mail_encryption') == 'ssl') checked @endif > SSL </label>&nbsp;&nbsp;
                                    <label><input type="radio" name="mail_encryption" value="tls" @if(Setting()->get('mail_encryption') == 'tls') checked @endif > TLS </label>
                                </div>
                            </div>

                            <div class="form-group smtp-item @if ($errors->has('mail_username')) has-error @endif">
                                <label for="mail_username">邮箱地址</label>
                                <span class="text-muted">(例如tipask@qq.com)</span>
                                <input type="text" name="mail_username" class="form-control " placeholder="邮件服务器地址" value="{{ old('mail_username',Setting()->get('mail_username')) }}">
                                @if ($errors->has('mail_username')) <p class="help-block">{{ $errors->first('mail_username') }}</p> @endif
                            </div>

                            <div class="form-group smtp-item @if ($errors->has('mail_password')) has-error @endif">
                                <label for="mail_password">邮箱密码</label>
                                <span class="text-muted">(根据实际情况填写你邮箱的密码或第三方客户端授权码)</span>
                                <input type="password" name="mail_password" class="form-control " placeholder="邮箱认证密码" value="{{ old('mail_password',Setting()->get('mail_password')) }}">
                                @if ($errors->has('mail_password')) <p class="help-block">{{ $errors->first('mail_password') }}</p> @endif
                            </div>


                            <div class="form-group sendmail @if ($errors->has('mail_sendmail')) has-error @endif">
                                <label for="mail_sendmail">SendMail命令配置</label>
                                <span class="text-muted">(设置SendMail命令配置)</span>
                                <input type="text" name="mail_sendmail" class="form-control " placeholder="/usr/sbin/sendmail -bs" value="{{ old('mail_sendmail',Setting()->get('mail_sendmail','/usr/sbin/sendmail -bs')) }}">
                                @if ($errors->has('mail_sendmail')) <p class="help-block">{{ $errors->first('mail_sendmail') }}</p> @endif
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit"  class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-success" id="btn_test_email" >发送测试邮件</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <div class="modal fade" id="test_email_model"  role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">发送测试邮件</h4>
                </div>
                <div class="modal-body">
                    <form name="messageForm" id="message_form">
                        <div class="form-group">
                            <label for="to_user_id" class="control-label">收件人邮箱：</label>
                            <input type="email" class="form-control" id="test_send_to" name="sendTo" value="" placeholder="收件人邮箱地址" />
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">内容:</label>
                            <textarea class="form-control" id="test_email_content" name="content">你好，这是一封测试邮件。收到邮件后请不要回复！</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="submit_test_email">发送</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function show_email_item(){
            var mail_dirver = $("#mail_driver").val();
            if(mail_dirver == 'smtp'){
                $(".smtp-item").show();
                $(".sendmail").hide();
            }else{
                $(".smtp-item").hide();
                $(".sendmail").show();
            }
        }
        $(function(){
            set_active_menu('global',"{{ route('admin.setting.email') }}");
            show_email_item();
            $("#mail_driver").change(function(){
                show_email_item();
            });

            $("#btn_test_email").click(function(){
                if(confirm('请确认邮件配置项已保存成功？')){
                    $("#test_email_model").modal('show');
                }
            });

            /*发送测试邮件*/
            $("#submit_test_email").click(function(){
                var sendTo = $("#test_send_to").val();
                var content = $("#test_email_content").val();

                $.post('{{ route('admin.tool.sendTestEmail') }}',{sendTo:sendTo,content:content},function(msg){
                    console.log(msg);
                    if(msg == 'ok'){
                        alert('邮件发送成功');
                    }else{
                        alert('邮件发送错误：'+ msg );
                    }
                    $("#test_email_model").modal('hide');
                });
            });

        });
    </script>
@endsection