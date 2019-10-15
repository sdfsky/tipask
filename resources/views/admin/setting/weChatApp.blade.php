@extends('admin/public/layout')
@section('title')小程序配置@endsection
@section('content')
    <section class="content-header">
        <h1>小程序配置</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.setting.weChatApp') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启小程序</label>
                                <span class="text-muted">(开启后首页会显示小程序二维码)</span>
                                <div class="radio">
                                    <label><input type="radio" name="weapp_open" value="1" @if(Setting()->get('weapp_open','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="weapp_open" value="0" @if(Setting()->get('weapp_open','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weapp_app_id">AppId</label>
                                <span class="text-muted">(小程序ID)</span>
                                <input type="text" name="weapp_app_id" class="form-control" value="{{ Setting()->get('weapp_app_id','') }}" placeholder="微信小程序APPID"  />
                            </div>
                            <div class="form-group">
                                <label for="weapp_app_secret">AppSecret</label>
                                <span class="text-muted">(小程序秘钥)</span>
                                <input type="text" name="weapp_app_secret" class="form-control" value="{{ Setting()->get('weapp_app_secret','') }}" placeholder="微信小程序秘钥AppSecret"  />
                            </div>
                            <div class="form-group">
                                <label for="weapp_qrcode_image">小程序码</label>
                                <span class="text-muted">(推荐上传8cm边长的小程序码)</span>
                                <input type="file" name="weapp_qrcode_image" class="form-control"   />
                                @if(Setting()->get('weapp_qrcode_image'))
                                    <div style="margin-top: 10px;">
                                        <img src="{{ route('website.image.show',['image_name'=> Setting()->get('weapp_qrcode_image')]) }}" />
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="weapp_app_slogan">首页小程序solgan</label>
                                <span class="text-muted">(提示用户扫描的话语)</span>
                                <input type="text" name="weapp_app_slogan" class="form-control" value="{{ Setting()->get('weapp_app_slogan','') }}" placeholder="微信扫一扫，打开小程序"  />
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
            set_active_menu('weChatApp',"{{ route('admin.setting.weChatApp') }}");
        });
    </script>
@endsection