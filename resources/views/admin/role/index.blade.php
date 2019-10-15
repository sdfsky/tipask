@extends('admin/public/layout')
@section('title')角色管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            角色管理
            <small>管理系统所有角色</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                      <div class="row">
                        <div class="col-xs-2">
                             <div class="btn-group">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新角色"><i class="fa fa-plus"></i></a>
                                {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_delete('确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                              </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST" action="{{ route('admin.role.destroy') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        {{--<th><input type="checkbox" class="checkbox-toggle" /></th>--}}
                                        <th>角色名称</th>
                                        <th>唯一标示</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($roles as $role)
                                        <tr>
                                            {{--<td><input type="checkbox" name="id[]" value="{{ $role->id }}"/></td>--}}
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->slug }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td>{{ $role->updated_at }}</td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.role.edit',['id'=>$role->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer clearfix text-right">
                        {!! str_replace('/?', '?', $roles->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('admin',"{{ route('admin.role.index') }}");
    </script>
@endsection