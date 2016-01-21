/**
 * Created by simon on 2015/4/20.
 * 全局公用js
 */

/*编辑器toolbar全局配置*/

var ask_editor_options = {
    toolbar: [
        ['style', ['bold', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']]
    ],
    codemirror: {
        mode: 'text/html',
        htmlMode: true,
        lineNumbers: true,
        theme: 'monokai'
    }
};

$(function(){

    /*禁用bootstrap全局过度效果*/
    $.support.transition = false;

    /*全局启用bootstrap tooltip*/
    $('[data-toggle="tooltip"]').tooltip();

    /**/
    $('.user-card').popover({
        delay:500,
        placement:'right',
        html:true,
        trigger:'hover',
        content:'测试'
    });
    /*用户表单输入时删除错误提示*/
    $("body").delegate("form input","keydown",function(){
        $(this).parents(".form-group").removeClass("has-error");
        $(this).next(".help-block").remove();
    });

    /*验证码重新加载*/
    $("#reloadCaptcha").click(function(){
        var new_src = $(this).find("img").attr("src")+'&'+Math.random();
        $(this).find("img").attr("src",new_src);
    });

    $(".navbar-form span").click(function(){
        $("#top-search-form").submit();
    });

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
function upload_editor_image(file,editorId,token){
    data = new FormData();
    data.append("_token",token);
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
            $('#'+editorId).summernote('editor.insertImage', url);
        }
    });
}




