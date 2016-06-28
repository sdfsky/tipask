@extends('theme::layout.public')

@section('seo')
    <title>账号绑定 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal">
            <h2 class="h3 post-title">账号绑定</h2>
            <div class="row mt-30 form-group">
                <label class="control-label col-sm-2">已绑定账号</label>
                <div class="col-sm-8">
                    <ul class="list-inline">
                        @if( Auth()->user()->userOauth )
                            @if(Auth()->user()->userOauth->isBind('qq'))
                            <li class="mb-10">
                                <a class="btn btn-success">腾讯 QQ</a> <a href="{{ route('auth.oauth.unbind',['type'=>'qq']) }}" class="bind-delete btn btn-link btn-xs"><span class="glyphicon glyphicon-minus-sign text-muted"></span></a>
                            </li>
                            @endif
                       @endif
                    </ul>
                </div>
            </div>
            <div class="row bind form-group">
                <label class="control-label col-sm-2">未绑定</label>
                <div class="col-sm-10">
                    <ul class="list-inline">

                        @if( Auth()->user()->userOauth )

                            @if(!Auth()->user()->userOauth->isBind('qq'))
                            <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'qq']) }}" class="btn btn-default">腾讯QQ</a></li>
                            @endif
                        @else
                            <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'qq']) }}" class="btn btn-default">腾讯QQ</a></li>
                            <li class="mb-10"><a href="/user/oauth/twitter" class="btn btn-default">新浪微博</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
