@extends('theme::profile.layout')

@section('profile_css')
    <link href="{{ asset('/static/js/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/static/js/uploadify/uploadify.css')}}" rel="stylesheet" />

@endsection

@section('main')
    <h2 class="h3 mt30 post-title">个人资料</h2>
    <div class="row mt30">
            <div class="col-md-3 col-md-push-9">
                <img class="avatar-128" id="user_avatar_image" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_big']) }}" alt="头像">
                <div class="change-avatar">
                    <input id="file_upload" name="file_upload" type="file" class="file hide"/>
                    <p class="text-muted mt10">从电脑中选择图片上传, 图像大小不要超过 2 MB</p>
                </div>
                <div class="change-avatar loading hidden">上传中</div>
            </div>
            <div class="col-md-8 col-md-pull-3">
                <form name="baseForm" id="base_form" action="{{ route('auth.profile.base')}}" method="POST">
                    <input type="hidden" name="_token"  value="{{ csrf_token() }}">
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
@endsection

@section('script')
    <script src="{{ asset('/static/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/static/js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
    <script src="{{ asset('/static/js/uploadify/jquery.uploadify.js') }}"></script>

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

            $('#file_upload').uploadify({
                'buttonClass':"btn btn-default",
                'width'    : 80,
                'height'   : 35,
                'swf': '{{ asset('/static/js/uploadify/uploadify.swf') }}',
                'uploader': "{{ route('auth.profile.avatar') }}",
                'method'   : 'post',
                'formData' : {'_token' : '{{ csrf_token() }}'},
                'buttonText' : '修改头像',
                'auto': true,
                'fileObjName': 'user_avatar',
                'multi': false,
                'fileSizeLimit': "2MB",
                'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',
                'fileTypeDesc': '支持的头像格式 (.JPG, .GIF, .PNG,.JPEG)',
                'onUploadSuccess': function() {
                    var user_avatar_image =  $("#user_avatar_image").attr("src")+'?'+Math.random();
                    $("#user_avatar_image").attr("src",user_avatar_image);
                    $.scojs_message('头像修改成功',2);
                }
            });

        });
    </script>
@endsection
