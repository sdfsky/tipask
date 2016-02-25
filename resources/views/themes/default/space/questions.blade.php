@extends('theme::layout.space')

@section('space_content')

    <h4 class="space-steam-heading">{{ $questions->total() }} 个问题</h4>
    <ul class="space-steam-list">
        <li>
            <div class="row">
                <div class="col-md-8 space-steam-item-title-warp">
                    <strong>标题</strong>
                </div>
                <div class="col-md-2">
                    <strong>回答/浏览</strong>
                </div>
                <div class="col-md-2">
                    <strong>发布日期</strong>
                </div>
            </div>
        </li>
        @foreach($questions as $question)
            <li>
                <div class="row">
                    <div class="col-md-8 space-steam-item-title-warp">
                        @if($question->price>0)
                            <span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span>
                        @endif
                        <a class="space-steam-item-title" href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a>
                        @if($question->status===2) <span class="label label-success ml-5">已解决</span> @endif
                    </div>
                    <div class="col-md-2"><span class="text-muted">{{ $question->answers }}/{{ $question->views }}</span></div>
                    <div class="col-md-2">
                        <span class="space-steam-item-date">{{ timestamp_format($question->created_at) }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="text-center">
        {!! str_replace('/?', '?', $questions->render()) !!}
    </div>
@endsection


