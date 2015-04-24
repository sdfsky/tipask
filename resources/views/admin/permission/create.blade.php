@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            新建权限
            <small>添加新权限</small>
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
                    <form role="form" name="userForm" method="POST" action="{{ url('admin/permission/create') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">权限名</label>
                          <input type="text" name="name" class="form-control "  placeholder="权限名" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">唯一标示</label>
                          <input type="text" name="slug" class="form-control"  placeholder="标示" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">描述</label>
                          <input type="text" name="description" class="form-control"  placeholder="描述" value="{{ old('password','') }}">
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