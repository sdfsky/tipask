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
                                    <a href="{{ route('ask.question.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="发起提问"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.question.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" title="删除选中项"  data-toggle="modal" data-target="#send_report_modal" ><i data-toggle="tooltip" title="删除选中项" class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.question.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.question.index') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">不选择</option>
                                                @foreach(trans_question_status('all') as $key => $status)
                                                <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="category_id">
                                                <option value="-1">--分类--</option>
                                                @include('admin.category.option',['type'=>'questions','select_id'=>$filter['category_id']])
                                            </select>
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
                        <form name="itemForm" id="item_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle" /></th>
                                        <th>ID</th>
                                        <th>悬赏</th>
                                        <th>分类</th>
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
                                            <td>{{ $question->id }}</td>
                                            <td><span class="text-gold"><i class="fa fa-database"></i> {{ $question->price }}</span></td>
                                            <td>@if( $question->category ) {{ $question->category->name }} @else 无 @endif</td>
                                            <td><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}" target="_blank">{{ $question->title }}</a></td>
                                            <td>{{ $question->user->name }}<span class="text-muted">[UID:{{ $question->user_id }}]</span></td>
                                            <td>{{ $question->answers }} / {{ $question->views }}</td>
                                            <td>{{ timestamp_format($question->created_at) }}</td>
                                            <td><span class="label @if($question->status===0) label-danger @elseif($question->status== -1) label-default @elseif($question->status===1) label-warning @else label-success @endif">{{ trans_question_status($question->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" target="_blank" href="{{ route('ask.question.edit',['id'=>$question->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
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
                                    <a href="{{ route('ask.question.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="发起提问"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.question.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" title="删除选中项"  data-toggle="modal" data-target="#send_report_modal" ><i data-toggle="tooltip" title="删除选中项" class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    {{--<button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.question.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>--}}
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $questions->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $questions->appends($filter)->links()) !!}
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
    @include("admin.public.change_category_modal",['type'=>'questions','form_id'=>'item_form','form_action'=>route('admin.question.changeCategories')])
    @include("admin.public.report_modal",['type'=>'questions','form_id'=>'item_form','form_action'=>route('admin.question.destroy')])
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.question.index') }}");
    </script>
@endsection