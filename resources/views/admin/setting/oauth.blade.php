@extends('admin/public/layout')
@section('title')一键登录设置@endsection
@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection
@section('content')
    <section class="content-header">
        <h1>一键登录设置</h1>
    </section>
    <section class="content">
        <div class="row">
                <div class="col-xs-12">
                    <div class="box box-default">
                        <form role="form" name="addForm" id="register_form" method="POST" action="{{ route('admin.setting.oauth') }}">
                            {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启第三方平台账号登录</label>
                                <span class="text-muted">(关闭后则不能使用QQ、微博等第三方平台账号登录系统)</span>
                                <div class="radio">
                                    <label><input type="radio" name="oauth_open" value="1" @if(Setting()->get('oauth_open') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="oauth_open" value="0" @if(Setting()->get('oauth_open') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="oauth_qq_key">QQ互联平台 APP ID</label>
                                <input type="text" class="form-control" name="oauth_qq_key" placeholder="APP ID" value="{{ old('oauth_qq_key',Setting()->get('oauth_qq_key')) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="oauth_qq_secret">QQ互联平台 APP key</label>
                                <input type="text" class="form-control" name="oauth_qq_secret" placeholder="APP KEY" value="{{ old('oauth_qq_secret',Setting()->get('oauth_qq_secret')) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="oauth_qq_redirect">QQ互联平台回调地址</label>
                                <input type="text" class="form-control" name="oauth_qq_redirect" placeholder="回调地址" value="{{ old('oauth_qq_redirect',Setting()->get('oauth_qq_redirect')) }}"  />
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="oauth_weibo_key">微博开放平台 APP ID</label>
                                <input type="text" class="form-control" name="oauth_weibo_key" placeholder="APP ID" value="{{ old('oauth_weibo_key',Setting()->get('oauth_weibo_key')) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="oauth_weibo_secret">微博开放平台 APP key</label>
                                <input type="text" class="form-control" name="oauth_weibo_secret" placeholder="APP KEY" value="{{ old('oauth_weibo_secret',Setting()->get('oauth_weibo_secret')) }}"  />
                            </div>
                            <div class="form-group">
                                <label for="oauth_weibo_redirect">微博开放平台回调地址</label>
                                <input type="text" class="form-control" name="oauth_weibo_redirect" placeholder="回调地址" value="{{ old('oauth_weibo_redirect',Setting()->get('oauth_weibo_redirect')) }}"  />
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            set_active_menu('third_part',"{{ route('admin.setting.oauth') }}");
        });
    </script>
@endsection