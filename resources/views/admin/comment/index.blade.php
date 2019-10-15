@extends('admin/public/layout')
@section('title')评论管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            评论管理
            <small>管理系统的所有评论</small>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.comment.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.comment.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.comment.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="评论人UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">不选择</option>
                                                @foreach(trans_common_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
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
                                        <th>内容</th>
                                        <th>评论者</th>
                                        <th>时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $comment->id }}"/></td>
                                            <td width="60%" style="height:100px;">
                                                <div style= "OVERFLOW-Y:auto;height:60px">{!! $comment->content !!}</div>
                                                @if($comment->source()->first())
                                                    来源于@if(str_contains($comment->source_type,'Question'))问题[<a href="{{ route('ask.question.detail',['id'=>$comment->source_id]) }}" target="_blank" >{{ $comment->source()->first()->title }}</a>]
                                                    @elseif(str_contains($comment->source_type,'Answer'))回答[<a href="{{ route('ask.answer.detail',['question_id'=>$comment->source()->first()->question_id,'id'=>$comment->source_id]) }}" target="_blank" >{{ $comment->source()->first()->question_title }}</a>]
                                                    @elseif(str_contains($comment->source_type,'Article'))文章[<a href="{{ route('blog.article.detail',['id'=>$comment->source_id]) }}" target="_blank" >{{ $comment->source()->first()->title }}</a>]
                                                    @endif
                                                @endif

                                            </td>
                                            <td>{{ $comment->user->name }} <span class="text-muted">[UID:{{ $comment->user_id }}]</span></td>
                                            <td>{{ timestamp_format($comment->created_at) }}</td>
                                            <td><span class="label @if($comment->status===0) label-danger @elseif($comment->status===1)label-success @endif">{{ trans_common_status($comment->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.comment.edit',['id'=>$comment->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.comment.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.comment.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $comments->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $comments->appends($filter)->links()) !!}
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
        set_active_menu('manage_content',"{{ route('admin.comment.index') }}");
    </script>
@endsection