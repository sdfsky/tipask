@extends('admin/public/layout')
@section('title')XunSearch整合@endsection
@section('content')
    <section class="content-header">
        <h1>
            XunSearch全文检索整合
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info" role="alert">xunsearch的安装就配置参见http://www.xunsearch.com/ 官网教程</div>

                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.xunSearch') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启XunSearch全文检索</label>
                                <span class="text-muted">(开启前一定要确认xunsearch安装好并且已开启服务)</span>
                                <div class="radio">
                                    <label><input type="radio" name="xunsearch_open" value="1" @if(Setting()->get('xunsearch_open','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="xunsearch_open" value="0" @if(Setting()->get('xunsearch_open','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="website_url">搜索框提示语</label>
                                <input type="text" class="form-control" name="search_placeholder" placeholder="输入关键词" value="{{ old('search_placeholder',Setting()->get('search_placeholder')) }}"  />
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">XunSearch索引管理</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-xs-4">
                                <a href="{{ route('admin.xunSearch.rebuild') }}" class="btn btn-success btn-block">重建索引</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="{{ route('admin.xunSearch.clear') }}" class="btn btn-warning btn-block">清除索引</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            set_active_menu('third_part',"{{ route('admin.setting.xunSearch') }}");


        });
    </script>
@endsection