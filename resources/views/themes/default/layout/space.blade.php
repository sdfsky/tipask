@extends('theme::layout.public')
@section('css')
    <link href="{{ asset('/css/default/space.css')}}" rel="stylesheet">
@endsection

@section('space_header')
    <header class="bg-gray pt-30">
        <div class="container mt-50">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-header media">
                        <a class="pull-left" href="{{ route('auth.space.index',['user_id'=>$userInfo->id])}}"><img  class="media-object avatar-128" src="{{ route('website.image.avatar',['avatar_name'=>$userInfo->id.'_big'])}}" alt="不写代码的码农"></a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $userInfo->name }}</h4>
                            <ul class="sn-inline">
                                <li>{{ $userInfo->title }}</li>
                                <li>测试提问</li>
                                <li>hello</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <ul class="list-unstyled profile-links">
                        <li>所在城市：广州市</li>

                        <li>现任职位：<a href="/t/%E5%A4%A9%E6%9C%9D">天朝</a> 前端打杂工</li>

                        <li>院校专业：蓝翔 挖掘机炒菜</li>

                        <li>个人网站：<a href="http://www.ido321.com" target="_blank">http://www.ido321.com</a></li>
                    </ul>
                </div>
                <div class="text-right col-md-3">
                    <p class="mt30">
                        <strong><a class="funsCount" href="/u/dwqs/followed/users">23</a></strong> 个粉丝
                        <button type="button" class="btn btn-success ml10 userfollow" data-id="1030000000691249" data-refresh="true" data-callback="true">加关注</button>
                    </p>
                    <p>
                        <a href="/u/pandacoder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="PandaCoder"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/182/764/1827641216-55025285f24d9_small"></a>
                        <a href="/u/lidongtong" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="李栋同學"><img class="avatar-24" src="//static.segmentfault.com/global/img/user-32.png"></a>
                    </p>
                </div>
            </div>
        </div>
    </header>

@endsection


@section('content')
    <div class="row">
        <div class="col-md-4 profile">
            <ul class="list-unstyled profile-ranks">
                <li>
                        <strong>{{ $userInfo->userData->credits }}</strong>
                        <span class="text-muted">经验</span>
                </li>
                <li>
                    <strong>{{ $userInfo->userData->coins }}</strong>
                    <span class="text-muted">金币</span>
                </li>
                <li class="">
                    <strong>114</strong>
                    <span class="text-muted">次被赞</span>
                </li>
            </ul>

            <div class="rep-rects">
                <p>
                    <strong>简介:</strong>
                    {{ str_limit($userInfo->description,250) }}
                </p>
            </div>

            <div class="profile-goodjob" id="goodJob" data-id="1030000000691249">
                <strong>擅长标签</strong>
                <div class="joindate">
                    注册于 {{ $userInfo->created_at }}
                    <a href="#911" data-id="1030000000691249" data-toggle="modal" data-target="#911" data-type="user" data-typetext="用户" class="pull-right">举报</a>
                </div>
            </div>
        </div>

        <!-- Nav tabs -->
        <div class="col-md-8">
            <ul class="nav nav-pills">
                <li @if(request()->route()->getName() == 'auth.space.index') class="active" @endif ><a href="{{ route('auth.space.index',['user_id'=>$userInfo->id]) }}">动态</a></li>
                <li @if(request()->route()->getName() == 'auth.space.answers') class="active" @endif ><a href="{{ route('auth.space.answers',['user_id'=>$userInfo->id]) }}">回答</a></li>
                <li @if(request()->route()->getName() == 'auth.space.questions') class="active" @endif ><a href="{{ route('auth.space.questions',['user_id'=>$userInfo->id]) }}">提问</a></li>
                @if($userInfo->id == Auth()->user()->id)
                <li @if(request()->route()->getName() == 'auth.space.coins') class="active" @endif ><a href="{{ route('auth.space.coins',['user_id'=>$userInfo->id]) }}">金币</a></li>
                <li @if(request()->route()->getName() == 'auth.space.credits') class="active" @endif ><a href="{{ route('auth.space.credits',['user_id'=>$userInfo->id]) }}">经验</a></li>
                @endif

            </ul>
            @yield('space_content')

        </div>
    </div>
@endsection