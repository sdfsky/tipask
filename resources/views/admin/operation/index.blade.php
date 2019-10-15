@extends('admin.public.layout')
@section('title')日志管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            日志管理
            <small>管理后台日志</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="btn-group">
                                    {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.operationLog.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="路由关键词" value="{{ $filter['word'] or '' }}"/>
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
                                        {{--<th><input type="checkbox" class="checkbox-toggle" /></th>--}}
                                        <th>ID</th>
                                        <th>UID</th>
                                        <th>请求路由</th>
                                        <th>请求方式</th>
                                        <th>IP</th>
                                        <th>操作数据</th>
                                        <th>时间</th>
                                    </tr>
                                    @foreach($operations as $operation)
                                        <tr>
                                            {{--<td><input type="checkbox" name="id[]" value="{{ $article->id }}"/></td>--}}
                                            <td>{{ $operation->id }}</td>
                                            <td> @if($operation->user) {{ $operation->user->name }} @else 未知 @endif [uid:{{ $operation->id }}]</td>
                                            <td>{{ $operation->action }}</td>
                                            <td>{{ $operation->method }}</td>
                                            <td>{{ $operation->ip }}</td>
                                            <td width="40%" style="height:80px;">
                                                <div style= "OVERFLOW-Y:auto;height:80px;word-break: break-all">{!! $operation->data !!}</div>
                                            </td>
                                            <td>{{ $operation->created_at }}</td>
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
                                    {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $operations->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $operations->appends($filter)->links()) !!}
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
        set_active_menu('global',"{{ route('admin.operationLog.index') }}");
    </script>
@endsection