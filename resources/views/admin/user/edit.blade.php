@extends('admin/public/layout')

@section('css')
    <link href="{{ asset('/static/js/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" />
@endsection

@section('title')
    编辑用户
@endsection

@section('content')
    <section class="content-header">
        <h1>
            编辑用户
            <small>编辑用户信息</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">基本资料</h3>
                    </div>
                    <form role="form" name="userForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.user.update',['id'=>$user->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                          <div class="form-group @if ($errors->has('name')) has-error @endif">
                              <label for="name">用户名</label>
                              <input type="text" name="name" class="form-control " placeholder="登陆用户名" value="{{ old('name',$user->name) }}">
                              @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                          </div>

                            <div class="form-group">
                                <label>头像</label>
                                <input type="file" name="avatar" />
                                <div style="margin-top: 10px;">
                                    <img src="{{ get_user_avatar($user->id,'big') }}" width="100"/>
                                </div>
                            </div>

                          <div class="form-group @if ($errors->has('email')) has-error @endif">
                              <label for="name">邮箱</label>
                              <input type="text" name="email" class="form-control " placeholder="邮箱地址" value="{{ old('email',$user->email) }}">
                              @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                          </div>

                          <div class="form-group @if ($errors->has('password')) has-error @endif">
                              <label for="name">密码</label>
                              <input type="text" name="password" class="form-control " placeholder="密码" value="" />
                              @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                          </div>

                          <div class="form-group">
                              <label for="name">角色</label>
                              <select class="form-control" name="role_id">
                                    @foreach( $roles as $role )
                                        <option value="{{ $role->id }}" @if($user->getRoles()->contains($role->id)) selected @endif> {{ $role->name }}</option>
                                    @endforeach
                              </select>
                          </div>



                            <div class="form-group ">
                                <label for="time_friendly">性别</label>
                                <div class="radio">
                                    <label><input type="radio" name="gender" value="1" @if ( $user->gender === 1) checked @endif >男</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="gender" value="2" @if ( $user->gender === 2) checked @endif >女</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="gender" value="0" @if ( $user->gender === 0) checked @endif >保密</label>
                                </div>
                            </div>

                          <div class="form-group @if ($errors->has('birthday')) has-error @endif">
                            <label for="name">出生日期</label>
                            <input type="text" name="birthday" class="form-control datepicker" placeholder="出生日期" value="{{ old('birthday',$user->birthday) }}" />
                            @if ($errors->has('birthday')) <p class="help-block">{{ $errors->first('birthday') }}</p> @endif
                          </div>

                            <div class="form-group">
                                <label for="setting-city" class="control-label">所在城市</label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <select class="form-control" name="province" id="province">
                                            <option>请选择省份</option>
                                            @foreach($data['provinces'] as $province)
                                                <option value="{{ $province->id }}"  @if($user->province == $province->id) selected @endif>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="city" id="city">
                                            <option>请选择城市</option>
                                            @foreach($data['cities'] as $city)
                                                <option value="{{ $city->id }}" @if($user->city == $city->id) selected @endif >{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <label for="name">身份职业</label>
                                <input type="text" name="title" class="form-control " placeholder="身份职业" value="{{ old('title',$user->title) }}">
                                @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>


                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="name">自我介绍</label>
                                <textarea name="description" class="form-control " placeholder="自我介绍">{{ old('description',$user->description) }}</textarea>
                                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后用户将不能访问网站)</span>
                                <div class="radio">
                                    @foreach(trans_common_status('all') as $key => $status)
                                        <label>
                                            <input type="radio" name="status" value="{{ $key }}" @if($user->status === $key) checked @endif /> {{ $status }}
                                        </label>&nbsp;&nbsp;
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
    <script src="{{ asset('/static/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/static/js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            /*生日日历*/
            $(".datepicker").datepicker({
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

            set_active_menu('manage_user',"{{ route('admin.user.index') }}");
        });
    </script>
@endsection