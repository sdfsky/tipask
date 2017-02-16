@extends('admin/public/layout')
@section('title')积分设置@endsection
@section('content')
<section class="content-header">
    <h1>
        积分设置
        <small>网站用户积分策略设置</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.credits') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="alert alert-info" role="alert">经验和金币都可以设置为负数，0，或者正数，负数表示扣分</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable text-center">
                                <thead>
                                <tr role="row">
                                    <th>用户行为</th>
                                    <th>经验值</th>
                                    <th>金币数</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>用户注册获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_register')) has-error @endif "><input type="text" class="form-control" name="credits_register" value="{{ old('credits_register',Setting()->get('credits_register')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_register')) has-error @endif "><input type="text" class="form-control" name="coins_register" value="{{ old('coins_register',Setting()->get('coins_register')) }}" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>每日登录系统获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_login')) has-error @endif "><input type="text" class="form-control" name="credits_login" value="{{ old('credits_login',Setting()->get('credits_login')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_login')) has-error @endif "><input type="text" class="form-control" name="coins_login" value="{{ old('coins_login',Setting()->get('coins_login')) }}" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>提出问题获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_ask')) has-error @endif "><input type="text" class="form-control" name="credits_ask" value="{{ old('credits_ask',Setting()->get('credits_ask')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_ask')) has-error @endif "><input type="text" class="form-control" name="coins_ask" value="{{ old('coins_ask',Setting()->get('coins_ask')) }}" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>回答问题获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_answer')) has-error @endif "><input type="text" class="form-control" name="credits_answer" value="{{ old('credits_answer',Setting()->get('credits_answer')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_answer')) has-error @endif "><input type="text" class="form-control" name="coins_answer" value="{{ old('coins_answer',Setting()->get('coins_answer')) }}" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>回答被采纳获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_adopted')) has-error @endif "><input type="text" class="form-control" name="credits_adopted" value="{{ old('credits_adopted',Setting()->get('credits_adopted')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_adopted')) has-error @endif "><input type="text" class="form-control" name="coins_adopted" value="{{ old('coins_adopted',Setting()->get('coins_adopted')) }}" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>撰写文章获得</td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('credits_write_article')) has-error @endif "><input type="text" class="form-control" name="credits_write_article" value="{{ old('credits_adopted',Setting()->get('credits_write_article')) }}" /></div>
                                    </td>
                                    <td>
                                        <div class="col-md-4 col-md-offset-4 @if ($errors->has('coins_write_article')) has-error @endif "><input type="text" class="form-control" name="coins_write_article" value="{{ old('coins_write_article',Setting()->get('coins_write_article')) }}" /></div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
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
    set_active_menu('global',"{{ route('admin.setting.credits') }}");
</script>
@endsection