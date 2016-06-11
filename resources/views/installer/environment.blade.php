@extends('installer.layout')
@section('title')环境检测@endsection
@section('content')
    <h3>环境检测</h3>
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">PHP扩展检查</h4>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <tbody><tr>
                    <th>检查项目</th>
                    <th>状态</th>
                </tr>
                @foreach($requirements['requirements'] as $requirement => $status)
                <tr>
                    <td>{{ $requirement }} 扩展</td>
                    <td>
                        @if($status) <label class="label label-success">正常</label> @else <label class="label label-danger">出错</label> @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">权限检查</h4>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <tbody><tr>
                    <th>检查目录</th>
                    <th>当前权限</th>
                    <th>状态</th>
                </tr>
                @foreach($folders['folders'] as $folder => $permission)
                    <tr>
                        <td>{{ $folder }}</td>
                        <td>{{ $permission['permission'] }}</td>
                        <td>
                            @if($permission['status']) <label class="label label-success">正常</label> @else <label class="label label-danger">出错</label> @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <div class="box-footer text-center mt-10 mb-10">
        <a class="btn btn-primary btn-lg @if(!$result) disabled @endif" href="{{ route('website.installer.config') }}">下一步</a>
        <a class="btn btn-default btn-lg" href="{{ route('website.installer.welcome') }}">上一步</a>
    </div>



@endsection