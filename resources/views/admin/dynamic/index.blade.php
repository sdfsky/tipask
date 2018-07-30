@extends('admin/public/layout')

@section('title')动态管理@endsection

@section('content')
    <section class="content-header">
        <h1>动态管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="item_form" id="item_form" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                       <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{route('admin.dynamic.destroy')}}','删除选中动态，确认继续操作？')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>标示</th>
                                        <th>内容</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($doings as $doing)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $doing->id }}" name="ids[]"/></td>
                                            <td>{{ $doing->subject }}</td>
                                            <td>{{ $doing->content }}</td>
                                            <td>{{ $doing->created_at }}</td>
                                            <td><!--
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-primary" href="{{ route('admin.dynamic.edit',['id'=>$doing->id]) }}" data-toggle="tooltip" title="编辑分类信息"><i class="fa fa-edit" aria-hidden="true"></i> 编辑</a>
                                                </div>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $doings->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.dynamic.index') }}");
    </script>
@endsection