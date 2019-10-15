@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            公告管理
            <small>编辑公告</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/public/error')
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" action="{{ route('admin.notice.update',['id'=>$notice->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>公告标题</label>
                                <input type="text" name="subject" class="form-control "  placeholder="公告标题" value="{{ old('subject',$notice->subject) }}">
                            </div>
                            <div class="form-group">
                                <label>公告标题样式</label>
                                <span class="text-muted">(可以为空，也可以自定义样式，例如：style="color:red" )</span>
                                <input type="text" name="style" class="form-control "  placeholder="公告样式定义" value="{{ old('style',$notice->style) }}">
                            </div>
                            <div class="form-group">
                                <label>公告链接地址</label>
                                <input type="text" name="url" class="form-control "  placeholder="http://www.tipask.com" value="{{ old('url',$notice->url) }}">
                            </div>
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($notice->status===1) checked @endif /> 已审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($notice->status===0) checked @endif /> 待审核
                                    </label>
                                </div>
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
        set_active_menu('operations',"{{ route('admin.notice.index') }}");
    </script>
@endsection
