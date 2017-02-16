@extends('admin/public/layout')
@section('title')文章管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            文章管理
            <small>管理系统的所有文章</small>
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
                                    <a href="{{ route('blog.article.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新文章"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.article.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.article.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="作者UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="category_id">
                                                <option value="-1">--分类--</option>
                                                @include('admin.category.option',['type'=>'articles','select_id'=>$filter['category_id']])
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">--状态--</option>
                                                @foreach(trans_common_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
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
                                        <th>标题</th>
                                        <th>分类</th>
                                        <th>作者</th>
                                        <th>收藏/查看</th>
                                        <th>时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $article->id }}"/></td>
                                            <td><a href="{{ route('blog.article.detail',['id'=>$article->id]) }}" target="_blank">{{ $article->title }}</a></td>
                                            <td>@if($article->category) {{ $article->category->name }} @else 无 @endif</td>
                                            <td>{{ $article->user->name }}<span class="text-muted">[UID:{{ $article->user_id }}]</span></td>
                                            <td>{{ $article->collections }} / {{ $article->views }}</td>
                                            <td>{{ timestamp_format($article->created_at) }}</td>
                                            <td><span class="label @if($article->status===0) label-danger  @else label-success @endif">{{ trans_common_status($article->status) }}</span> </td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" target="_blank" href="{{ route('blog.article.edit',['id'=>$article->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
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
                                    <a href="{{ route('blog.article.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新文章"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.article.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button>
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $articles->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $articles->render()) !!}
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
    @include("admin.public.change_category_modal",['type'=>'articles','form_id'=>'item_form','form_action'=>route('admin.article.changeCategories')])
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.article.index') }}");
    </script>
@endsection