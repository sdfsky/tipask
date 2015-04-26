@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            新建菜单
            <small>添加新菜单</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/public/error')
                <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">基本信息</h3>
                    </div>
                    <form role="form" name="addForm" method="POST" action="{{ url('admin/menu/create') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label>名称</label>
                          <input type="text" name="name" class="form-control "  placeholder="菜单名" value="{{ old('name','') }}">
                        </div>
                        <div class="form-group">
                          <label>URL</label>
                          <input type="text" name="url" class="form-control "  placeholder="菜单链接地址" value="{{ old('url','') }}">
                        </div>
                        <div class="form-group">
                          <label>上级菜单</label>
                          <select name="pid" class="form-control ">
                            <option value="0">顶级菜单</option>
                              @foreach($_menus as $_menu)
                                  @if($_menu['pid']==0)
                                      <option value="{{ $_menu['id'] }}" @if(old('pid')==$_menu['id']) selected @endif>{{ $_menu['name'] }}</option>
                                  @endif
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label>排序</label>
                          <input type="text" name="sort" class="form-control"  placeholder="菜单显示顺序" value="{{ old('sort',0) }}">
                        </div>
                        <div class="form-group">
                          <label>图标</label>
                          <input type="text" name="icon" class="form-control"  placeholder="菜单字体图标" value="{{ old('icon','') }}">
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
@endsection