@extends('errors/layout')

@section('title') 403 Forbidden @endsection

@section('content')

    <h1><i class="fa fa-ban red"></i> 403 Forbidden</h1>
    <p class="lead">抱歉！您可能被禁止访问该页面，如有问题请联系管理员。</p>
    <p>
        <a class="btn btn-default btn-lg" href="{{ route('website.index') }}"><span class="green">返回首页</span></a>
    </p>

@endsection

