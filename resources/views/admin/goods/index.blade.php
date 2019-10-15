@extends('admin/public/layout')

@section('title')商城管理@endsection

@section('content')
    <section class="content-header">
        <h1>积分商城管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="item_form" id="item_form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.goods.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加商品"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.goods.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>logo</th>
                                        <th>名称</th>
                                        <th>分类</th>
                                        <th>是否需要邮寄</th>
                                        <th>金币</th>
                                        <th>剩余数量</th>
                                        <th>创建时间</th>
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
                                            <td>@if($good->category){{ $good->category->name }} @else 无 @endif</td>
                                            <td>{{ trans_goods_post_type($good->post_type) }}</td>
                                            <td>{{ $good->coins }}</td>
                                            <td>{{ $good->remnants }}</td>
                                            <td>{{ $good->created_at }}</td>
                                            <td><span class="label @if($good->status===0) label-danger  @else label-success @endif">{{ trans_common_status($good->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.goods.edit',['id'=>$good->id]) }}" data-toggle="tooltip" title="编辑公告信息"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
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
        set_active_menu('operations',"{{ route('admin.goods.index') }}");
    </script>
@endsection