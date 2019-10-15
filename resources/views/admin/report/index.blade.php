@extends('admin/public/layout')
@section('title')举报管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            举报管理
            <small>管理系统的所有举报</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="标记为已处理" onclick="confirm_submit('item_form','{{  route('admin.report.dispose') }}','确认忽略选中项？')"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="标记为已忽略" onclick="confirm_submit('item_form','{{  route('admin.report.ignore') }}','确认处理选中项？')"><i class="fa fa-ban"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.report.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="举报人UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">--状态--</option>
                                                @foreach(trans_report_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle" /></th>
                                        <th>类型</th>
                                        <th>主题</th>
                                        <th>举报原因</th>
                                        <th>用户</th>
                                        <th>状态</th>
                                        <th>时间</th>
                                    </tr>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $report->id }}"/></td>
                                            <td width="5%"><span class="label pull-left mr-5 @if(str_contains($report->source_type,'Answer')) label-success @elseif(str_contains($report->source_type,'Question'))label-default @elseif(str_contains($report->source_type,'Article'))label-warning @endif">
                                                    @if(str_contains($report->source_type,'Answer')) 回答 @elseif(str_contains($report->source_type,'Question'))问题 @elseif(str_contains($report->source_type,'Article'))文章 @endif
                                                </span></td>
                                            <td>
                                                @if(str_contains($report->source_type,'Answer'))
                                                    <a href="{{ route('ask.question.detail',['id'=>$report->answer->question_id]) }}" target="_blank">{{ str_limit($report->subject,40) }}</a>
                                                @elseif(str_contains($report->source_type,'Question'))
                                                    <a href="{{ route('ask.question.detail',['id'=>$report->source_id]) }}" target="_blank">{{ str_limit($report->subject,40) }}</a>
                                                @elseif(str_contains($report->source_type,'Article'))
                                                    <a href="{{ route('blog.article.detail',['id'=>$report->source_id]) }}" target="_blank">{{ str_limit($report->subject,40) }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                {{ trans_report_type($report->report_type) }} @if($report->reason)：<span class="text-muted" title="{{ $report->reason }}">{{ str_limit($report->reason,120) }}</span> @endif
                                            </td>
                                            <td>{{ $report->user->name }} <span class="text-muted">[UID:{{ $report->user_id }}]</span></td>
                                            <td><span class="label @if($report->status===0) label-danger @elseif($report->status=== 4) label-default @elseif($report->status===1) label-success @endif">{{ trans_report_status($report->status) }}</span> </td>
                                            <td>{{ timestamp_format($report->created_at) }} {{ $report->status }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="标记为已处理" onclick="confirm_submit('item_form','{{  route('admin.report.dispose') }}','确认忽略选中项？')"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="标记为已忽略" onclick="confirm_submit('item_form','{{  route('admin.report.ignore') }}','确认处理选中项？')"><i class="fa fa-ban"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $reports->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $reports->appends($filter)->links()) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.report.index') }}");
    </script>
@endsection