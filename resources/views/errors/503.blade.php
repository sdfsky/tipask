@extends('errors/layout')

@section('title') 503 Service Unavailable @endsection


@section('content')

    <h1><i class="fa fa-exclamation-triangle orange"></i>  503 Service Unavailable</h1>
    <p class="lead">The web server is returning an unexpected temporary error for {{ Setting()->get('website_url') }}.</p>
    <p>
        <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">Try This Page Again</span></a>
    </p>

@endsection
