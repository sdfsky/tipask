@extends('theme::layout.public')

@section('seo_title')专家 @if($experts->currentPage()>1))- 第{{ $experts->currentPage() }}页 @endif - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-streams users">
                <div class="search-expert mt-20">
                    <div class="row">
                        <div class="company-func-detail">
                            <form name="searchForm" action="{{ route('website.experts') }}" method="GET">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input name="word" class="form-control" type="text" value="{{ $word }}" placeholder="搜索关键字">
                                    </div>
                                </div>
                                <div class="col-md-2 search-btn-warp">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary search-btn">搜索专家</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 expert-search-opt">
                            <div class="expert-search-opt-item"><span class="expert-search-opt-label">分类：</span>
                                <div class="expert-search-opt-detail expert-search-opt-label-detail">
                                    <a href="{{ route('website.experts',['categorySlug'=>'all']) }}">不限</a>
                                    @foreach( $categories as $category )
                                        - <a href="{{ route('website.experts',['categorySlug'=>$category->slug]) }}" @if($category->slug == $categorySlug) class="active" @endif>{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="expert-search-opt-item mt-10"><span class="expert-search-opt-label">城市：</span>
                                <div class="expert-search-opt-detail">
                                    <a  href="{{ route('website.experts',['categorySlug'=>$categorySlug,'provinceId'=>'all']) }}">不限</a>
                                    @foreach( $hotProvinces as $hotProvince)
                                        @if($hotProvince->province > 0)
                                            - <a href="{{ route('website.experts',['categorySlug'=>$categorySlug,'provinceId'=>$hotProvince->province]) }}" @if($hotProvince->province == $provinceId) class="active" @endif>{{ Area()->getName($hotProvince->province) }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="h4  mt-30">专家列表<a href="{{ route('auth.authentication.index') }}" class="pull-right text-danger" target="_blank">申请成为专家 <i class="fa fa-external-link-square text-green" aria-hidden="true"></i></a></h2>
                <div class="widget-streams border-top">
                @foreach($experts as $expert)
                    <section class="hover-show streams-item">
                        <div class="stream-wrap media">
                            <div class="col-md-9">
                                <div class="pull-left mr-10">
                                    <a href="{{ route('auth.space.index',['id'=>$expert->user_id]) }}" target="_blank">
                                        <img class="media-object avatar-64" src="{{ get_user_avatar($expert->user_id,'middle') }}" alt="{{ $expert->real_name }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{ route('auth.space.index',['id'=>$expert->user_id]) }}">{{ $expert->real_name }}</a>
                                        @if($expert->authentication_status==1)<span class="text-gold"><i class="fa fa-graduation-cap" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="已通过行家认证"></i></span> @endif
                                    </h4>
                                    <p class="text-muted">{{ $expert->title }}</p>
                                    <p class="text-muted">{{ $expert->answers }}回答 / {{ $expert->answers }}赞同 / {{ $expert->followers }}关注 </p>
                                    <ul class="taglist-inline ib">
                                        <li class="tagPopup text-muted">认证领域：</li>
                                        @if($expert->hotTags())
                                            @foreach( $expert->hotTags() as $tag)
                                                <li class="tagPopup"><a class="tag" data-toggle="popover"  href="{{ route('ask.tag.index',['id'=>$tag->id,'source_type'=>'questions']) }}">{{ $tag->name }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <p class="text-muted mt-10">简介：{{ str_limit($expert->description,200) }} </p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <ul class="action-list list-unstyled mt-20">
                                    <li>
                                        @if(Auth()->guest())
                                            <a href="{{ route('ask.question.create') }}?to_user_id={{ $expert->user_id }}" class="btn btn-warning btn-sm">向TA求助</a>
                                        @elseif(Auth()->user()->id != $expert->user_id)
                                            <a href="{{ route('ask.question.create') }}?to_user_id={{ $expert->user_id }}" class="btn btn-warning btn-sm">向TA求助</a>
                                        @endif

                                    </li>
                                </ul>
                            </div>

                        </div>
                    </section>
                @endforeach
                </div>
            </div>
            <div class="text-center">
            </div>
        </div>
        @include('theme::layout.top_user_menu')

    </div>
@endsection