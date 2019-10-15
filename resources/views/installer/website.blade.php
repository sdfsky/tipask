@extends('installer.layout')
@section('title')初始化配置@endsection
@section('content')
    @if ( session('message') )
        <div class="alert mt-10 @if(session('message_type')===1) alert-danger @else alert-success @endif" role="alert" id="alert_message">
            {{ session('message') }}
        </div>
    @endif
    <form role="form" method="POST" id="configForm" action="{{ route('website.installer.website') }}">
        {{ csrf_field() }}
        <h4 class="box-title">创建您的管理员帐号</h4>
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="website_name  @if($errors->has('website_name')) has-error @endif">网站名称</label>
                    <input type="text" class="form-control" name="website_name" id="website_name" value="{{ old('website_name','Tipask问答网') }}">
                    @if($errors->has('website_name')) <p class="help-block">{{ $errors->first('website_name') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('website_url')) has-error @endif">
                    <label for="website_url">网站地址</label>
                    <input type="text" class="form-control" name="website_url" id="website_url" value="{{ old('website_url','localhost') }}">
                    @if($errors->has('website_url')) <p class="help-block">{{ $errors->first('website_url') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('website_admin_name')) has-error @endif">
                    <label for="website_admin_name">管理员用户名</label>
                    <input type="text" class="form-control" name="website_admin_name" id="website_admin_name" value="{{ old('website_admin_name','admin') }}">
                    @if($errors->has('website_admin_name')) <p class="help-block">{{ $errors->first('website_admin_name') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('website_admin_email')) has-error @endif">
                    <label for="website_admin_email">管理员邮箱</label>
                    <input type="text" class="form-control" name="website_admin_email" id="website_admin_email" value="{{ old('website_admin_email','') }}">
                    @if($errors->has('website_admin_email')) <p class="help-block">{{ $errors->first('website_admin_email') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('website_admin_pass')) has-error @endif">
                    <label for="website_admin_pass">登录密码</label>
                    <input type="text" class="form-control" name="website_admin_pass" id="website_admin_pass" value="{{ old('website_admin_pass','') }}">
                    @if($errors->has('website_admin_pass')) <p class="help-block">{{ $errors->first('website_admin_pass') }}</p> @endif
                </div>
            </div>
        </div>

        <div class="box-footer text-center mt-10 mb-10">
            <button type="button" class="btn btn-primary btn-lg" id="setup">下一步</button>
            <a class="btn btn-default btn-lg" href="{{ route('website.installer.config') }}">上一步</a>
        </div>
    </form>

    <div class="modal fade" id="setup_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center">
                        <i class="fa fa-spinner fa-spin fa-fw"></i>
                        <span>导入默认配置...</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $("#setup").click(function(){
            $("#setup_modal").modal('show');
            $("#configForm").submit();
        });
    </script>
@endsection