@extends('errors/layout')

@section('title') 404 Not Found @endsection


@section('content')

    <h1><i class="fa fa-frown-o red"></i> 404 Not Found</h1>
    <p class="lead">来源链接是否正确？用户、话题、问题或文字是否存在？</p>
    <p>
        <a class="btn btn-default btn-lg" href="{{ route('website.index') }}"><span class="green">返回首页</span></a>
    </p>

@endsection

