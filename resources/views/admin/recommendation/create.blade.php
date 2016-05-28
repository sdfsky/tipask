@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            推荐管理
            <small>添加推荐</small>
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
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.recommendation.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>推荐标题</label>
                                <input type="text" name="subject" class="form-control "  placeholder="推荐标题" value="{{ old('subject','') }}">
                            </div>
                            <div class="form-group">
                                <label>推荐链接地址</label>
                                <input type="text" name="url" class="form-control "  placeholder="http://www.tipask.com" value="{{ old('url','') }}">
                            </div>
                            <div class="form-group">
                                <label>logo图片</label>
                                <input type="file" name="logo" />
                            </div>
                            <div class="form-group">
                                <label>排序</label>
                                <input type="text" name="sort" class="form-control "  placeholder="请输入整数，小的排前面" value="{{ old('sort','') }}">
                            </div>
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" checked /> 已审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" /> 待审核
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
        set_active_menu('operations',"{{ route('admin.recommendation.index') }}");
    </script>
@endsection
