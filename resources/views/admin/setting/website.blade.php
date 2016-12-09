@extends('admin/public/layout')
@section('title')站点设置@endsection
@section('content')
<section class="content-header">
    <h1>
        站点设置
        <small>站点信息设置</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form role="form" name="addForm" id="website_form" method="POST" action="{{ route('admin.setting.website') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('website_name')) has-error @endif">
                            <label for="website_name">站点名称</label>
                            <span class="text-muted">(网站名称，将显示在页面Title处)</span>
                            <input type="text" name="website_name" class="form-control " placeholder="网站名称，将显示在页面Title处" value="{{ old('website_name',Setting()->get('website_name')) }}">
                            @if ($errors->has('website_name')) <p class="help-block">{{ $errors->first('website_name') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_slogan')) has-error @endif">
                            <label for="website_name">站点slogan</label>
                            <span class="text-muted">(网站口号)</span>
                            <input type="text" name="website_slogan" class="form-control " placeholder="做最好的中文问答系统" value="{{ old('website_slogan',Setting()->get('website_slogan')) }}">
                            @if ($errors->has('website_slogan')) <p class="help-block">{{ $errors->first('website_slogan') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_welcome')) has-error @endif">
                            <label for="website_welcome">首页欢迎语</label>
                            <span class="text-muted">(例如：欢迎加入Tipask站长问答社区，一起记录站长的世界)</span>
                            <input type="text" name="website_welcome" class="form-control " placeholder="首页欢迎语" value="{{ old('website_welcome',Setting()->get('website_welcome')) }}">
                            @if ($errors->has('website_welcome')) <p class="help-block">{{ $errors->first('website_welcome') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_url')) has-error @endif">
                            <label for="website_url">站点地址</label>
                            <span class="text-muted">(您站点的完整域名。例如: http://www.tipask.com，不要以斜杠 (“/”) 结尾)</span>
                            <input type="text" name="website_url" class="form-control " placeholder="填写您站点的完整域名" value="{{ old('website_url',Setting()->get('website_url')) }}">
                            @if ($errors->has('website_url')) <p class="help-block">{{ $errors->first('website_url') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_admin_email')) has-error @endif">
                            <label for="website_admin_email">管理员电子邮箱</label>
                            <span class="text-muted">(站点管理员的邮箱地址)</span>
                            <input type="text" name="website_admin_email" class="form-control " placeholder="填写您站点的管理员邮箱地址" value="{{ old('website_admin_email',Setting()->get('website_admin_email')) }}">
                            @if ($errors->has('website_admin_email')) <p class="help-block">{{ $errors->first('website_admin_email') }}</p> @endif
                        </div>


                        <div class="form-group @if ($errors->has('website_icp')) has-error @endif">
                            <label for="website_icp">网站备案号</label>
                            <span class="text-muted">(格式类似“京ICP证030173号”，它将显示在页面底部，没有请留空)</span>
                            <input type="text" name="website_icp" class="form-control " placeholder="格式类似“京ICP证030173号”，它将显示在页面底部，没有请留空" value="{{ old('website_icp',Setting()->get('website_icp')) }}">
                            @if ($errors->has('website_icp')) <p class="help-block">{{ $errors->first('website_icp') }}</p> @endif
                        </div>

                        <div class="form-group">
                            <label for="website_theme">网站默认模板</label>
                            <span class="text-muted">(网站的前台默认显示的模板)</span>
                            <select name="website_theme" class="form-control">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme }}" @if(Setting()->get('website_theme')===$theme) selected @endif >{{ $theme }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group @if ($errors->has('website_admin_email')) has-error @endif">
                            <label for="website_admin_email">系统缓存时间（分钟）</label>
                            <span class="text-muted">(设置范围是1-8640，缓存相关数据，包括首页缓存、积分排行榜等)</span>
                            <input type="text" name="website_cache_time" class="form-control " placeholder="系统缓存时间" value="{{ old('website_cache_time',Setting()->get('website_cache_time')) }}">
                            @if ($errors->has('website_cache_time')) <p class="help-block">{{ $errors->first('website_cache_time') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_header')) has-error @endif">
                            <label for="website_footer">页面头部扩展</label>
                            <span class="text-muted">(扩展头部信息，例如meta标签等)</span>
                            <textarea class="form-control" style="height: 100px;" name="website_header">{{ old('website_header',Setting()->get('website_header')) }}</textarea>
                            @if ($errors->has('website_header')) <p class="help-block">{{ $errors->first('website_header') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_footer')) has-error @endif">
                            <label for="website_footer">页面底部扩展</label>
                            <span class="text-muted">(扩展body前的底部信息,例如第三方统计代码等)</span>
                            <textarea class="form-control" style="height: 100px;" name="website_footer">{{ old('website_footer',Setting()->get('website_footer')) }}</textarea>
                            @if ($errors->has('website_footer')) <p class="help-block">{{ $errors->first('website_footer') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('website_share_code')) has-error @endif">
                            <label for="website_share_code">第三方分享代码</label>
                            <span class="text-muted">(百度分享或者jiathis等第三方分享代码)</span>
                            <textarea class="form-control" style="height: 100px;" name="website_share_code">{{ old('website_share_code',Setting()->get('website_share_code')) }}</textarea>
                            @if ($errors->has('website_share_code')) <p class="help-block">{{ $errors->first('website_share_code') }}</p> @endif
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="button" id="saveBtn" class="btn btn-primary" name="submitBtn">保存</button>
                        <button type="reset" class="btn btn-success">重置</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/static/js/jquery.jsonp.js') }}"></script>
<script type="text/javascript">
    $(function(){
        set_active_menu('global',"{{ route('admin.setting.website') }}");
        $("#saveBtn").click(function(){
            $.jsonp({
                url: push_site_url+$("#website_form input").serialize(),
                callbackParameter: "callback",
            });
            $("#website_form").submit();
        });

    });
</script>
@endsection