@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            菜单列表
            <small>显示当前系统设置菜单信息</small>
        </h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                      <div class="row">
                        <div class="col-xs-6">
                             <div class="btn-group">
                                <a href="{{ url('admin/menu/create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新菜单"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                              </div>
                               <button class="btn btn-default btn-sm" data-toggle="tooltip" title="返回上一级"><i class="fa fa-reply"></i></button>

                        </div>
                        <div class="col-xs-6">
                        <div class="input-group">
                             <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
                             <div class="input-group-btn">
                               <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                             </div>
                             <div class="clearfix"></div>
                              <div class="input-group-btn">
                               <button class="btn btn-sm bg-olive btn-flat">高级搜索</button>
                             </div>

                           </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-body  no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th><input type="checkbox" class="checkbox-toggle"/></th>
                                <th>菜单名</th>
                                <th>上级菜单</th>
                                <th>URL</th>
                                <th>排序</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($menus as $menu)
                            <tr>
                                <td><input type="checkbox" value="{{ $menu->id }}"/></td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->pid }}</td>
                                <td>{{ $menu->url }}</td>
                                <td>{{ $menu->sort }}</td>
                                <td>{{ $menu->updated_at }}</td>
                                <td>
                                    <div class="btn-group-xs" >
                                      <a class="btn btn-default" href="{{ url('admin/menu/edit/'.$menu->id) }}" data-toggle="tooltip" title="编辑菜单信息"><i class="fa fa-edit"></i></a>
                                     </div>
                                </td>
                            </tr>
                            @endforeach
                           </table>
                    </div>
                    <div class="box-footer clearfix">
                        {!! str_replace('/?', '?', $menus->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection