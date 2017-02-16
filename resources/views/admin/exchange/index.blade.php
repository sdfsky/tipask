@extends('admin/public/layout')

@section('title')商城管理@endsection

@section('content')
    <section class="content-header">
        <h1>商品兑换记录管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="item_form" id="item_form" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>商品名</th>
                                        <th>金币</th>
                                        <th>姓名</th>
                                        <th>电话</th>
                                        <th>邮箱</th>
                                        <th>备注</th>
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($exchanges as $exchange)
                                        <tr>
                                            <td><strong>{{ $exchange->id }}</strong></td>
                                            <td><a href="{{ route('shop.goods.detail',['id'=>$exchange->goods_id]) }}" target="_blank">{{ $exchange->goods->name }}</a></td>
                                            <td>{{ $exchange->coins }}</td>
                                            <td>{{ $exchange->real_name }}</td>
                                            <td>{{ $exchange->phone }}</td>
                                            <td>{{ $exchange->email }}</td>
                                            <td width="30%">{{ $exchange->comment }}</td>
                                            <td>{{ $exchange->created_at }}</td>
                                            <td><span class="label @if($exchange->status===0) label-danger  @elseif($exchange->status === 1) label-success @else label-default @endif">{{ trans_exchange_status($exchange->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.exchange.edit',['id'=>$exchange->id]) }}" data-toggle="tooltip" title="编辑兑换记录信息"><i class="fa fa-edit"></i></a>
                                                    @if($exchange->status === 0 )
                                                        <a class="btn btn-default" href="{{ route('admin.exchange.changeStatus',['id'=>$exchange->id,'status'=>'success']) }}" data-toggle="tooltip" title="设置为处理成功"><i class="fa fa-check"></i></a>
                                                        <a class="btn btn-default" href="{{ route('admin.exchange.changeStatus',['id'=>$exchange->id,'status'=>'failed']) }}" data-toggle="tooltip" title="设置为处理失败"><i class="fa fa-remove"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $exchanges->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.exchange.index') }}");
    </script>
@endsection