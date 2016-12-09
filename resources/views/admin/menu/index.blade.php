@extends('admin/public/layout')


@section('content')
    <section class="content-header">
        <h1>
            菜单列表
            @if ( old('pid') == 0)
                [根级菜单]
                @else
                [{{ $_menus[old('pid')]['name'] }}]
                @endif
            <small>显示当前系统设置菜单信息</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ url('/admin/menu/destroy') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                      <div class="row">
                        <div class="col-xs-12">
                             <div class="btn-group">
                                <a href="{{ url('admin/menu/create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新菜单"><i class="fa fa-plus"></i></a>
                                <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
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
                                <td><input type="checkbox" value="{{ $menu->id }}" name="ids[]"/></td>
                                <td><a href="{{ url('/admin/menu/index?pid='.$menu->id) }}" data-toggle="tooltip" title="点击查看子分类">{{ $menu->name }}</a></td>
                                <td>
                                    @if ($menu->pid==0)
                                        无
                                    @else
                                        <a href="{{ url('/admin/menu/index?pid=0') }}">{{ $_menus[$menu->pid]['name'] }}</a>
                                    @endif
                                </td>
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
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection