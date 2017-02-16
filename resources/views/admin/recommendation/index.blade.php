@extends('admin/public/layout')

@section('title')推荐管理@endsection

@section('content')
    <section class="content-header">
        <h1>推荐管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ route('admin.recommendation.destroy') }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.recommendation.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新推荐"><i class="fa fa-plus"></i></a>
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
                                        <th>排序</th>
                                        <th>推荐标题</th>
                                        <th>URL</th>
                                        <th>状态</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($recommendations as $recommendation)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $recommendation->id }}" name="ids[]"/></td>
                                            <td>{{ $recommendation->sort }}</td>
                                            <td>{{ $recommendation->subject }}</td>
                                            <td>{{ $recommendation->url }}</td>
                                            <td>{{ trans_common_status($recommendation->status) }}</td>
                                            <td>{{ $recommendation->updated_at }}</td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.recommendation.edit',['id'=>$recommendation->id]) }}" data-toggle="tooltip" title="编辑推荐信息"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $recommendations->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.recommendation.index') }}");
    </script>
@endsection