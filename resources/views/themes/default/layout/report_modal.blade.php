<div class="modal fade" id="send_report_model"  role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="reportModalLabel">举报此文章</h4>
            </div>
            <div class="modal-body">
                <form name="reportForm" id="report_form" method="post" action="{{ route('auth.report.store') }}">
                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                    <input type="hidden"  name="source_type" value="">
                    <input type="hidden"  name="source_id" value="">
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
                        <label for="message-text" class="control-label">举报原因:</label>
                        <textarea class="form-control" id="message-text" name="reason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="report_submit_button">举报</button>
            </div>
        </div>
    </div>
</div>