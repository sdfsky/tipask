@extends('theme::layout.public')

@section('seo_title')个人资料 - {{ Setting()->get('website_name') }}@endsection

@section('css')
    <link href="{{ asset('/static/js/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet" />
    <link href="{{ asset('/static/js/cropper/cropper.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal main">
            <h2 class="h3 post-title">个人资料</h2>
            <div class="row mt-30">
                <div class="col-md-3 col-md-push-9 text-center">
                    <img class="avatar-128" id="user_avatar_image" src="{{ get_user_avatar(Auth()->user()->id,'big') }}" alt="头像">
                    <div class="wu-example mt-10">
                        <div class="change-avatar">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#avatar_modal">修改头像</button>
                            <p class="text-muted mt-10">从电脑中选择图片上传, 图像大小不要超过 2 MB</p>
                            <div class="modal fade" id="avatar_modal" tabindex="-1" role="dialog" aria-labelledby="avatar_model_label">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="avatar_model_label">修改头像</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-6 text-center">
                                                    <div id="avatar_origin" class="avatar-container">
                                                        <img class="avatar-origin" src="{{ get_user_avatar(Auth()->user()->id,'origin','jpg',true) }}">
                                                    </div>
                                                    <!--用来存放文件信息-->
                                                    <div id="uploader">
                                                        <div id="fileList" class="uploader-list"></div>
                                                        <div id="filePicker" class="picker-container">选择图片</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 text-center mt-5">
                                                    <div class="preview-container img-preview">
                                                    </div>
                                                    <button id="avatar_btn" type="button" class="btn btn-primary mt-20">保存头像</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-3">
                    <form name="baseForm" id="base_form" action="{{ route('auth.profile.base')}}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group @if ($errors->first('name')) has-error @endif">
                            <label for="name" class="required control-label col-sm-3">姓名</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" maxlength="32" placeholder="姓名" class="form-control" value="{{ old('name',Auth()->user()->name) }}" />
                                @if ($errors->first('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">性别</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input name="gender" type="radio" value="1" @if(Auth()->user()->gender==1) checked @endif > 男</label>
                                <label class="radio-inline"><input name="gender" type="radio" value="2" @if(Auth()->user()->gender==2) checked @endif> 女</label>
                                <label class="radio-inline"><input name="gender" type="radio" value="0" @if(Auth()->user()->gender==0) checked @endif> 保密</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="setting-birthday" class="control-label col-sm-3">生日</label>
                            <div class="col-sm-9">
                                <input name="birthday" id="birthday" type="text" placeholder="格式 YYYY-MM-DD" value="{{ Auth()->user()->birthday }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="setting-city" class="control-label col-sm-3">所在城市</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="province" id="province">
                                    <option value="0">请选择省份</option>
                                    @foreach($data['provinces'] as $province)
                                        <option value="{{ $province->id }}"  @if(Auth()->user()->province == $province->id) selected @endif>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="form-control" name="city" id="city">
                                    <option value="0">请选择城市</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{ $city->id }}" @if(Auth()->user()->city == $city->id) selected @endif >{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label col-sm-3">身份职业</label>
                            <div class="col-sm-9">
                                <input name="title" id="title" type="text" maxlength="32" placeholder="例如：汽车制造 / 产品设计师 / 登山爱好者" class="form-control" value="{{ Auth()->user()->title }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="setting-description" class="control-label col-sm-3">自我介绍</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="setting-description" class="form-control mono" rows="6">{{ Auth()->user()->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="setting-description" class="control-label col-sm-3">支付二维码</label>
                            <div class="col-sm-9">
                                <input type="file" name="qrcode"/>
                                @if($errors->has('qrcode')) <p class="help-block">{{ $errors->first('qrcode') }}</p> @else <p class="help-block">可上传微信或支付宝的收款二维码图片</p> @endif
                                @if(Auth()->user()->qrcode)
                                    <div style="margin-top: 10px;">
                                        <img src="{{ route('website.image.show',['image_name'=>Auth()->user()->qrcode]) }}" />
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-action row mb-30">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-xl btn-primary profile-sub" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('/static/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/static/js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
    <script src="{{ asset('/static/js/webuploader/webuploader.min.js') }}"></script>
    <script src="{{ asset('/static/js/cropper/cropper.min.js') }}"></script>

    <script type="text/javascript">
        $(function(){
            /*生日日历*/
            $("#birthday").datepicker({
                format: "yyyy-mm-dd",
                language: "zh-CN",
                calendarWeeks: true,
                autoclose: true
            });

            /*加载省份城市*/
            $("#province").change(function(){
                var province_id = $(this).val();
                $("#city").load("{{ url('ajax/loadCities') }}/"+province_id);
            });

            var filePicker = $('#filePicker');
            var avatar_origin = $('#avatar_origin img');
            var avatar_modal = $('#avatar_modal');

            avatar_modal.on('shown.bs.modal', function(e) {
                var user_avatar = avatar_origin.attr("src").split("?")[0] + "?" + Math.random();
                avatar_origin.attr("src",user_avatar);
                avatar_origin.cropper({
                    aspectRatio: 1/1,
                    modal: false,
                    movable: false,
                    zoomable: false,
                    preview: ".img-preview",
                    done: function(data) {
                        console.log(data);
                    }
                });

                var uploader = WebUploader.create({

                    // 选完文件后，是否自动上传。
                    auto: true,

                    // swf文件路径
                    swf: "{{ asset('/static/js/webuploader/Uploader.swf') }}",

                    // 文件接收服务端。
                    server: "{{ route('auth.profile.avatar') }}",

                    formData: {
                        _token:'{{ csrf_token() }}'
                    },
                    method:'POST',
                    fileVal:'user_avatar',
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: '#filePicker',
                    fileSingleSizeLimit: 2 * 1024 * 1024,    // 2M
                    duplicate: true,
                    // 只允许选择图片文件。
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,png',
                        mimeTypes: 'image/*'
                    },
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false
                });

                var webuploader_pick = $('.webuploader-pick');

                uploader.on('error', function(msg) {
                    if (msg == 'F_EXCEED_SIZE') {
                        alert("图片大小不能越过2M");
                    } else if (msg == 'Q_TYPE_DENIED') {
                        alert("只支持GIF,JPG,JPEG,PNG图片格式");
                    } else {
                        alert(msg);
                    }
                });

                // 文件上传过程中创建进度条实时显示。
                uploader.on('uploadProgress', function(file, percentage) {
                    webuploader_pick.text(parseInt(percentage * 100) + '%');
                });

                uploader.on('uploadSuccess', function(file, response) {
                    var user_avatar = avatar_origin.attr("src").split("?")[0] + "?" + Math.random();
                    avatar_origin.attr("src",user_avatar);
                    avatar_origin.cropper('destroy');
	                avatar_origin.cropper({
                        aspectRatio: 1/1,
                        modal: false,
                        movable: false,
                        zoomable: false,
                        preview: ".img-preview",
                        done: function(data) {
                            console.log(data);
                        }
                    });
                    $('#uploader').addClass('webuploader-element-invisible');
                    console.log(response);
                });

                uploader.on('uploadError', function(file, reason) {
                    alert('上传出错,错误原因：' + reason);
                    webuploader_pick.text('选择图片');
                });
            });

            avatar_modal.on('hidden.bs.modal', function(e) {
                $('#uploader').removeClass('webuploader-element-invisible');
                filePicker.removeClass('webuploader-container');
                filePicker.text('选择图片');
                avatar_origin.cropper('destroy');
            });

            $('#avatar_btn').click(function(){
                var cropper = avatar_origin.cropper('getData');
                $.post("{{ route('auth.profile.avatar') }}", {_token: '{{ csrf_token() }}', x: cropper.x, y: cropper.y, width: cropper.width, height: cropper.height}, function(data){
                    console.log(data);
                    if (data.status === 1) {
                        var user_avatar_image = $('#user_avatar_image');
                        user_avatar_image.attr("src", user_avatar_image.attr("src").split("?")[0] + "?" + Math.random());
                        var avatar_middle = $('.avatar-32');
                        avatar_middle.attr("src", avatar_middle.attr("src").split("?")[0] + "?" + Math.random());
                        avatar_modal.modal('hide');
                    }
                });
            });
        });
    </script>
@endsection
