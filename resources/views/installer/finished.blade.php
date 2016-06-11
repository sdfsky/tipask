@extends('installer.layout')
@section('title')安装成功@endsection
@section('content')
    <div class="box mt-30">
        <div class="box-body">
            <div class="text-center">
                <h3 class="text-success"><i class="fa fa-smile-o" ></i> 恭喜，安装成功!</h3>
                <p class="mt-10">希望Tipask问答系统能帮您走向成功!</p>
                <a href="{{ route('website.index') }}" class="btn btn-primary">访问网站首页</a>
                <form id="websiteForm" name="websiteForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="website_name" value="{{ Setting()->get('website_name') }}" />
                    <input type="hidden" name="website_url" value="{{ Setting()->get('website_url') }}" />
                    <input type="hidden" name="website_admin_email" value="{{ Setting()->get('website_admin_email') }}" />
                    <input type="hidden" name="website_admin_email" value="{{ Setting()->get('website_admin_email') }}" />
                    <input type="hidden" name="website_version" value="{{ config('tipask.version') }}" />
                    <input type="hidden" name="website_release" value="{{ config('tipask.release') }}" />
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/static/js/jquery.jsonp.js') }}"></script>
    <script type="text/javascript">
        var push_site_url = "http://www.tipask.com/sync?";
        $(function(){
            $.jsonp({
                url: push_site_url+$("#websiteForm input").serialize(),
                callbackParameter: "callback",
            });
        });
    </script>
@endsection