@extends('admin/public/layout')
@section('title')
    添加分类
@endsection
@section('content')
    <section class="content-header">
        <h1>
            分类管理
            <small>添加分类</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST"  action="{{ route('admin.category.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label>分类名称</label>
                                <input type="text" name="name" class="form-control " placeholder="分类名称" value="{{ old('name','') }}">
                                @if($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('slug')) has-error @endif">
                                <label>分类标识</label>
                                <span class="text-muted">(英文字母)</span>
                                <input type="text" name="slug" class="form-control " placeholder="分类标识" value="{{ old('slug','') }}">
                                @if($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
                            </div>


                            <div class="form-group">
                                <label>栏目</label>
                                <span class="text-muted">(允许显示的栏目)</span>
                                <div class="checkbox">
                                    @foreach( config('tipask.category_types') as $key => $name )
                                        <input type="checkbox" name="types[]" value="{{ $key }}"> {{ $name }} &nbsp;&nbsp;
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('sort')) has-error @endif">
                                <label>排序</label>
                                <span class="text-muted">(仅对当前层级分类有效)</span>
                                <input type="text" name="sort" class="form-control " placeholder="排序" value="{{ old('sort','') }}">
                                @if($errors->has('sort')) <p class="help-block">{{ $errors->first('sort') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" checked /> 启用
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" /> 禁用
                                    </label>
                                </div>
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
        $(function(){
            set_active_menu('manage_content',"{{ route('admin.category.index') }}");
        });
    </script>
@endsection
