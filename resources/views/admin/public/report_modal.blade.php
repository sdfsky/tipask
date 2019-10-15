<div class="modal fade" id="send_report_modal" tabindex="-1" role="dialog" aria-labelledby="send_report_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="reportModalLabel">删除原因</h4>
            </div>
            <div class="modal-body">
                <form name="reportForm" id="report_form" method="post" action="{{ $form_action }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="form_id" name="form_id" value="{{ $form_id }}" />
                    <input type="hidden"  name="source_type" value="{{ $type }}">
                    <input type="hidden"  name="ids" id="ids">
                    @foreach(trans_report_type('all') as $key => $reason)
                        <div class="radio">
                            <label>
                                <input type="radio" name="report_type" class="reportRadioItem" value="{{ $key }}">
                                {{ $reason['subject'] }}：
                                <span class="text-muted">{{ $reason['desc'] }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="form-group" id="report_reason">
                        <label for="message-text" class="control-label">删除原因:</label>
                        <textarea class="form-control" id="message-text" name="reason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="report_submit_button">确认</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){

        $("#report_submit_button").click(function(){
            var form_id = $("#report_form #form_id").val();
            var form_action = $("#report_form #form_action").val();
            var ids = new Array();
            $("#"+form_id+" input[name='id[]']:checkbox").each(function(i){
                if(true == $(this).is(':checked')){
                    ids.push($(this).val());
                }
            });

            if( ids.length > 0 ){
                $("#report_form input[name='ids']").val(ids.join(","));
                $("#report_form").submit();
            }else{
                alert("您没有选中任何内容");
                window.location.reload();
            }
        });

    });
</script>