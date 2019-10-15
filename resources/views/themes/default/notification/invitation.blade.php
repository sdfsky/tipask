@extends('theme::layout.public')

@section('seo_title')邀请我回答的问题 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-10">
                邀请我回答的问题
            </h2>
            <div class="stream-list widget-notify border-top">
                @foreach($invitations as $invitation)
                <section class="streams-item">
                    <a href="{{ route('ask.question.detail',['id'=>$invitation->question_id]) }}">{{ $invitation->question->title }}</a>
                    @if($invitation->status>0)<label class="label label-success">已作答</label>@else <label class="label label-warning">待作答</label> @endif
                </section>
                @endforeach
            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $invitations->render()) !!}
            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection