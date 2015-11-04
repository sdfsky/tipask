/**
 * Created by simon on 2015/4/22.
 */


$(function () {

    $("#sliderbar_control").click(function(){
        var sidebar_collapse = 0;
        if($('body').hasClass('sidebar-collapse')){
            sidebar_collapse = 1;
        }
        $.get(site_url+'/admin/index/sidebar?collapse='+sidebar_collapse,function(msg){
            console.log(msg);
        });
    });

    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });


    //全部选中checkbox
    $('.checkbox-toggle').on('ifChecked', function(event){
        $("input[type='checkbox'][class!='checkbox-toggle']").iCheck('check');
    });

    //全部取消选中checkbox
    $('.checkbox-toggle').on('ifUnchecked', function(event){
        $("input[type='checkbox'][class!='checkbox-toggle']").iCheck('uncheck');
    });
});


/*删除确认*/
function confirm_delete(message){
    if(!confirm(message)){
        return false;
    }
    $("#item_form").submit();
}

/**
 * 设置当前页面高亮的菜单
 * @param $parentid
 * @param $url
 */
function set_active_menu(parent_id,url){

    $("#"+parent_id+">li>a[href='"+url+"']",0).parent().addClass("active");
    $("#"+parent_id).parent().addClass("active");

}