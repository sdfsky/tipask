@extends('errors/layout')

@section('title') 错误提示  @endsection

@section('content')

    <h1><i class="fa fa-exclamation-triangle orange"></i> 抱歉，出错了！</h1>
    <p class="lead">{{ $message }}</p>
    <p>
        <a class="btn btn-default btn-lg" href="{{ route('website.index') }}"><span class="green">访问首页</span></a>
        <a class="btn btn-default btn-lg" href="{{ $url }}"><span class="green">返回上一级</span></a>
    </p>

@endsection

