@extends('admin/public/layout')
@section('title')IP黑名单管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            IP黑名单管理
            <small>管理系统IP黑名单</small>
        </h1>
    </section>
    <section class="content">
        <div class="box panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">添加黑名单</h3>
            </div>
            <div class="panel-body">
                <form class="form-inline" method="post" action="{{ route('admin.banIp.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="sr-only" for="ip_text">Email address</label>
                        <input type="text" class="form-control" name="ip"  placeholder="ip地址" />
                    </div>
                    <button type="submit" class="btn btn-warning">添加</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.banIp.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.banIp.index') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
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
                                        <th>ID</th>
                                        <th>操作人</th>
                                        <th>IP</th>
                                        <th>添加时间</th>
                                    </tr>
                                    @foreach($ip as $value)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $value->id }}"/></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->user->name }}<span class="text-muted">[UID:{{ $value->user_id }}]</span></td>
                                            <td>{{ $value->ip }}</td>
                                            <td>{{ timestamp_format($value->created_at) }}</td>
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
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $ip->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $ip->appends($filter)->links()) !!}
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
        set_active_menu('global',"{{ route('admin.banIp.index') }}");
    </script>
@endsection