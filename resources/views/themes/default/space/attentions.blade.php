@extends('theme::layout.space')

@section('seo_title')@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else{{ $userInfo->name }} @endif 关注的@if($source_type==='questions')问题@elseif($source_type==='users')用户 @else 标签 @endif @endsection

@section('space_content')
    <div class="stream-following">
        <ul class="nav nav-tabs mt-20">
            <li @if($source_type==='questions') class="active" @endif ><a href="{{ route('auth.space.attentions',['user_id'=>$userInfo->id,'source_type'=>'questions']) }}">关注的问题</a></li>
            <li @if($source_type==='tags') class="active" @endif ><a href="{{ route('auth.space.attentions',['user_id'=>$userInfo->id,'source_type'=>'tags']) }}">关注的标签</a></li>
            <li @if($source_type==='users') class="active" @endif ><a href="{{ route('auth.space.attentions',['user_id'=>$userInfo->id,'source_type'=>'users']) }}">关注的人</a></li>
        </ul>
        <ul class="list-unstyled stream-following-list">

            @foreach($attentions as $attention)
                @if($source_type==='questions')
                    <li>
                        <div class="row">
                            <div class="col-md-10">
                                <a target="_blank" class="stream-following-title" href="{{ route('ask.question.detail',['id'=>$attention->source_id]) }}">{{ $attention['info']->title }}</a>
                            </div>
                            <div class="col-md-2 text-right">
                                <span class="stream-following-followed mr-10">{{ $attention['info']->followers }} 关注</span>
                                @if(Auth()->check() && Auth()->user()->isFollowed($attention->source_type,$attention->source_id))
                                    <button type="button" class="btn btn-default btn-xs followerUser active" data-source_type = "question" data-source_id = "{{ $attention->source_id }}"  data-show_num="false"  data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">取消关注</button>
                                @else
                                    <button type="button" class="btn btn-default followerUser btn-xs" data-source_type = "question" data-source_id = "{{ $attention->source_id }}"  data-show_num="false" data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">关注</button>
                                @endif
                            </div>
                        </div>
                    </li>
                @elseif($source_type==='users')
                    <li>
                        <div class="row">
                            <div class="col-md-10">
                                <img class="avatar-32" src="{{ get_user_avatar($attention->source_id) }}" />
                                <div>
                                    <a target="_blank" href="{{ route('auth.space.index',['user_id'=>$attention->source_id]) }}">{{ $attention['info']->name }}</a> @if($attention['info']->title) <span class="text-muted ml-5">- {{ $attention['info']->title  }}</span> @endif
                                    <div class="stream-following-followed">{{ $attention['info']->userData->supports }}赞同 / {{ $attention['info']->userData->followers }}关注 / {{ $attention['info']->userData->answers }}回答</div>
                                </div>
                            </div>
                            <div class="col-md-2 text-right">
                                @if(Auth()->check() && Auth()->user()->isFollowed($attention->source_type,$attention->source_id))
                                    <button type="button" class="btn btn-default btn-xs followerUser active" data-source_type = "user" data-source_id = "{{ $attention->source_id }}"  data-show_num="false"  data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">取消关注</button>
                                @else
                                    <button type="button" class="btn btn-default followerUser btn-xs" data-source_type = "user" data-source_id = "{{ $attention->source_id }}"  data-show_num="false" data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">关注</button>
                                @endif
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="row">
                            <div class="col-md-10">
                                <a class="tag" target="_blank" href="{{ route('ask.tag.index',['id'=>$attention->source_id,'source_type'=>'questions']) }}" title="{{ $attention['info']->name }}">{{  $attention['info']->name }}</a>
                                <div class="stream-following-desc">{{ $attention['info']->summary }}</div>
                            </div>
                            <div class="col-md-2 text-right">
                                <span class="stream-following-followed mr-10">{{ $attention['info']->followers }} 关注</span>
                                @if(Auth()->check() && Auth()->user()->isFollowed($attention->source_type,$attention->source_id))
                                    <button type="button" class="btn btn-default btn-xs followerUser active" data-source_type = "tag" data-source_id = "{{ $attention->source_id }}"  data-show_num="false"  data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">取消关注</button>
                                @else
                                    <button type="button" class="btn btn-default followerUser btn-xs" data-source_type = "tag" data-source_id = "{{ $attention->source_id }}"  data-show_num="false" data-toggle="tooltip" data-placement="left" title="" data-original-title="关注后将获得更新提醒">关注</button>
                                @endif
                            </div>
                        </div>
                    </li>
                @endif


            @endforeach
        </ul>
        <div class="text-center">
            {!! str_replace('/?', '?', $attentions->render()) !!}
        </div>
    </div>

@endsection


