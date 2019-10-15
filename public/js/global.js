/**
 * Created by simon on 2015/4/20.
 * 全局公用js
 */


var showPopover = function () {
        $(this).popover('show');
    }
    , hidePopover = function () {
        $(this).popover('hide');
    };



$(function(){

    /*ajax设置项*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*禁用bootstrap全局过度效果*/
    $.support.transition = false;

    /*全局启用bootstrap tooltip*/
    $('[data-toggle="tooltip"]').tooltip();

    /*用户表单输入时删除错误提示*/
    $("body").delegate("form input","keydown",function(){
        $(this).parents(".form-group").removeClass("has-error");
        $(this).next(".help-block").remove();
    });

    /*验证码重新加载*/
    $("#reloadCaptcha").click(function(){
        console.log("coming");
        var new_src = $(this).find("img").attr("src")+'&'+Math.random();
        $(this).find("img").attr("src",new_src);
    });

    $(".navbar-form span").click(function(){
        $("#top-search-form").submit();
    });

    /*消息提示框自动隐藏*/
    $("#alert_message").delay(5000).hide(0);


    /*激活邮件发送*/
    $(".send-email-token").click(function(){
        $.get('/email/sendToken',function(msg){
            if( msg === 'tooFast'){
                alert('发送太频繁，请一分钟后再试.');
            }
        });
        $(".send-email-tips").show();
    });


    /*加载更多分页*/
    $(document).on("click",".load-more",function(){
        var $btn = $(this).button('loading');
        var loading_btn = $(this).button('loading');
        var source_type = $(this).data('source_type');
        var source_id = $(this).data('source_id');
        var next_page_url = $(this).data('next_page_url');
        $.get(next_page_url,function(html){
            $("#comments-"+source_type+"-"+source_id+" .widget-comment-list").append(html);
            loading_btn.parent().remove();
        });
    });


    $(document).on("click",".comment-reply",function(){

        var message = $(this).data('message');
        var source_type = $(this).data('source_type');
        var source_id = $(this).data('source_id');
        var to_user_id = $(this).data('to_user_id');

        $("#comment-"+source_type+"-content-"+source_id).attr('placeholder',message);
        $("#"+source_type+"-comment-"+source_id+"-btn").data('to_user_id',to_user_id);
        return false;

    });


    $(".collapse-cancel").click(function(){
        var collapse_id = $(this).data("collapse_id");
        $("#"+collapse_id).collapse('hide');
        return false;
    });



    /*私信模块处理*/

    $('#sendTo_message_model').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var to_user_id = button.data('to_user_id');
        var to_user_name = button.data('to_user_name');
        var modal = $(this);
        modal.find('#to_user_id').val(to_user_id);
        modal.find('#to_user_name').text(to_user_name);
    });


    $("#sendTo_submit").click(function(){
        $.ajax({
            type: "POST",
            url: "/message/store",
            data: $('#sendTo_message_form').serialize(),
            success: function(msg){
                alert('消息发送成功');
                $("#sendTo_message_model").modal('hide');
            },
            error: function(){
                alert("发送失败！");
            }
        });
    });


    /*关注模块处理，关注问题，用户等*/
    $("#follow-button,.followTopic,.followerUser").click(function(){
        if(!check_login()){
            return ;
        }
        $(this).button('loading');
        var follow_btn = $(this);
        var source_type = $(this).data('source_type');
        var source_id = $(this).data('source_id');
        var show_num = $(this).data('show_num');

        $.get('/follow/'+source_type+'/'+source_id,function(msg){
            follow_btn.removeClass('disabled');
            follow_btn.removeAttr('disabled');
            if(msg =='followed'){
                follow_btn.html('已关注');
                follow_btn.addClass('active');
            }else{
                follow_btn.html('关注');
                follow_btn.removeClass('active');
            }

            /*是否操作关注数*/
            if(Boolean(show_num)){
                var follower_num = $("#follower-num").html();
                if(msg==='followed'){
                    $("#follower-num").html(parseInt(follower_num)+1);
                }else{
                    $("#follower-num").html(parseInt(follower_num)-1);
                }
            }
        });

    });



    /*赞同模块公共处理*/
    $(".btn-support").hover(function(){
        var btn_support = $(this);
        var source_type = btn_support.data('source_type');
        var source_id = btn_support.data('source_id');
        $.get('/support/check/'+source_type+'/'+source_id,function(msg){
            btn_support.removeClass('btn-default');
            if(msg =='failed'){
                btn_support.addClass('btn-warning');
                btn_support.html('<i class="fa fa-thumbs-o-up"></i> 已赞');
            }else{
                btn_support.addClass('btn-success');
                btn_support.html('<i class="fa fa-thumbs-o-up"></i> 赞同');
            }
        });
    }, function(){
        var btn_support = $(this);
        var support_num = $(this).data('support_num');
        btn_support.attr('class','btn btn-default btn-sm btn-support');
        btn_support.html('<i class="fa fa-thumbs-o-up"></i> '+support_num);
    });

    $(".btn-support").click(function(){
        if(!check_login()){
            return ;
        }
        var btn_support = $(this);
        var source_type = btn_support.data('source_type');
        var source_id = btn_support.data('source_id');
        var support_num = parseInt(btn_support.data('support_num'));
        $.get('/support/'+source_type+'/'+source_id,function(msg){
            if(msg =='success'){
                support_num++
                btn_support.html('<i class="fa fa-thumbs-o-up"></i> '+support_num);
                btn_support.data('support_num',support_num);
            }
        });


    });


    /*通知异步加载*/
    $("#unread_notifications").load("/ajax/unreadNotifications");

    /*异步加载私信*/
    $("#unread_messages").load("/ajax/unreadMessages");


    /*标签自动选择*/
    if( $("#select_tags").length > 0 ){
        $("#select_tags").select2({
            theme:'bootstrap',
            placeholder: "选择话题",
            ajax: {
                url: '/ajax/loadTags',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        word: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength:1,
            tags:true
        });
        $("#select_tags").change(function(){
            $("#tags").val($("#select_tags").val());
        });
    }


    /*悬赏选择框处理*/

    $(".reward-price-sample .btn-default").click(function(){
        var button = $(this);
        $(".reward-price-sample .btn-default").each(function(){
            $(this).removeClass("active");
        });
        button.addClass("active");
        return false;
    });

    $(".reward-price-sample .reward-price-number").keyup(function(){
        var price = $.trim($(this).val());
        if (!/^\d+$/.test(price) || parseInt(price) <= 0 ){
            $(this).val('');
        }

        $(".reward-price-sample .btn-default").each(function(){
            $(this).removeClass("active");
        });

        return false;

    });

    /*fancybox处理*/
    $(".description .text-fmt img,.best-answer .text-fmt img,.widget-answers .text-fmt img,.widget-article .text-fmt img").each(function(){
        var image = $(this);
        image.wrap('<a data-fancybox="gallery" href="'+image.attr("src")+'"></a>');
    });


    // 举报相关
    $("#report_reason").hide();
    $(".reportRadioItem").change(function() {
        var id = $("input[name='report_type']:checked").val();
        if (id == 99){
            $("#report_reason").show();
        }else{
            $("#report_reason").hide();
        }
    });
    $(".report_btn").click(function () {
        var source_type = $(this).data('source_type');
        var source_id = $(this).data('source_id');
        $("input[name='source_type']").val(source_type);
        $("input[name='source_id']").val(source_id);
        console.log(source_type);
        if (source_type == 'article'){
            $("#reportModalLabel").text("举报此文章");
        }else if(source_type == 'answer') {
            $("#reportModalLabel").text("举报此回答");
        }else if(source_type == 'question')
        {
            $("#reportModalLabel").text("举报此问题");
        }
    });

    $(".comments").map(function(){
        var commentNum = $(this).text().replace(/[^0-9]/ig,"");
        if(commentNum == 0){
            return false;
        }
        var comment_id = $(this).attr('href');
        var source_type = $(comment_id).data('source_type');
        var source_id   = $(comment_id).data('source_id');
        console.log(source_type+source_id);
        load_comments(source_type,source_id);
        $(comment_id).collapse('show');

    });

    $("#report_submit_button").click(function () {
        var report_type = $("input[name='report_type']:checked").val();
        if(typeof(report_type) == "undefined"){
            alert('请填写举报原因');
        }
        $("#report_form").submit();
    });

});





function add_comment(token,source_type,source_id,content,to_user_id){
    var postData = {_token:token,source_id:source_id,source_type:source_type,content:content};
    if(to_user_id>0){
        postData.to_user_id = to_user_id;
    }
    $.post('/comment/store',postData,function(html){
        $("#comments-"+source_type+"-"+source_id+" .widget-comment-list").append(html);
        $("#comment-"+source_type+"-content-"+source_id).val('');
    });
}


function load_comments(source_type,source_id){
    $.get('/'+source_type+'/'+source_id+'/comments',function(html){
        $("#comments-"+source_type+"-"+source_id+" .widget-comment-list").append(html);
    });
}

function clear_comments(source_type,source_id){
    $("#comments-"+source_type+"-"+source_id+" .widget-comment-list").empty();
}


/**
 * 编辑器图片图片文件方式上传
 * @param file
 * @param editor
 * @param welEditable
 */
function upload_editor_image(file,editorId){
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        dataType : 'text',
        url: "/image/upload",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            console.log(url);
            if(url == 'error'){
                alert('图片上传失败！请压缩图片大小再进行上传');
                return false;
            }
            $('#'+editorId).summernote('insertImage', url, function ($image) {
                $image.css('width', $image.width() / 2);
                $image.addClass('img-responsive');
            });
        },
        error:function(){
            alert('图片上传失败，请压缩图片大小再进行上传 :)');
        }
    });
}


/*检查用户登录情况*/
function check_login(){
    if(!is_login){
        document.location = '/login';
        return false;
    }

    return true;
}


/*手机号码格式校验*/
function is_mobile(mobile){
     var reg = /^1[3456789]\d{9}$/;
     var phone = $.trim(mobile);
    if(phone == ''){
        return false;
    }
    if(!reg.test(phone)){
        return false;
    }
    return true;
}


function show_form_error(element,msg){
    element.parent().addClass('has-error');
    if(element.parent().find(".help-block").size() > 0){
        element.parent().find(".help-block").html(msg);
    }else{
        element.after('<span class="help-block">'+msg+'</span>');
    }
}


function get_button_price(){
    var price = 0;
    $(".reward-price-sample .btn-default").each(function(){
        var button_price = $(this).data('price');
        if($(this).hasClass('active')){
            price = button_price;
        }
    });
    return price;
}



