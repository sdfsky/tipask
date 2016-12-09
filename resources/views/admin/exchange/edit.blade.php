@extends('admin/public/layout')
@section('title')编辑兑换记录@endsection
@section('content')
    <section class="content-header">
        <h1>
            编辑兑换记录
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST"  action="{{ route('admin.exchange.update',['id'=>$exchange->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('real_name')) has-error @endif">
                                <label>姓名</label>
                                <input type="text" name="real_name" class="form-control " placeholder="姓名" value="{{ old('real_name',$exchange->real_name) }}">
                                @if($errors->has('real_name')) <p class="help-block">{{ $errors->first('real_name') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('phone')) has-error @endif">
                                <label>电话</label>
                                <input type="text" name="phone" class="form-control " placeholder="电话" value="{{ old('phone',$exchange->phone) }}">
                                @if($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                <label>邮箱</label>
                                <input type="text" name="email" class="form-control " placeholder="邮箱" value="{{ old('email',$exchange->email) }}">
                                @if($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('comment')) has-error @endif">
                                <label>备注信息</label>
                                <textarea class="form-control" name="comment" style="height:100px;">{{ old('comment',$exchange->comment) }}</textarea>
                                @if($errors->has('comment')) <p class="help-block">{{ $errors->first('comment') }}</p> @endif
                            </div>



                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-success">重置</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        set_active_menu('admin',"{{ route('admin.permission.index') }}");
    </script>
@endsection