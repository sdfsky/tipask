<div class="modal fade" id="verify_code_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">请输入验证码</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form name="smsForm" id="send_sms_form" onsubmit="return sendSmsCode();"  method="POST">
                        <input type="hidden" name="mobile" id="send_to_mobile" value="" />
                        <input type="hidden" name="send_type" id="send_type" value="code" />
                        <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                            <label for="mobile" class="required control-label col-sm-4">验证码</label>
                            <div class="col-sm-6">
                                <input name="captcha" id="sms_captcha" type="text" maxlength="32" placeholder="请输入下方验证码" class="form-control" value="{{ old('captcha') }}" />
                                @if ($errors->first('captcha'))
                                    <span class="help-block">{{ $errors->first('captcha') }}</span>
                                @endif
                                <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="btn_verify_captcha">确认</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var countdown_second = 60;
    function Countdown(btn) {
        if (countdown_second == 0) {
            btn.attr("class","btn btn-xl btn-default btn-send-code");
            btn.text("免费获取验证码");
            countdown_second = 60;
            return;
        } else {
            btn.attr("class","btn btn-xl btn-default disabled");
            btn.text("重新发送(" + countdown_second + ")");
            countdown_second--;
        }
        setTimeout(function() {
                    Countdown(btn) }
                ,1000)
    }

    $(function(){
        $('#verify_code_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var mobile_id = button.data('mobile_id');
            var send_type = button.data('send_type');
            var mobile = $("#"+mobile_id).val();
            if(!is_mobile(mobile)){
                show_form_error($("#"+mobile_id),"手机号码格式错误");
                return false;
            }
            var modal = $(this);
            modal.find('#send_to_mobile').val(mobile);
            modal.find('#send_type').val(send_type);
            $("#reloadCaptcha").trigger('click');
        });

        $("#btn_verify_captcha").click(function(){
            sendSmsCode();
        });
    });
    
    function sendSmsCode() {
        var mobile = $("#send_to_mobile").val();
        var captcha = $("#sms_captcha").val();
        var send_type = $("#send_type").val();
        $.post('/ajax/sendSmsCode',{mobile:mobile,send_type:send_type,code:captcha},function(msg){
            console.log(msg);
            if( msg.code == 0 ){
                $('#verify_code_modal').modal('hide');
                Countdown($(".btn-send-code"));
            }else{
                show_form_error($("#sms_captcha"),msg.message);
                $("#reloadCaptcha").trigger('click');
                return false;
            }
        });
        return false;
    }

</script>
    