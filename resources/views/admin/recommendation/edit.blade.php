@extends('admin/public/layout')
@section('title')推荐管理@endsection

@section('content')
    <section class="content-header">
        <h1>
            推荐管理
            <small>编辑推荐</small>
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
                    <form role="form" name="editForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.recommendation.update',['id'=>$recommendation->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>推荐标题</label>
                                <input type="text" name="subject" class="form-control "  placeholder="推荐标题" value="{{ old('subject',$recommendation->subject) }}">
                            </div>
                            <div class="form-group">
                                <label>推荐链接地址</label>
                                <input type="text" name="url" class="form-control "  placeholder="http://www.tipask.com" value="{{ old('url',$recommendation->url) }}">
                            </div>
                            <div class="form-group">
                                <label>logo图片</label>
                                <input type="file" name="logo" />
                                <div style="margin-top: 10px;">
                                    <img src="{{ route('website.image.show',['image_name'=>$recommendation->logo]) }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>排序</label>
                                <input type="text" name="sort" class="form-control "  placeholder="请输入整数，小的排前面" value="{{ old('sort',$recommendation->sort ) }}">
                            </div>
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($recommendation->status===1) checked @endif /> 已审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($recommendation->status===0) checked @endif /> 待审核
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
