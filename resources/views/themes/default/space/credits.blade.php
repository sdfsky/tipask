@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif经验 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

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
                        @if($credit->source_id>0)
                            <a target="_blank" class="ml-10" href="{{ route('ask.question.detail',['question_id'=>$credit->source_id]) }}">{{ $credit->source_subject }}</a>
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


