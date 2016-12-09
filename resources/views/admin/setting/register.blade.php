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
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="addForm" id="register_form" method="POST" action="{{ route('admin.setting.register') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">允许新用户注册</label>
                                <span class="text-muted">(若不需要新用户注册，可以到用户管理里面手动添加用户	)</span>
                                <div class="radio">
                                    <label><input type="radio" name="register_open" value="1" @if(Setting()->get('register_open','1') == 1) checked @endif > 允许 </label>
                                    <label class="ml-20"><input type="radio" name="register_open" value="0" @if(Setting()->get('register_open','1') != 1) checked @endif > 拒绝 </label>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="website_url">24小时内同一IP的最大注册用户数目</label>
                                <span class="text-muted">(设置为0代表不做任何限制)</span>
                                <input type="text" class="form-control" name="register_limit_num" placeholder="0为不限制" value="{{ old('register_limit_num',Setting()->get('register_limit_num' , 0)) }}"  />
                            </div>

                            <div class="form-group">
                                <label for="website_url">注册欢迎语</label>
                                <input type="text" class="form-control" name="register_title" placeholder="欢迎加入Tipask站长社区" value="{{ old('register_title',Setting()->get('register_title')) }}"  />
                            </div>

                            <div class="form-group">
                                <label for="register_editor">用户注册协议</label>
                                <div id="register_editor">{!! old('register_license',Setting()->get('register_license')) !!}</div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" id="register_editor_content"  name="register_license" value="{{ old('register_license',Setting()->get('register_license')) }}"  />
                            <button type="submit" class="btn btn-primary editor-submit" >保存</button>
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
    <script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            set_active_menu('global',"{{ route('admin.setting.register') }}");
            $('#register_editor').summernote({
                lang: 'zh-CN',
                height: 300,
                placeholder:'完善用户注册协议',
                toolbar: [ {!! config('tipask.summernote.blog') !!} ],
                callbacks: {
                    onChange:function (contents, $editable) {
                        var code = $(this).summernote("code");
                        $("#register_editor_content").val(code);
                    },
                    onImageUpload: function(files) {
                        upload_editor_image(files[0],'register_editor');
                    }
                }
            });

        });
    </script>
@endsection