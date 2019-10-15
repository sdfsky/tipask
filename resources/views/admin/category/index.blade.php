@extends('admin/public/layout')

@section('title')分类管理@endsection

@section('content')
    <section class="content-header">
        <h1>分类管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="item_form" id="item_form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('admin.category.index') }}">根分类</a></li>
                                @foreach($parentCategoies as $parentCategory)
                                @if($parentId == $parentCategory->id)
                                        <li><b>{{ $parentCategory->name }}</b></li>
                                @else
                                        <li><a href="{{ route('admin.category.index',['parent_id'=>$parentCategory->id]) }}">{{ $parentCategory->name }}</a></li>
                                @endif
                                @endforeach
                            </ol>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加分类"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.category.destroy') }}','删除选中分类会同时删除其子分类，确认继续操作？')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>ID</th>
                                        <th>排序</th>
                                        <th>名称</th>
                                        <th>标示</th>
                                        <th>所属栏目</th>
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $category->id }}" name="ids[]"/></td>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->sort }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->type }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td><span class="label @if($category->status===0) label-danger  @else label-success @endif">{{ trans_common_status($category->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    @if( $category->grade < 3 )
                                                    <a class="btn btn-default" href="{{ route('admin.category.index',['parent_id'=>$category->id]) }}" data-toggle="tooltip" title="查看子分类"><i class="fa fa-bars" aria-hidden="true"></i> 查看</a>
                                                    <a class="btn btn-warning" href="{{ route('admin.category.create',['parent_id'=>$category->id]) }}" data-toggle="tooltip" title="添加子分类"><i class="fa fa-plus-circle" aria-hidden="true"></i> 添加</a>
                                                    @endif
                                                    <a class="btn btn-primary" href="{{ route('admin.category.edit',['id'=>$category->id]) }}" data-toggle="tooltip" title="编辑分类信息"><i class="fa fa-edit" aria-hidden="true"></i> 编辑</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $categories->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.category.index') }}");
    </script>
@endsection