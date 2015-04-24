@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            编辑用户
            <small>编辑用户信息</small>
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
                    <form role="form" name="userForm" method="POST" action="{{ url('admin/permission/edit/'.$permission->id) }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">权限名</label>
                          <input type="text" name="name" class="form-control "  placeholder="用户名" value="{{ old('name',$permission->name) }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">标示</label>
                          <input type="text" name="slug" class="form-control"  placeholder="邮箱" value="{{ old('email',$permission->slug) }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">密码</label>
                          <input type="text" name="description" class="form-control"  placeholder="描述" value="{{ old('description',$permission->description) }}">
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