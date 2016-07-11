@extends('theme::layout.public')

@section('seo_title')个人资料 - {{ Setting()->get('website_name') }}@endsection

@section('css')
    <link href="{{ asset('/static/js/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">个人资料</h2>
            <div class="row mt-30">
                <div class="col-md-3 col-md-push-9">
                    <img class="avatar-128" id="user_avatar_image" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_big']) }}" alt="头像">

                    <div id="uploader" class="wu-example mt-10">
                        <!--用来存放文件信息-->
                        <div id="thelist" class="uploader-list"></div>
                        <div class="change-avatar">
                            <div id="picker">修改头像</div>
                            <p class="text-muted mt-10">从电脑中选择图片上传, 图像大小不要超过 2 MB</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-3">
                    <form name="baseForm" id="base_form" action="{{ route('auth.profile.base')}}" method="POST">
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
                                    <option>请选择省份</option>
                                    @foreach($data['provinces'] as $province)
                                        <option value="{{ $province->id }}"  @if(Auth()->user()->province == $province->id) selected @endif>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="form-control" name="city" id="city">
                                    <option>请选择城市</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{ $city->id }}" @if(Auth()->user()->city == $city->id) selected @endif >{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label col-sm-3">一句话介绍</label>
                            <div class="col-sm-9">
                                <input name="title" id="title" type="text" maxlength="32" placeholder="例如：汽车制造 / 产品设计师 / 登山爱好者" class="form-control" value="{{ Auth()->user()->title }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="setting-description" class="control-label col-sm-3">自我简介</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="setting-description" class="form-control mono" rows="6">{{ Auth()->user()->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-action row">
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
                pick: '#picker',
                fileNumLimit: 1,
                fileSizeLimit: 2 * 1024 * 1024,    // 200 M
                fileSingleSizeLimit: 2 * 1024 * 1024,    // 50 M
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,png',
                    mimeTypes: 'image/*'
                },
                fileNumLimit: 1,
                fileSingleSizeLimit: 2 * 1024 * 1024,
                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false
            });

            uploader.on('error', function( msg ) {
                alert("图片上传大小不能超过2M");
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                        $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<div class="progress progress-striped active">' +
                            '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                            '</div>' +
                            '</div>').appendTo( $li ).find('.progress-bar');
                }

                $li.find('p.state').text('上传中');
                $percent.css( 'width', percentage * 100 + '%' );
            });

            uploader.on('uploadSuccess', function( file ,response) {
                $( '#'+file.id ).find('p.state').text('');
                var user_avatar = $('#user_avatar_image').attr("src")+"?"+Math.random();
                $('#user_avatar_image').attr("src",user_avatar);
                console.log('success'+response.message);
            });

            uploader.on('uploadError', function( file,reason ) {
                $( '#'+file.id ).find('p.state').text('上传出错');
            });

            uploader.on('uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').fadeOut();
            });

        });
    </script>
@endsection
