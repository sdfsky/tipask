@extends('theme::layout.public')

@section('seo_title')问推荐行家 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <h1 class="h3">推荐行家<br><small></small></h1>
    <div class="row  mt-20">
        <div class="col-md-12 main">
            @foreach($experts as $expert)
                <section class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <a href="{{ route('auth.space.index',['user_id'=>$expert->id]) }}" target="_blank"><img class="avatar-128" src="{{ route('website.image.avatar',['avatar_name'=>$expert->id.'_big'])}}" alt="{{ $expert->name }}"></a>

                        <div class="caption">
                            <h4 class="text-center"><a href="{{ route('auth.space.index',['user_id'=>$expert->id]) }}">{{ $expert->name }}</a></h4>
                            <p class="text-muted text-center">{{ $expert->title }}&nbsp;</p>
                            <p class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('ask.question.create') }}?to_user_id={{ $expert->id }}">向TA提问</a></p>
                        </div>
                    </div>
                </section>
            @endforeach
            <div class="text-center">
                {!! str_replace('/?', '?', $experts->render()) !!}
            </div>
        </div>
    </div>

@endsection