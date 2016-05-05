@extends('admin/public/layout')

@section('title')商城管理@endsection

@section('content')
    <section class="content-header">
        <h1>积分商城管理</h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ route('admin.notice.destroy') }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.goods.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新公告"><i class="fa fa-plus"></i></a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle"/></th>
                                    <th>logo</th>
                                    <th>名称</th>
                                    <th>金币</th>
                                    <th>剩余数量</th>
                                    <th>添加时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($goods as $good)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $good->id }}" name="ids[]"/></td>
                                        <td>
                                            @if($good->logo)
                                                <img src="{{ route('website.image.show',['image_name'=>$good->logo]) }}"  style="width: 27px;"/>
                                            @endif
                                        </td>
                                        <td>{{ $good->name }}</td>
                                        <td>{{ $good->coins }}</td>
                                        <td>{{ $good->created_at }}</td>
                                        <td>{{ $good->updated_at }}</td>
                                        <td>{{ trans_common_status($good->status) }}</td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.goods.edit',['id'=>$good->id]) }}" data-toggle="tooltip" title="编辑公告信息"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $goods->render()) !!}
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