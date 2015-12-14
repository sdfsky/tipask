/**
 * Created by simon on 2015/4/20.
 * 全局公用js
 */
$(function(){
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


    /*评论提交*/
    $(".comment-btn").click(function(){
        var answer_id = $(this).data('answer_id');
        var token = $(this).data('token');
        var content = $("#comment-content-"+answer_id+"").val();
        console.log(content+'--------'+token+'----'+answer_id)
    });
});




