@extends('theme::layout.public')

@section('seo_title')账号绑定 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal main">
            <h2 class="h3 post-title">账号绑定</h2>
            <div class="row mt-30 form-group">
                <label class="control-label col-sm-2">已绑定账号</label>
                <div class="col-sm-8">
                    <ul class="list-inline">
                        @if(Auth()->user()->isOauthBind('weixinweb'))
                        <li class="mb-10">
                            <a class="btn btn-success">微信</a> <a href="{{ route('auth.oauth.unbind',['type'=>'weixinweb']) }}" class="bind-delete btn btn-link btn-xs"><span class="glyphicon glyphicon-minus-sign text-muted"></span></a>
                        </li>
                        @endif
                        @if(Auth()->user()->isOauthBind('weixin'))
                        <li class="mb-10">
                            <a class="btn btn-success">微信公众号</a> <a href="{{ route('auth.oauth.unbind',['type'=>'weixin']) }}" class="bind-delete btn btn-link btn-xs"><span class="glyphicon glyphicon-minus-sign text-muted"></span></a>
                        </li>
                        @endif
                        @if(Auth()->user()->isOauthBind('qq'))
                        <li class="mb-10">
                            <a class="btn btn-success">腾讯 QQ</a> <a href="{{ route('auth.oauth.unbind',['type'=>'qq']) }}" class="bind-delete btn btn-link btn-xs"><span class="glyphicon glyphicon-minus-sign text-muted"></span></a>
                        </li>
                        @endif
                        @if(Auth()->user()->isOauthBind('weibo'))
                        <li class="mb-10">
                            <a class="btn btn-success">新浪微博</a> <a href="{{ route('auth.oauth.unbind',['type'=>'weibo']) }}" class="bind-delete btn btn-link btn-xs"><span class="glyphicon glyphicon-minus-sign text-muted"></span></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row bind form-group">
                <label class="control-label col-sm-2">未绑定</label>
                <div class="col-sm-10">
                    <ul class="list-inline">
                        @if(config('services.weixinweb.open') && !Auth()->user()->isOauthBind('weixinweb'))
                        <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'weixinweb']) }}" class="btn btn-default">微信</a></li>
                        @endif
                        @if(config('services.weixin.open') && !Auth()->user()->isOauthBind('weixin'))
                        <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'weixinweb']) }}" class="btn btn-default">微信公众号登陆</a></li>
                        @endif
                        @if(config('services.qq.open') && !Auth()->user()->isOauthBind('qq'))
                        <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'qq']) }}" class="btn btn-default">腾讯QQ</a></li>
                        @endif
                        @if(config('services.weibo.open') && !Auth()->user()->isOauthBind('weibo'))
                        <li class="mb-10"><a href="{{ route('auth.oauth.login',['type'=>'weibo']) }}" class="btn btn-default">新浪微博</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
