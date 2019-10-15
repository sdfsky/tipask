@extends('theme::layout.space')

@section('seo_title')@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我@else{{ $userInfo->name }} @endif 的金币 - {{ Setting()->get('website_name') }}@endsection

@section('space_content')
    <h2 class="h4">{{ $coins->total() }} 条记录</h2>
    <div class="stream-list board border-top">
            <ul class="list-unstyled record-list coins">
                @foreach($coins as $coin)
                <li>
                    <div class="pull-left">
                        <span class="badge">{{ integer_string($coin->coins) }}</span>
                    </div>
                    <p>
                        <span class="text-muted">{{ $coin->actionText }} · {{ timestamp_format($coin->created_at) }}</span>
                        @if(in_array($coin->action,['ask','answer','answer_adopted']))
                            <a class="ml-5" target="_blank" href="{{ route('ask.question.detail',['id'=>$coin->source_id]) }}">{{ $coin->source_subject }}</a>
                        @elseif(in_array($coin->action,['create_article']))
                            <a class="ml-5" target="_blank" href="{{ route('blog.article.detail',['id'=>$coin->source_id]) }}">{{ $coin->source_subject }}</a>
                        @elseif(in_array($coin->action,['buy_video','sale_video']))
                            <a class="ml-5" target="_blank" href="{{ route('live.course.show',['id'=>$coin->source_id]) }}">{{ $coin->source_subject }}</a>
                        @endif
                    </p>
                </li>
                @endforeach
            </ul>
    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $coins->render()) !!}
    </div>
@endsection


