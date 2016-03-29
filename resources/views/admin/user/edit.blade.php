@extends('admin/public/layout')

@section('title')
    编辑用户
@endsection

@section('content')
    <section class="content-header">
        <h1>
            编辑用户
            <small>编辑用户信息</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="userForm" method="POST" action="{{ route('admin.user.update',['id'=>$user->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                          <div class="form-group @if ($errors->has('name')) has-error @endif">
                              <label for="name">用户名</label>
                              <input type="text" name="name" class="form-control " placeholder="登陆用户名" value="{{ old('name',$user->name) }}">
                              @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                          </div>

                          <div class="form-group @if ($errors->has('email')) has-error @endif">
                              <label for="name">邮箱</label>
                              <input type="text" name="email" class="form-control " placeholder="邮箱地址" value="{{ old('email',$user->email) }}">
                              @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                          </div>

                          <div class="form-group @if ($errors->has('password')) has-error @endif">
                              <label for="name">密码</label>
                              <input type="text" name="password" class="form-control " placeholder="邮箱地址" value="" />
                              @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                          </div>

                          <div class="form-group">
                              <label for="name">角色</label>
                              <select class="form-control" name="role_id">
                                    @foreach( $roles as $role )
                                        <option value="{{ $role->id }}" @if($user->getRoles()->contains($role->id)) selected @endif> {{ $role->name }}</option>
                                    @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">保存</button>
                          <button type="reset" class="btn btn-success">重置</button>
                        </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.user.index') }}");
    </script>
@endsection