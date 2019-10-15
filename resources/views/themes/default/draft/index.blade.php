@extends('theme::layout.public')

@section('seo_title')最新动态 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4 mt0 mb20">
                我的草稿
                <a href="{{ route('auth.draft.cleanAll') }}">
                    <button type="button" class="btn btn-default btn-xs ml10" id="delete-drafts" data-do="deleteAll"
                            data-type="draft">舍弃全部草稿
                    </button>
                </a>
            </h2>
            <div class="stream-list drafts-stream border-top">
                @foreach($drafts as $draft)
                    @if($draft['source_type'] == 'answer')
                        <section class="stream-list-item">
                            <h2 class="small-title">
                                <span class="label label-success pull-left mr-5">回答</span>
                                <a href="{{ route('ask.question.detail',['id'=>$draft['source_id'],'draftId'=>$draft['id']]) }}">{{ $draft['subject'] }}</a>
                            </h2>
                            <p class="mb0">
                                <span class="text-muted">保存于{{ timestamp_format($draft['created_at']) }} ·</span>
                                <a href="{{ route('ask.question.detail',['id'=>$draft['source_id'],'draftId'=>$draft['id']]) }}">编辑</a>
                                <a href="{{ route('auth.draft.destroy',['id'=>$draft['id']]) }}"
                                   class="pull-right delete text-muted" data-id="1220000015703819"
                                   data-title="{{ $draft['subject'] }}">舍弃</a>
                            </p>
                        </section>
                    @elseif($draft['source_type'] == 'question')
                        <section class="stream-list-item">
                            <h2 class="small-title">
                                <span class="label label-warning pull-left mr-5">问题</span>
                                <a href="@if($draft['source_id'] == 0) {{ route('ask.question.create',['draftId'=>$draft['id']]) }} @else {{ route('ask.question.edit',['id'=>$draft['source_id'],'draftId'=>$draft['id']]) }} @endif">编辑{{ $draft['subject'] }}</a>
                            </h2>
                            <p class="mb0">
                                <span class="text-muted">保存于{{ timestamp_format($draft['created_at']) }} ·</span>
                                @if($draft['source_id'] == 0)
                                    <a href="{{ route('ask.question.create',['draftId'=>$draft['id']]) }}">编辑</a>
                                @else
                                    <a href="{{ route('ask.question.edit',['id'=>$draft['source_id'],'draftId'=>$draft['id']]) }}">编辑</a>
                                @endif
                                <a href="{{ route('auth.draft.destroy',['id'=>$draft['id']]) }}"
                                   class="pull-right delete text-muted" data-id="1220000015703796"
                                   data-title="{{ $draft['subject'] }}">舍弃</a>
                            </p>
                        </section>
                    @elseif($draft['source_type'] == 'article')

                        <section class="stream-list-item">
                            <h2 class="small-title">
                                <span class="label label-success pull-left mr-5">文章</span>
                                <a href="@if($draft['source_id'] == 0) {{ route('blog.article.create',['draftId'=>$draft['id']]) }} @else {{ route('ask.article.edit',['id'=>$draft['source_id'],'draftId'=>$draft['id']]) }} @endif">{{ $draft['subject'] }}</a>
                            </h2>
                            <p class="mb0">
                                <span class="text-muted">保存于{{ timestamp_format($draft['created_at']) }} ·</span>
                                <a href="{{ route('blog.article.create',['draftId'=>$draft['id']]) }}">编辑</a>
                                <a href="{{ route('auth.draft.destroy',['id'=>$draft['id']]) }}"
                                   class="pull-right delete text-muted" data-id="1220000010033740"
                                   data-title="{{ $draft['subject'] }}">舍弃</a>
                            </p>
                        </section>
                    @endif
                @endforeach
            </div><!-- /.stream-list -->

            <div class="text-center">

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection