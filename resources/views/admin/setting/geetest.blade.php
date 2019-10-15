@extends('admin/public/layout')
@section('title') 极验证整合 @endsection
@section('content')
    <section class="content-header">
        <h1>极验证整合</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info" role="alert">geetest申请开通流程参见 http://www.geetest.com</div>
                <div class="box box-default">
                    <form role="form" name="addForm"  method="POST" action="{{ route('admin.setting.geetest') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="website_url">开启极验证</label>
                                <span class="text-muted">(开启前一定要确认geetest相关账号已开通)</span>
                                <div class="radio">
                                    <label><input type="radio" name="geetest_open" value="1" @if(config('services.geetest_open','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="geetest_open" value="0" @if(config('services.geetest_open','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="geetest_id">Geetest ID</label>
                                <input type="text" name="geetest_id" class="form-control" value="{{ config('geetest.id') }}" placeholder="geetest ID"  />
                            </div>

                            <div class="form-group">
                                <label for="geetest_key">Geetest KEY</label>
                                <input type="text" name="geetest_key" class="form-control" value="{{ config('geetest.key') }}" placeholder="geetest key"  />
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
            set_active_menu('third_part',"{{ route('admin.setting.geetest') }}");
        });
    </script>
@endsection