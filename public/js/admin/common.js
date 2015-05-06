/**
 * Created by simon on 2015/4/22.
 */


$(function () {

    $("#sliderbar_control").click(function(){
        var sidebar_collapse = 0;
        if($('body').hasClass('sidebar-collapse')){
            sidebar_collapse = 1;
        }
        $.get(site_url+'/admin/dashboard/sidebar?collapse='+sidebar_collapse,function(msg){
            console.log(msg);
        });
    });

    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
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