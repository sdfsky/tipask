@extends('theme::layout.space')

@section('seo_title')@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我@else{{ $userInfo->name }}@endif的经验 - {{ Setting()->get('website_name') }}@endsection

@section('space_content')
    <h2 class="h4">{{ $credits->total() }} 条记录</h2>
    <div class="stream-list board border-top">
            <ul class="list-unstyled record-list credits">
                @foreach($credits as $credit)
                <li>
                    <div class="pull-left">
                        <span class="badge">{{ integer_string($credit->credits) }}</span>
                    </div>
                    <p>
                        <span class="text-muted">{{ $credit->actionText }} · {{ timestamp_format($credit->created_at) }}</span>
                        @if(in_array($credit->action,['ask','answer','answer_adopted']))
                            <a href="{{ route('ask.question.detail',['id'=>$credit->source_id]) }}">{{ $credit->subject }}</a>
                        @elseif(in_array($credit->action,['create_article']))
                            <a href="{{ route('blog.article.detail',['id'=>$credit->source_id]) }}">{{ $credit->subject }}</a>
                        @endif
                    </p>
                </li>
                @endforeach
            </ul>
    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $credits->render()) !!}
    </div>
@endsection


