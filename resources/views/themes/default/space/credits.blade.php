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
                        <span class="text-muted">{{ $credit->action }} · {{ timestamp_format($credit->created_at) }}</span>
                        @if($credit->source_id > 0)
                            @if($credit->action === 'writeArticle')
                                <a target="_blank" class="ml-10" href="{{ route('ask.question.detail',['question_id'=>$credit->source_id]) }}">{{ $credit->source_subject }}</a>
                            @else
                                <a target="_blank" class="ml-10" href="{{ route('ask.question.detail',['question_id'=>$credit->source_id]) }}">{{ $credit->source_subject }}</a>
                            @endif
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


