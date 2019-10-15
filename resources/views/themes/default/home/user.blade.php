@extends('theme::layout.public')

@section('seo_title')活跃用户@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 widget-user-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">社区活跃成员</h4>
                </div>
                <div class="panel-body">
                    <ul class="user-list">
                        @foreach($hotUsers as $hotUser)
                        <li>
                            <a href="{{ route('auth.space.index',['id'=>$hotUser->user_id]) }}" target="_blank" title="{{ $hotUser->user->name }}"><img class="avatar-50" src="{{ get_user_avatar($hotUser->user_id,'big') }}" alt="{{ $hotUser->user->name }}"></a>
                            <span class="username"><a href="{{ route('auth.space.index',['id'=>$hotUser->user_id]) }}" title="{{$hotUser->user->name}}">{{ str_limit($hotUser->user->name,6,'')}}</a></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">最新加入成员</h4>
                </div>
                <div class="panel-body">

                    <ul class="user-list">
                        @foreach($newUsers as $newUser)
                            <li>
                                <a href="{{ route('auth.space.index',['id'=>$newUser->id]) }}" target="_blank" title="{{ $newUser->name }}"><img class="avatar-50" src="{{ get_user_avatar($newUser->id,'big') }}" alt="{{ $newUser->name }}"></a>
                                <span class="username"><a href="{{ route('auth.space.index',['id'=>$newUser->id]) }}" title="{{$newUser->name}}">{{ str_limit($newUser->name,6,'')}}</a></span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @include('theme::layout.top_user_menu')
    </div>
@endsection