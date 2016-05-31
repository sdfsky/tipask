@extends('admin/public/layout')
@section('title')注册设置@endsection
@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            注册设置
            <small>全站注册策略设置</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.register') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">允许新用户注册</label>
                                <span class="text-muted">(若不需要新用户注册，可以到用户管理里面手动添加用户	)</span>
                                <div class="radio">
                                    <label><input type="radio" name="register_open" value="1" @if(Setting()->get('register_open') == 1) checked @endif > 允许 </label>
                                    <label class="ml-20"><input type="radio" name="register_open" value="0" @if(Setting()->get('register_open') != 1) checked @endif > 拒绝 </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="website_url">注册欢迎语</label>
                                <input type="text" class="form-control" name="register_title" placeholder="欢迎加入Tipask站长社区" value="{{ old('register_title',Setting()->get('register_title')) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="register_license">用户注册协议</label>
                                <textarea name="register_license" id="register_license" class="form-control"  style="height:300px;">{{ old('register_license',Setting()->get('register_license')) }}</textarea>

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
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            set_active_menu('global',"{{ route('admin.setting.register') }}");
            $('#register_license').summernote({
                height: 300,
                placeholder:true,
                toolbar:ask_editor_options.toolbar,
                codemirror:ask_editor_options.codemirror,
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"register_license",$("#editor_token").val());
                }
            });

        });
    </script>
@endsection