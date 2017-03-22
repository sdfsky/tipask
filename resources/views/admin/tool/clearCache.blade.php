@extends('admin/public/layout')
@section('title')缓存管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            缓存管理
            <small>更新系统相关缓存数据</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.tool.clearCache') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group ">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='cacheItems[]' value="data" checked="checked"/>
                                            更新数据缓存
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="cacheItems[]" value="view" checked="checked"/>
                                            更新模板缓存
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">更新</button>
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
        set_active_menu('root_menu',"{{ route('admin.tool.clearCache') }}");
    </script>
@endsection