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

        <div id="main" class="settings col-md-10 form-horizontal main">
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
                        <div class="form-group">
                            <label class="control-label col-sm-3">性别</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input name="gender" type="radio" value="1" @if( old('gender',$authentication->gender) == 1 ) checked @endif > 男</label>
                                <label class="radio-inline"><input name="gender" type="radio" value="2" @if( old('gender',$authentication->gender)==2 ) checked @endif> 女</label>
                                <label class="radio-inline"><input name="gender" type="radio" value="0" @if( old('gender',$authentication->gender)==0 ) checked @endif> 保密</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="setting-city" class="control-label col-sm-3">所在城市</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="province" id="province">
                                    <option>请选择省份</option>
                                    @foreach($areaData['provinces'] as $province)
                                        <option value="{{ $province->id }}"  @if( old('province',$authentication->province) == $province->id) selected @endif>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="form-control" name="city" id="city">
                                    <option>请选择城市</option>
                                    @foreach($areaData['cities'] as $city)
                                        <option value="{{ $city->id }}" @if( old('city',$authentication->city) == $city->id) selected @endif >{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->first('title')) has-error @endif">
                            <label for="name" class="control-label col-sm-3">身份职业</label>
                            <div class="col-sm-9">
                                <input name="title" id="title" type="text" maxlength="32" placeholder="例如：汽车制造 / 产品设计师 / 登山爱好者" class="form-control" value="{{ old('title',$authentication->title) }}" />
                                @if ($errors->first('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->first('description')) has-error @endif">
                            <label for="setting-description" class="control-label col-sm-3">自我介绍</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="setting-description" class="form-control" rows="6">{{ old('description',$authentication->description) }}</textarea>
                                @if ($errors->first('description'))
                                    <span class="help-block">{{ $errors->first('description') }}</span>
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
                        <div class="form-group @if ($errors->first('skill_image')) has-error @endif ">
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

                        <div class="form-action row mb-30">
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

            /*加载省份城市*/
            $("#province").change(function(){
                var province_id = $(this).val();
                $("#city").load("{{ url('ajax/loadCities') }}/"+province_id);
            });
        });
    </script>
@endsection
