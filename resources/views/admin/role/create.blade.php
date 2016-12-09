@extends('admin/public/layout')
@section('title')新建角色@endsection
@section('content')
    <section class="content-header">
        <h1>
            新建角色
            <small>添加新角色</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.role.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label for="name">角色名称</label>
                                <input type="text" name="name" class="form-control " placeholder="角色名称" value="{{ old('name','') }}">
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="form-group @if ($errors->has('slug')) has-error @endif">
                                <label for="name">唯一标示</label>
                                <input type="text" name="slug" class="form-control " placeholder="角色唯一标示" value="{{ old('slug','') }}">
                                @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
                            </div>

                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="name">描述</label>
                                <input type="text" name="description" class="form-control " placeholder="角色描述" value="{{ old('description','') }}">
                                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
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
        set_active_menu('admin',"{{ route('admin.role.index') }}");
    </script>
@endsection