@extends('admin/public/layout')
@section('title')
    添加友情链接
@endsection
@section('content')
    <section class="content-header">
        <h1>
            友情链接管理
            <small>添加友情链接</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/public/error')
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.friendshipLink.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label>链接名称</label>
                                <input type="text" name="name" class="form-control " placeholder="友情链接名称" value="{{ old('name','') }}">
                                @if($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('slogan')) has-error @endif">
                                <label>链接口号</label>
                                <input type="text" name="slogan" class="form-control " placeholder="网站口号，slogan" value="{{ old('slogan','') }}">
                                @if($errors->has('slogan')) <p class="help-block">{{ $errors->first('slogan') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('url')) has-error @endif">
                                <label>链接地址</label>
                                <span class="text-muted">请输入完整地址，例如：http://www.tipask.com</span>

                                <input type="text" name="url" class="form-control " placeholder="链接地址，以http:// 开头" value="{{ old('url','') }}">
                                @if($errors->has('url')) <p class="help-block">{{ $errors->first('url') }}</p> @endif
                            </div>


                            <div class="form-group @if($errors->has('sort')) has-error @endif">
                                <label>显示顺序</label>
                                <input type="text" name="sort" class="form-control " placeholder="显示顺序" value="{{ old('sort',0) }}">
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
        set_active_menu('operations',"{{ route('admin.friendshipLink.index') }}");
    </script>
@endsection
