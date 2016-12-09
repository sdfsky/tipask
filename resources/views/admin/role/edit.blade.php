@extends('admin/public/layout')
@section('title')编辑角色@endsection
@section('content')
    <section class="content-header">
        <h1>
            角色编辑
            <small>修改角色信息</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_base" data-toggle="tab" aria-expanded="false">基本信息</a></li>
                        <li><a href="#tab_permission" data-toggle="tab" aria-expanded="true">权限设置</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_base">
                            <form role="form" name="editForm" method="POST" action="{{ route('admin.role.update',['id'=>$role->id]) }}">
                                <input name="_method" type="hidden" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                                        <label for="name">角色名称</label>
                                        <input type="text" name="name" class="form-control " placeholder="角色名称" value="{{ old('name',$role->name) }}">
                                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>

                                    <div class="form-group @if ($errors->has('slug')) has-error @endif">
                                        <label for="name">唯一标示</label>
                                        <input type="text" name="slug" class="form-control " placeholder="角色唯一标示" value="{{ old('slug',$role->slug) }}">
                                        @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
                                    </div>

                                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                                        <label for="name">描述</label>
                                        <input type="text" name="description" class="form-control " placeholder="角色描述" value="{{ old('description',$role->description) }}">
                                        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <button type="reset" class="btn btn-success">重置</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_permission">
                            <form role="form" name="permissionForm" method="POST" action="{{ route('admin.role.permission',['id'=>$role->id]) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                    <h4>后台权限</h4>
                                    <div class="form-group">
                                        @foreach($permission['admin'] as $admin_permission)
                                        <div class="col-xs-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{ $admin_permission->id }}" @if(in_array($admin_permission->id,$role_permission_ids->all())) checked @endif/>
                                                    {{ $admin_permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
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

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        set_active_menu('admin',"{{ route('admin.role.index') }}");
    </script>
@endsection