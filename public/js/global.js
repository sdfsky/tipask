/**
 * Created by simon on 2015/4/20.
 * 全局公用js
 */
$(function(){

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
        var new_src = $(this).find("img").attr("src")+'&'+Math.random();
        $(this).find("img").attr("src",new_src);
    });

    $(".navbar-form span").click(function(){
        $("#top-search-form").submit();
    });

    $("#alert_message").delay(3000).hide(0);


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




