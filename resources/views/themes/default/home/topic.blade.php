@extends('theme::layout.public')
@section('seo_title')话题 @if($topics->currentPage()>1)- 第{{ $topics->currentPage() }}页 @endif - {{ Setting()->get('website_name') }}@endsection
@section('content')
    <p class="mt-10">话题不仅能组织和归类你的内容，还能关联相似的内容。正确的使用话题将让你的问题被更多人发现和解决。</p>
    @if( $categories )
            <div class="widget-category clearfix">
                <div class="col-sm-12">
                    <ul class="list">
                        <li><a href="{{ route('website.topic') }}">全部</a></li>
                        @foreach( $categories as $category )
                            <li @if( $category->id == $currentCategoryId ) class="active" @endif ><a href="{{ route('website.topic',['category_slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
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
                        <a href="{{ route('ask.tag.index',['id'=>$topic->id]) }}" @if($topic->logo) class="tag-logo" style="background-image: url({{ route('website.image.show',['image_name'=>$topic->logo]) }});" @endif>{{ $topic->name }}</a>
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