/**
 * Created by simon on 2015/4/22.
 */
/*ajax设置项*/

$(function () {
    /*ajax设置项*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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


    /*daterange控件*/
    $('#date_range').daterangepicker({
        format: 'YYYY-MM-DD',
        locale: {
            applyLabel: '确认',
            cancelLabel: '取消',
            fromLabel: '从',
            toLabel: '到',
            weekLabel: '星期',
            customRangeLabel: '自定义范围',
            daysOfWeek: moment.weekdaysMin(),
            monthNames: moment.monthsShort(),
            firstDay: moment.localeData()._week.dow
        }
    });

});



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
            $('#'+editorId).summernote('insertImage', url, function ($image) {
                $image.css('width', $image.width() / 2);
                $image.addClass('img-responsive');
            });
        }
    });
}




/*删除确认*/
function confirm_delete(message){
    if(!confirm(message)){
        return false;
    }
    $("#item_form").submit();
}


/*确认提交表单*/
function confirm_submit(form_id,action_url,message){
    if(!confirm(message)){
        return false;
    }
    $("#"+form_id).attr("action",action_url);
    $("#"+form_id).submit();
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