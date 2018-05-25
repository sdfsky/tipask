@extends('admin/public/layout')
@section('title')附件设置@endsection
@section('content')
    <section class="content-header">
        <h1>附件设置</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/public/error')
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.setting.attach') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="answer_adopt_period">图片上传大小限制</label>
                                <span class="text-muted">(单位是kb,1MB=1024kb,默认是2048kb)</span>
                                <input type="text" name="attach_image_size" class="form-control" value="{{ config('tipask.upload.image_size') }}" placeholder="单位是kb"  />
                            </div>

                            <div class="form-group">
                                <label for="website_url">附件上传大小限制</label>
                                <span class="text-muted">(单位是kb,1MB=1024kb,默认是8192kb)</span>
                                <input type="text" name="attach_file_size" class="form-control" value="{{ config('tipask.upload.attach_size') }}" placeholder="单位是kb"  />
                            </div>

                            <div class="form-group">
                                <label for="website_url">开启图片水印</label>
                                <span class="text-muted">(开启后编辑器上传的图片显示会添加水印)</span>
                                <div class="radio">
                                    <label><input type="radio" name="attach_open_watermark" value="1" @if(config('tipask.upload.open_watermark')) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="attach_open_watermark" value="0" @if(!config('tipask.upload.open_watermark')) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="answer_adopt_period">图片水印设置</label>
                                <span class="text-muted">(设置后编辑器上传的图片显示会添加水印,建议选择png格式的矢量图)</span>
                                <input type="file" name="attach_watermark_image" class="form-control"  placeholder="单位是kb"  />
                                @if(config('tipask.upload.watermark_image'))
                                    <div style="margin-top: 10px;">
                                        <img src="{{ route('website.image.show',['image_name'=> config('tipask.upload.watermark_image')]) }}" />
                                    </div>
                                @endif
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
            set_active_menu('global',"{{ route('admin.setting.attach') }}");
        });
    </script>
@endsection