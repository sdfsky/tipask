@extends('theme::layout.public')

@section('seo_title')财富榜 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">财富榜</h2>
            <div class="widget-streams users">
                @foreach($users as $index=>$user)
                <section class="hover-show streams-item border-top">
                    <div class="stream-wrap media">

                        <div class="col-md-9">
                            <div class="top-num pull-left mr-10">
                                @if($index < 3)
                                <label class="label label-warning">{{ ($index+1) }}</label>
                                @else
                                <label class="label label-default">{{ ($index+1) }}</label>
                                @endif
                            </div>
                            <div class="pull-left mr-10">
                                <a href="{{ route('auth.space.index',['id'=>$user['id']]) }}" target="_blank">
                                    <img class="media-object avatar-64" src="{{ get_user_avatar($user['id'],'big') }}" alt="{{ $user['name'] }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ route('auth.space.index',['id'=>$user['id']]) }}">{{ $user['name'] }}</a>
                                    @if($user['authentication_status']===1)<span class="text-gold"><i class="fa fa-graduation-cap" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="已通过行家认证"></i></span> @endif
                                </h4>
                                <p class="text-muted">{{ $user['title'] }}</p>
                                <p class="text-muted">{{ $user['coins'] }}金币 / {{ $user['supports'] }}赞同 / {{ $user['followers'] }}关注</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <ul class="action-list list-unstyled mt-20">
                                <li>
                                    @if(Auth()->guest())
                                        <a href="{{ route('ask.question.create') }}?to_user_id={{ $user['id'] }}" class="btn btn-warning btn-sm">向TA求助</a>
                                    @elseif(Auth()->user()->id !== $user['id'])
                                        <a href="{{ route('ask.question.create') }}?to_user_id={{ $user['id'] }}" class="btn btn-warning btn-sm">向TA求助</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                @endforeach
            </div>
            <div class="text-center">
            </div>
        </div>
        @include('theme::layout.top_user_menu')

    </div>
@endsection