@extends('errors/layout')

@section('title') 502 Bad Gateway @endsection

@section('content')

    <h1><i class="fa fa-bolt orange"></i> 502 Bad Gateway</h1>
    <p class="lead">{{ Setting()->get('website_url') }}的服务器返回一个意外的网络错误！请重新刷新页面！</p>
    <p>
        <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">再次访问该页面</span></a>
    </p>

@endsection

