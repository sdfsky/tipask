@extends('installer.layout')
@section('title')初始化配置@endsection
@section('content')
    @if ( session('message') )
        <div class="alert mt-10 @if(session('message_type')===1) alert-danger @else alert-success @endif" role="alert" id="alert_message">
            {{ session('message') }}
        </div>
    @endif

    <form role="form" method="POST" id="configForm" action="{{ route('website.installer.config') }}">
        {{ csrf_field() }}
        <h3 class="box-title">初始化配置</h3>
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">数据库类型</label>
                    <select name="database_driver" class="form-control">
                        <option value="mysql">Mysql数据库</option>
                    </select>
                </div>
                <div class="form-group @if($errors->has('database_host')) has-error @endif">
                    <label for="database_host">数据库地址</label>
                    <input type="text" class="form-control" name="database_host" id="database_host" value="{{ old('database_host','localhost') }}">
                    @if($errors->has('database_host')) <p class="help-block">{{ $errors->first('database_host') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('database_port')) has-error @endif">
                    <label for="database_port">数据库端口</label>
                    <input type="text" class="form-control" name="database_port" id="database_port" value="{{ old('database_port','3306') }}">
                    @if($errors->has('database_port')) <p class="help-block">{{ $errors->first('database_port') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('database_username')) has-error @endif">
                    <label for="database_name">数据库用户名</label>
                    <input type="text" class="form-control" name="database_username" id="database_username" value="{{ old('database_username','root') }}">
                    @if($errors->has('database_username')) <p class="help-block">{{ $errors->first('database_username') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('database_password')) has-error @endif">
                    <label for="database_password">数据库密码</label>
                    <input type="text" class="form-control" name="database_password" id="database_password" value="{{ old('database_password','') }}">
                    @if($errors->has('database_password')) <p class="help-block">{{ $errors->first('database_password') }}</p> @endif

                </div>
                <div class="form-group @if($errors->has('database_name')) has-error @endif">
                    <label for="database_name">数据库名</label>
                    <input type="text" class="form-control" name="database_name" id="database_name" value="{{ old('database_name','tipaskx') }}">
                    @if($errors->has('database_name')) <p class="help-block">{{ $errors->first('database_name') }}</p> @endif
                </div>
                <div class="form-group @if($errors->has('database_prefix')) has-error @endif">
                    <label for="database_prefix">数据库前缀</label>
                    <input type="text" class="form-control" name="database_prefix" value="{{ old('database_prefix','ask_') }}">
                    @if($errors->has('database_prefix')) <p class="help-block">{{ $errors->first('database_prefix') }}</p> @endif
                </div>
            </div>
        </div>
        <div class="box-footer text-center mt-10 mb-10">
            <button type="button" class="btn btn-primary btn-lg" id="setup">下一步</button>
            <a class="btn btn-default btn-lg" href="{{ route('website.installer.requirement') }}">上一步</a>
        </div>
    </form>

    <div class="modal fade" id="setup_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center">
                        <i class="fa fa-spinner fa-spin fa-fw"></i>
                        <span>正在安装...</span>
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