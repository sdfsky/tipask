/**
 * Created by simon on 2015/4/20.
 * 全局公用js
 */

/*用户表单输入时删除错误提示*/
$("body").delegate("form input","keydown",function(){
    $(this).parents(".form-group").removeClass("has-error");
    $(this).next(".help-block").remove();
});



