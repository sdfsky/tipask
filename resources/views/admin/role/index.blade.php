@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            角色列表
            <small>显示系统中的角色列表</small>
        </h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ url('/admin/role/destroy') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/role/create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新角色"><i class="fa fa-plus"></i></a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle"/></th>
                                    <th>角色名称</th>
                                    <th>角色标示</th>
                                    <th>角色描述</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($roles as $role)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $role->id }}" name="ids[]"/></td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->updated_at }}</td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ url('admin/role/edit/'.$role->id) }}" data-toggle="tooltip" title="编辑角色信息"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $roles->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection