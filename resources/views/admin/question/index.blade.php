@extends('admin/public/layout')
@section('title')问题管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            问题管理
            <small>管理系统的所有问题</small>
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
                                    <a href="{{ route('ask.question.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新问题"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_delete('确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.question.index') }}" method="GET">
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
                        <form name="itemForm" id="item_form" method="POST" action="{{ route('admin.question.destroy') }}">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle" /></th>
                                    <th>悬赏</th>
                                    <th>标题</th>
                                    <th>提问人</th>
                                    <th>回答/查看</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($questions as $question)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $question->id }}"/></td>
                                        <td><span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span></td>
                                        <td><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}" target="_blank">{{ $question->title }}</a></td>
                                        <td>{{ $question->user->name }}</td>
                                        <td>{{ $question->answers }} / {{ $question->views }}</td>
                                        <td>{{ timestamp_format($question->created_at) }}</td>
                                        <td><span class="label @if($question->status===0) label-danger @elseif($question->status===1) label-warning @else label-success @endif">{{ trans_question_status($question->status) }}</span> </td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.question.edit',['id'=>$question->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix text-right">
                        {!! str_replace('/?', '?', $questions->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.question.index') }}");
    </script>
@endsection