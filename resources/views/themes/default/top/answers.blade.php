@extends('theme::layout.public')

@section('seo_title')回答榜 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">回答榜</h2>
            <div class="widget-streams users border-top">
                @foreach($users as $index=>$user)
                <section class="hover-show streams-item">
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
                                <p class="text-muted">{{ $user['answers'] }}回答 / {{ $user['supports'] }}赞同 / {{ $user['followers'] }}关注 </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <ul class="action-list list-unstyled">
                                <li>
                                    @if(Auth()->guest())
                                        <button type="button" class="btn btn-success followerUser btn-sm" data-source_type = "user" data-source_id = "{{ $user['id'] }}"  data-show_num="false" data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">加关注</button>
                                    @elseif(Auth()->user()->id !== $user['id'])
                                        @if(Auth()->user()->isFollowed(get_class($user->user),$user['id']))
                                            <button type="button" class="btn btn-success btn-sm followerUser active" data-source_type = "user" data-source_id = "{{ $user['id'] }}"  data-show_num="false"  data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">已关注</button>
                                        @else
                                            <button type="button" class="btn btn-success followerUser btn-sm" data-source_type = "user" data-source_id = "{{ $user['id'] }}"  data-show_num="false" data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">加关注</button>
                                        @endif
                                    @endif
                                </li>
                                <li>
                                    @if(Auth()->guest())
                                        <a href="{{ route('ask.question.create') }}?to_user_id={{ $user['id'] }}" class="btn btn-default btn-sm">向TA求助</a>
                                    @elseif(Auth()->user()->id !== $user['id'])
                                        <a href="{{ route('ask.question.create') }}?to_user_id={{ $user['id'] }}" class="btn btn-default btn-sm">向TA求助</a>
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