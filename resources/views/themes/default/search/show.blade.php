@extends('theme::layout.public')

@section('seo_title')搜索 - {{ Setting()->get('website_name') }}@endsection

@section('content')
        <div class="container mt-20">
            <div class="row">
                <div class="container">
                    <ul class="search-category nav nav-pills">
                        @if(Setting()->get("xunsearch_open",0))
                        <li @if($filter==='all') class="active" @endif ><a href="{{ route('auth.search.index') }}?filter={{$filter}}&word={{ $word }}">全部</a></li>
                        @endif
                        <li @if($filter==='questions') class="active" @endif ><a href="{{ route('auth.search.index') }}?filter={{$filter}}&word={{ $word }}">问答</a></li>
                        <li @if($filter==='articles') class="active" @endif><a href="{{ route('auth.search.index') }}?filter={{$filter}}&word={{ $word }}">文章</a></li>
                        <li @if($filter==='tags') class="active" @endif><a href="{{ route('auth.search.index') }}?filter={{$filter}}&word={{ $word }}">标签</a></li>
                        <li @if($filter==='users') class="active" @endif><a href="{{ route('auth.search.index') }}?filter={{$filter}}&word={{ $word }}">用户</a></li>
                    </ul>
                    <form action="{{ route('auth.search.index',['filter'=>$filter]) }}" class="row" method="GET">
                        <div class="col-md-9">
                            <input class="input-lg form-control" type="text" name="word" value="{{ $word }}" placeholder="输入关键字搜索" />
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block search-btn">搜索</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 main search-result">
                </div>
                <div class="col-md-3 side">
                    <ul class="list-unstyled">
                    </ul>
                </div>
            </div>
        </div>
@endsection
