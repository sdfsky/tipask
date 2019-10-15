<div class="modal fade" id="change_category_modal" tabindex="-1"  role="dialog" aria-labelledby="change_category_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">移动分类</h4>
            </div>
            <div class="modal-body">
                <form name="categoryForm" id="change_category_from" method="POST" action="{{ $form_action }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="form_id" name="form_id" value="{{ $form_id }}" />
                    <input type="hidden" name="ids" id="ids" />
                    <div class="form-group">
                        <label for="to_user_name" class="control-label">将选中项目移动到:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @include('admin.category.option',['type'=>$type,'select_id'=>0])
                            <option value="0">--不归类--</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="change_category_submit">确认</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){

        $("#change_category_submit").click(function(){
            var form_id = $("#change_category_from #form_id").val();
            var form_action = $("#change_category_from #form_action").val();
            var ids = new Array();
            $("#"+form_id+" input[name='id[]']:checkbox").each(function(i){
                if(true == $(this).is(':checked')){
                    ids.push($(this).val());
                }
            });

            if( ids.length > 0 ){
                $("#change_category_from input[name='ids']").val(ids.join(","));
                $("#change_category_from").submit();
            }else{
                alert("您没有选中任何内容");
            }
        });

    });
</script>