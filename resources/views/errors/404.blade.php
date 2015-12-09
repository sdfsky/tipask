@extends('errors/layout')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><i class="fa fa-frown-o red"></i> 404 Not Found</h1>
            <p class="lead">We couldn't find what you're looking for on <em><span id="display-domain"></span></em>.</p>
            <p>
                <a class="btn btn-default btn-lg"><span class="green">Take Me To The Homepage</span></a>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happened?</h2>
                    <p class="lead">A 404 error status implies that the file or page that you're looking for could not be found.</p>
                </div>
                <div class="col-md-6">
                    <h2>What can I do?</h2>
                    <p class="lead">If you're a site vistor</p>
                    <p>Please use your browsers back button and check that you're in the right place. If you need immediate assistance, please send us an email instead.</p>
                    <p class="lead">If you're the site owner</p>
                    <p>Please check that you're in the right place and get in touch with your website provider if you believe this to be an error.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

