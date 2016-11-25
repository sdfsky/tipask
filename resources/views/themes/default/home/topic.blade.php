@extends('theme::layout.public')

@section('seo_title')话题 - 第{{ $topics->currentPage() }}页 - {{ Setting()->get('website_name') }}@endsection

@section('css')
    <link href="{{ asset('/css/default/topic.css')}}" rel="stylesheet" />
@endsection

@section('content')
        @if( $categories )
            <div class="row widget-category">
                <div class="col-sm-12">
                    <ul class="list">
                        @foreach( $categories as $category )
                            <li @if( $category->id == $currentCategoryId ) class="active" @endif ><a href="{{ route('website.ask',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="row tag-list mt-20">
            @foreach($topics as $topic)
            <section class="topic-list-item col-md-3">
                <div class="widget-topic">
                    <h2 class="h4">
                        <a href="{{ route('ask.tag.index',['name'=>$topic->name]) }}" @if($topic->logo) class="tag-logo" style="background-image: url({{ route('website.image.show',['image_name'=>$topic->logo]) }});" @endif>{{ $topic->name }}</a>
                    </h2>
                    <p>
                        @if($topic->description)
                            {{ str_limit($topic->summary,200) }}
                        @else
                            暂无介绍
                        @endif
                    </p>
                    <div class="widget-topic-action">
                        @if(Auth()->check() && Auth()->user()->isFollowed(get_class($topic),$topic->id))
                            <button type="button"  class="btn btn-default btn-xs active followTopic mr-5" data-source_type = "tag" data-source_id = "{{ $topic->id }}"  data-show_num="false"  data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">已关注</button>
                        @else
                            <button type="button"  class="btn btn-default btn-xs followTopic mr-5" data-source_type = "tag" data-source_id = "{{ $topic->id }}"  data-show_num="false" data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">关注</button>
                        @endif
                        <strong class="follows">{{ $topic->followers }}</strong> <span class="text-muted">关注</span>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
        <div class="text-center">
            {!! str_replace('/?', '?', $topics->render()) !!}
        </div>
@endsection