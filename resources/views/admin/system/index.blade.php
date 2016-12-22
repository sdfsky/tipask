@extends('admin/public/layout')
@section('title')系统升级@endsection
@section('content')
    <section class="content-header">
        <h1>
            系统工具
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">系统升级</h3>
                    </div>
                    <form name="upgradeForm" method="post" action="{{ route('admin.system.upgrade') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <p>升级步骤如下：</p>
                            <ol>
                                <li>备份数据库、还有程序源码（重要）</li>
                                <li>上传最新的Tipask源码并覆盖掉掉现有系统源码</li>
                                <li>点击下方的“一键升级”按钮进行升级</li>
                            </ol>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg">一键升级</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">数据校准</h3>
                    </div>
                    <form name="adjustForm" method="post" action="{{ route('admin.system.adjust') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <p>主要用户校准用户的标签统计数据，新安装的程序不需要执行</p>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg">同步用户话题数据</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('global',"{{ route('admin.system.index') }}");
    </script>
@endsection