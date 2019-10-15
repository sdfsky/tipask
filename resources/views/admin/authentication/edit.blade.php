@extends('admin/public/layout')
@section('title')编辑专家认证信息@endsection
@section('content')
    <section class="content-header">
        <h1>编辑专家认证信息</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.authentication.update',['id'=>$authentication->user_id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('real_name')) has-error @endif">
                                <label>真实姓名</label>
                                <input type="text" name="real_name" class="form-control " placeholder="真实姓名" value="{{ old('real_name',$authentication->real_name) }}">
                                @if($errors->has('real_name')) <p class="help-block">{{ $errors->first('real_name') }}</p> @endif
                            </div>

                            <div class="form-group ">
                                <label for="time_friendly">性别</label>
                                <div class="radio">
                                    <label><input type="radio" name="gender" value="1" @if ( $authentication->gender === 1) checked @endif >男</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="gender" value="2" @if ( $authentication->gender === 2) checked @endif >女</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="gender" value="0" @if ( $authentication->gender === 0) checked @endif >保密</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="setting-city" class="control-label">所在城市</label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <select class="form-control" name="province" id="province">
                                            <option>请选择省份</option>
                                            @foreach($data['provinces'] as $province)
                                                <option value="{{ $province->id }}"  @if($authentication->province == $province->id) selected @endif>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="city" id="city">
                                            <option>请选择城市</option>
                                            @foreach($data['cities'] as $city)
                                                <option value="{{ $city->id }}" @if($authentication->city == $city->id) selected @endif >{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <label for="name">身份职业</label>
                                <input type="text" name="title" class="form-control " placeholder="身份职业" value="{{ old('title',$authentication->title) }}">
                                @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>


                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="name">自我介绍</label>
                                <textarea name="description" class="form-control " placeholder="自我介绍">{{ old('description',$authentication->description) }}</textarea>
                                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>


                            <div class="form-group @if($errors->has('id_card')) has-error @endif">
                                <label>身份证号码</label>
                                <input type="text" name="id_card" class="form-control " placeholder="身份证号码" value="{{ old('id_card',$authentication->id_card) }}">
                                @if($errors->has('id_card')) <p class="help-block">{{ $errors->first('id_card') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>身份证正面图片</label>
                                <input type="file" name="id_card_image" />
                                @if($authentication->id_card_image)
                                <div style="margin-top: 10px;">
                                    <img class="img-responsive" width="400" src="{{ route('website.image.show',['image_name'=>$authentication->id_card_image]) }}" />
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>所属分类</label>
                                <select name="category_id" class="form-control">
                                    <option value="0">选择分类</option>
                                    @include('admin.category.option',['type'=>'experts','select_id'=>$authentication->category_id])
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('skill')) has-error @endif">
                                <label>认证领域</label>
                                <input type="text" name="skill" class="form-control " placeholder="认证领域" value="{{ old('skill',$authentication->skill) }}">
                                @if($errors->has('skill')) <p class="help-block">{{ $errors->first('skill') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>专业性证明文件</label>
                                <input type="file" name="skill_image" />
                                @if($authentication->skill_image)
                                    <div style="margin-top: 10px;">
                                        <img class="img-responsive" width="400" src="{{ route('website.image.show',['image_name'=>$authentication->skill_image]) }}" />
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="0" @if($authentication->status === 0) checked @endif /> 待审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="1" @if($authentication->status === 1) checked @endif /> 通过审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="4" @if($authentication->status === 4 ) checked @endif /> 审核失败
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>审核失败的原因</label>
                                <textarea class="form-control" name="failed_reason" placeholder="仅审核失败的情况下填写"></textarea>
                            </div>
                            <div class="form-group">
                                <label>推荐</label>
                                <span class="text-muted">(推荐后会按照推荐时间显示到首页)</span>
                                <div class="radio">
                                    @foreach( trans_common_bool('all') as $key => $name )
                                        <label><input type="radio" name="is_recommend" value="{{ $key }}" @if( $authentication->recommend_at === $key) checked @endif /> {{ $name }}</label>&nbsp;&nbsp;
                                    @endforeach
                                </div>
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
    <script type="text/javascript">
        $(function(){
            set_active_menu('manage_user',"{{ route('admin.authentication.index') }}");
            /*加载省份城市*/
            $("#province").change(function(){
                var province_id = $(this).val();
                $("#city").load("{{ url('ajax/loadCities') }}/"+province_id);
            });
        });
    </script>
@endsection