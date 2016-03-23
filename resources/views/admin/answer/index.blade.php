@extends('admin/public/layout')
@section('title')回答管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            回答管理
            <small>管理系统的所有回答</small>
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
                                    <a href="#" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新回答"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_delete('确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.answer.index') }}" method="GET">
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" name="word" placeholder="角色名称" value="{{ $word }}"/>
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
                        <form name="itemForm" id="item_form" method="POST" action="{{ route('admin.answer.destroy') }}">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle" /></th>
                                    <th>内容</th>
                                    <th>回答者</th>
                                    <th>赞同</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($answers as $answer)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $answer->id }}"/></td>
                                        <td width="60%" style="height:100px;">
                                            <b><a href="#">{{ $answer->question->title }}</a></b>
                                            <div style= "OVERFLOW-Y:auto;height:100px">{!! $answer->content !!}</div>
                                        </td>
                                        <td>{{ $answer->user->name }}</td>
                                        <td>{{ $answer->supports }}</td>
                                        <td>{{ timestamp_format($answer->created_at) }}</td>
                                        <td><span class="label @if($answer->status===0) label-danger @elseif($answer->status===1) label-warning @else label-success @endif">{{ trans_common_status($answer->status) }}</span> </td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.answer.edit',['id'=>$answer->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix text-right">
                        {!! str_replace('/?', '?', $answers->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.answer.index') }}");
    </script>
@endsection