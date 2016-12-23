@extends('theme::layout.public')

@section('seo_title')专家认证 - {{ Setting()->get('website_name') }}@endsection


@section('css')
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">专家认证 <small>修改认证资料</small></h2>
            <div class="row mt-30">
                <div class="col-md-8">
                    <form name="authForm" id="authentication_form" enctype="multipart/form-data" action="{{ route('auth.authentication.edit')}}" method="POST">
                        <input type="hidden" name="_token"  value="{{ csrf_token() }}" />
                        <input type="hidden" id="tags" name="skill" value="{{ $authentication->skill }}" />

                        <div class="form-group @if ($errors->first('real_name')) has-error @endif">
                            <label for="real_name" class="control-label col-sm-3 required">真实姓名</label>
                            <div class="col-sm-9">
                                <input name="real_name" type="text" maxlength="32" placeholder="真实姓名" class="form-control" value="{{ old('real_name',$authentication->real_name) }}" />
                                @if ($errors->first('real_name'))
                                    <span class="help-block">{{ $errors->first('real_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('id_card')) has-error @endif">
                            <label for="id_card" class="control-label col-sm-3 required">身份照号码</label>
                            <div class="col-sm-9">
                                <input name="id_card" type="text" maxlength="32" placeholder="身份照号码" class="form-control" value="{{ old('id_card',$authentication->id_card) }}" />
                                @if ($errors->first('id_card'))
                                    <span class="help-block">{{ $errors->first('id_card') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('id_card_image')) has-error @endif">
                            <label id="id_card_image" class="control-label col-sm-3 required">身份照正面照片</label>
                            <div class="col-sm-9">
                                <input  class="form-control" type="file" name="id_card_image" />
                                @if ($errors->first('id_card_image'))
                                    <span class="help-block">{{ $errors->first('id_card_image') }}</span>
                                @else
                                    <div class="help-block">
                                        1.请上传身份证正面带有头像的扫描件或清晰照片<br />
                                        2.照片要求格式为JPG/JPEG/GIF/PNG，大小不要超过2M
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('skill')) has-error @endif">
                            <label for="select_tags" class="control-label col-sm-3 required">认证领域</label>
                            <div class="col-sm-9">
                                <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >

                                    @if($authentication->skill)
                                        @foreach( explode(",",old('tags',$authentication->skill)) as $tag)
                                            <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->first('skill'))
                                    <span class="help-block">{{ $errors->first('skill') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->first('skill_image')) has-error @endif">
                            <label id="skill_image" class="control-label col-sm-3 required">专业性证明</label>
                            <div class="col-sm-9">
                                <input  class="form-control" type="file" name="skill_image" />
                                @if ($errors->first('skill_image'))
                                    <span class="help-block">{{ $errors->first('skill_image') }}</span>
                                @else
                                    <div class="help-block">
                                        1.请上传您的工卡、单位证明、资格证书、获奖证书等一切可证明您专家身份的材料照片<br />
                                        2.照片要求格式为JPG/JPEG/GIF/PNG，大小不要超过2M
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                            <label for="captcha" class="required control-label col-sm-3">验证码</label>
                            <div class="col-sm-4">
                                <input id="captcha" name="captcha" type="text" maxlength="32" placeholder="请输入下方验证码" class="form-control" value="{{ old('captcha') }}" />
                                @if ($errors->first('captcha'))
                                    <span class="help-block">{{ $errors->first('captcha') }}</span>
                                @endif
                                <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                            </div>
                        </div>

                        <div class="form-action row">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-xl btn-primary profile-sub" type="submit">提交申请</button>
                                <a class="btn btn-xl btn-default profile-sub" href="{{ route('auth.authentication.index') }}">返回</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $("#select_tags").select2({
                theme:'bootstrap',
                placeholder: "认证领域，例如法律、互联网、电脑等不超过5个词语",
                ajax: {
                    url: '/ajax/loadTags',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            word: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength:1,
                tags:true
            });

            $("#select_tags").change(function(){
                $("#tags").val($("#select_tags").val());
            });


        });
    </script>
@endsection
