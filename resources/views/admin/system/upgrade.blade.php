@extends('admin/public/layout')
@section('title')系统升级@endsection
@section('content')
    <section class="content-header">
        <h1>
            系统升级
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header"><h4>操作步骤</h4></div>
                    <div class="box-body">
                        <ol>
                            <li>备份数据库、还有程序源码（重要）</li>
                            <li>上传最新的Tipask源码并覆盖掉掉现有系统源码</li>
                            <li>点击下方的“一键升级”按钮进行升级</li>
                        </ol>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin.system.upgrade') }}?act=do" class="btn btn-primary btn-lg">一键升级</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection