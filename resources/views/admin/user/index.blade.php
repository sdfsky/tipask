@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            用户列表
            <small>显示当前系统的所有注册用户</small>
        </h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="btn-group">
                                    <a href="{{ route('admin.user.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新用户"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_delete('确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.user.index') }}" method="GET">
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" name="word" placeholder="用户名称" value="{{ $word }}"/>
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th><input type="checkbox" class="checkbox-toggle"/></th>
                                <th>用户ID</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>注册时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" value="{{ $user->id }}"/></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <div class="btn-group-xs" >
                                      <a class="btn btn-default" href="{{ route('admin.user.edit',['id'=>$user->id]) }}" data-toggle="tooltip" title="编辑用户信息"><i class="fa fa-edit"></i></a>
                                     </div>
                                </td>
                            </tr>
                            @endforeach
                           </table>
                    </div>
                    <div class="box-footer clearfix">
                        {!! str_replace('/?', '?', $users->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.user.index') }}");
    </script>
@endsection