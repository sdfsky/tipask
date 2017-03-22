@extends('admin/public/layout')
@section('title')专家管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            专家管理
            <small>管理系统的所有专家</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.authentication.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.authentication.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" name="id_card" placeholder="身份证号码" value="{{ $filter['id_card'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="status">
                                                <option value="-1">--状态--</option>
                                                @foreach(trans_authentication_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="category_id">
                                                <option value="-1">--分类--</option>
                                                @include('admin.category.option',['type'=>'experts','select_id'=>$filter['category_id']])
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle" /></th>
                                        <th>UID</th>
                                        <th>所属分类</th>
                                        <th>真实姓名</th>
                                        <th>城市</th>
                                        <th>职称</th>
                                        <th>身份证号码</th>
                                        <th>认证领域</th>
                                        <th>更新时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($authentications as $authentication)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $authentication->user_id }}"/></td>
                                            <td>{{ $authentication->user_id }}</td>
                                            <td>@if($authentication->category) {{ $authentication->category->name }} @else 无 @endif</td>
                                            <td>{{ $authentication->real_name }}</td>
                                            <td>{{ Area()->getName($authentication->province) }} @if($authentication->city>0 &&  Area()->getName($authentication->province)!=Area()->getName($authentication->city)) - {{ Area()->getName($authentication->city) }} @endif</td>
                                            <td>{{ $authentication->title }}</td>
                                            <td>{{ $authentication->id_card }}</td>
                                            <td>{{ $authentication->skill }}</td>
                                            <td>{{ timestamp_format($authentication->updated_at) }}</td>
                                            <td><span class="label @if($authentication->status===0) label-warning  @elseif($authentication->status===1) label-success @else label-default  @endif">{{ trans_authentication_status($authentication->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.authentication.edit',['user_id'=>$authentication->user_id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.authentication.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $authentications->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $authentications->render()) !!}
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
    @include("admin.public.change_category_modal",['type'=>'experts','form_id'=>'item_form','form_action'=>route('admin.authentication.changeCategories')])
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.authentication.index') }}");
    </script>
@endsection