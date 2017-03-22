@extends('admin/public/layout')
@section('title')系统积分记录@endsection
@section('content')
    <section class="content-header">
        <h1>
            系统积分记录
            <small>显示所有用户经验、积分记录</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <form name="searchForm" action="{{ route('admin.credit.index') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" name="user_id" placeholder="UID" value="{{ $filter['user_id'] or '' }}"/>
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                </div>
                                <div class="col-xs-3">
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                    <a href="{{ route('admin.credit.create') }}" class="btn btn-warning">手动充值</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>用户</th>
                                    <th>类型</th>
                                    <th>经验值</th>
                                    <th>金币数</th>
                                    <th>记录时间</th>
                                </tr>
                                @foreach($credits as $credit)
                                    <tr>
                                        <td>{{ $credit->id }}</td>
                                        <td> @if($credit->user){{ $credit->user->name }} @else 未知 @endif [uid:{{ $credit->user_id }}]</td>
                                        <td>{{ $credit->actionText }}</td>
                                        <td>{{ $credit->credits }}</td>
                                        <td>{{ $credit->coins }}</td>
                                        <td>{{ timestamp_format($credit->created_at) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="btn-group"></div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $credits->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $credits->render()) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('finance',"{{ route('admin.credit.index') }}");
    </script>
@endsection