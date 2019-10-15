@extends('admin/public/layout')
@section('title')草稿管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            草稿管理
            <small>管理系统的所有草稿</small>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.draft.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.draft.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="发布人UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="source_type">
                                                <option value="">类型</option>
                                                @foreach(trans_draft_type('all') as $key => $type)
                                                    <option value="{{ $key }}" @if( isset($filter['source_type']) && $filter['source_type']==$key) selected @endif >{{ $type }}</option>
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
                                        <th>标题</th>
                                        <th>内容</th>
                                        <th>用户</th>
                                        <th>时间</th>
                                    </tr>
                                    @foreach($drafts as $draft)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $draft->id }}"/></td>
                                            <td width="5%"><span class="label pull-left mr-5 @if($draft->source_type == 'answer') label-success @elseif($draft->source_type == 'question')label-default @elseif($draft->source_type == 'article')label-warning @endif">{{ trans_draft_type($draft->source_type) }}</span></td>
                                            <td width="25%" style="height:80px;">
                                                <div style= "OVERFLOW-Y:auto;height:80px;word-break: break-all">{!! $draft->subject !!}</div>
                                                {{--{!! str_limit($draft->subject,50,'...') !!}--}}
                                            </td>
                                            <td width="50%" style="height:80px;">
                                                <div style= "OVERFLOW-Y:auto;height:80px;word-break: break-all">{!! $draft->editor_content !!}</div>
                                            </td>
                                            <td width="10%"> @if($draft->user) {{ $draft->user->name }} @endif <span class="text-muted">[UID:{{ $draft->user_id }}]</span></td>
                                            <td width="15%">{{ timestamp_format($draft->created_at) }}</td>
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
                                    {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.comment.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $drafts->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $drafts->appends($filter)->links()) !!}
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
        set_active_menu('manage_content',"{{ route('admin.draft.index') }}");
    </script>
@endsection