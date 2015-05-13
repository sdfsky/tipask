@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            新建角色
            <small>添加新角色</small>
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
                    <form role="form" name="addForm" method="POST" action="{{ url('admin/role/create') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label>角色名称</label>
                          <input type="text" name="name" class="form-control "  placeholder="角色名称" value="{{ old('name','') }}">
                        </div>
                        <div class="form-group">
                          <label>角色标示</label>
                          <input type="text" name="slug" class="form-control "  placeholder="角色英文唯一标示" value="{{ old('slug','') }}">
                        </div>
                        <div class="form-group">
                          <label>角色描述</label>
                            <textarea name="description" class="form-control" placeholder="角色描述">{{ old('description','') }}</textarea>
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