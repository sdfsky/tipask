@extends('admin/public/layout')

@section('title')
    新建用户
@endsection

@section('content')
    <section class="content-header">
        <h1>
            新建用户
            <small>添加新用户</small>
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
                <div class="box box-default">
                    <form role="form" name="userForm" method="POST" action="{{ url('admin/user/create') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">用户名</label>
                          <input type="text" name="name" class="form-control "  placeholder="用户名" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">邮箱</label>
                          <input type="email" name="email" class="form-control"  placeholder="邮箱" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">密码</label>
                          <input type="text" name="password" class="form-control"  placeholder="密码" value="{{ old('password','') }}">
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
@section('script')
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.user.create') }}");
    </script>
@endsection