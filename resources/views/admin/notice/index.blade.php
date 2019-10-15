@extends('admin/public/layout')

@section('title')公告管理@endsection

@section('content')
    <section class="content-header">
        <h1>公告管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ route('admin.notice.destroy') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.notice.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新公告"><i class="fa fa-plus"></i></a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>公告标题</th>
                                        <th>URL</th>
                                        <th>状态</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($notices as $notice)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $notice->id }}" name="ids[]"/></td>
                                            <td @if($notice->style) {!! $notice->style !!} @endif> {!! $notice->subject !!}</td>
                                            <td>{{ $notice->url }}</td>
                                            <td>{{ trans_common_status($notice->status) }}</td>
                                            <td>{{ $notice->updated_at }}</td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.notice.edit',['id'=>$notice->id]) }}" data-toggle="tooltip" title="编辑公告信息"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $notices->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.notice.index') }}");
    </script>
@endsection