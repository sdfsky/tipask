@extends('admin/public/layout')

@section('title')友情链接管理@endsection

@section('content')
    <section class="content-header">
        <h1>友情链接管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="item_form" id="item_form" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.friendshipLink.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加友情链接"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.friendshipLink.destroy') }}','确定删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>显示顺序</th>
                                        <th>网站名称</th>
                                        <th>网站slogan</th>
                                        <th>网站URL</th>
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($links as $link)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $link->id }}" name="ids[]"/></td>
                                            <td>{{ $link->sort }}</td>
                                            <td>{{ $link->name }}</td>
                                            <td>{{ $link->slogan }}</td>
                                            <td>{{ $link->url }}</td>
                                            <td>{{ $link->created_at }}</td>
                                            <td><span class="label @if($link->status===0) label-danger  @else label-success @endif">{{ trans_common_status($link->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.friendshipLink.edit',['id'=>$link->id]) }}" data-toggle="tooltip" title="编辑公告信息"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $links->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.friendshipLink.index') }}");
    </script>
@endsection