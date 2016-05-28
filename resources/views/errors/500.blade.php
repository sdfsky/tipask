@extends('errors/layout')

@section('title') 500 Internal Server Error @endsection

@section('content')

    <h1><i class="glyphicon glyphicon-fire red"></i> 500 Internal Server Error</h1>
    <p class="lead">服务器内部错误！刷新页面如果依然存在该问题请联系管理员,{{ Setting()->get('website_admin_email') }}</p>
    <p>
        <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">再次访问该页面</span></a>
    </p>

@endsection

