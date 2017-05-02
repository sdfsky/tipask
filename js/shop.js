$(function(){
    $(".btn_exchange").click(function(){
        if(!check_login()){
            return false;
        }
        var goods_name = $(this).data('goods_name');
        var goods_coins = $(this).data('goods_coins');
        var goods_id = $(this).data('goods_id');
        $("#goods_id").val(goods_id);
        $("#alert_exchange").html('你要兑换的商品是【'+goods_name+'】，兑换成功后会扣除 '+goods_coins+' 金币！');
        $("#modal_exchange").modal('show');
    });

    /*表单提交*/
    $("#submit_exchange").click(function(){
        $.ajax({
            type: "POST",
            url: $("#exchange_form").attr('action'),
            data: $("#exchange_form").serialize(),
            success: function(msg){

                if(msg.result != 'ok'){

                    if( undefined != msg.result.real_name ){
                        $("input[name='real_name']").parent().addClass('has-error');
                        $("input[name='real_name']").parent().append("<span class='help-block'>"+msg.result.real_name[0]+"</span>");
                    }

                    if( undefined != msg.result.phone ){
                        $("input[name='phone']").parent().addClass('has-error');
                        $("input[name='phone']").parent().append("<span class='help-block'>"+msg.result.phone[0]+"</span>");
                    }

                    if( undefined != msg.result.email ){
                        $("input[name='email']").parent().addClass('has-error');
                        $("input[name='email']").parent().append("<span class='help-block'>"+msg.result.email[0]+"</span>");
                    }

                    if( undefined != msg.result.comment ){
                        $("input[name='comment']").parent().addClass('has-error');
                        $("input[name='comment']").parent().append("<span class='help-block'>"+msg.result.comment[0]+"</span>");
                    }


                    $("#common_message").removeClass('has-error');
                    $("#common_message").find(".help-block").remove();
                    if(undefined != msg.result.common){
                        $("#common_message").addClass('has-error');
                        $("#common_message").append("<span class='help-block'>"+msg.result.common[0]+"</span>");
                    }

                }else{
                    $("#modal_exchange").modal('hide');
                    alert('兑换申请提交成功，我们会在3个工作日内处理该兑换申请！');
                    document.location.href= "/shop";
                }
            }
        },'json');
    });

});
