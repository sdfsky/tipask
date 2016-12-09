@extends('admin/public/layout')
@section('title')编辑友情链接@endsection
@section('content')
    <section class="content-header">
        <h1>
            编辑友情链接
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" action="{{ route('admin.friendshipLink.update',['id'=>$link->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label>链接名称</label>
                                <input type="text" name="name" class="form-control " placeholder="友情链接名称" value="{{ old('name',$link->name) }}">
                                @if($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('slogan')) has-error @endif">
                                <label>链接口号</label>
                                <input type="text" name="slogan" class="form-control " placeholder="网站口号，slogan" value="{{ old('slogan',$link->slogan) }}">
                                @if($errors->has('slogan')) <p class="help-block">{{ $errors->first('slogan') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('url')) has-error @endif">
                                <label>链接地址</label>
                                <input type="text" name="url" class="form-control " placeholder="网站地址" value="{{ old('url',$link->url) }}">
                                @if($errors->has('url')) <p class="help-block">{{ $errors->first('url') }}</p> @endif
                            </div>


                            <div class="form-group @if($errors->has('sort')) has-error @endif">
                                <label>显示顺序</label>
                                <input type="text" name="sort" class="form-control " placeholder="显示顺序" value="{{ old('sort',$link->sort) }}">
                                @if($errors->has('sort')) <p class="help-block">{{ $errors->first('sort') }}</p> @endif
                            </div>


                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($link->status === 1) checked @endif/> 启用
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($link->status === 0) checked @endif/> 禁用
                                    </label>
                                </div>
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
        set_active_menu('operations',"{{ route('admin.friendshipLink.index') }}");
    </script>
@endsection