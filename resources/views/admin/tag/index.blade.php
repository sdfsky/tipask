@extends('admin/public/layout')
@section('title')话题管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            话题管理
            <small>管理系统的所有话题</small>
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
                                    <a href="{{ route('admin.tag.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加话题"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" title="移动分类"  data-toggle="modal" data-target="#change_category_modal" ><i data-toggle="tooltip" title="移动分类" class="fa fa-bars" aria-hidden="true"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.tag.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.tag.index') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="category_id">
                                                <option value="-1">不选择</option>
                                                @include('admin.category.option',['type'=>'tags','select_id'=>$filter['category_id']])
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
                                        <th>ID</th>
                                        <th>图标</th>
                                        <th>名称</th>
                                        <th>分类</th>
                                        <th>简介</th>
                                        <th>粉丝数</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $tag->id }}"/></td>
                                            <td>{{ $tag->id }}</td>
                                            <td> @if($tag->logo)
                                                    <img src="{{ route('website.image.show',['image_name'=>$tag->logo]) }}"  style="width: 27px;"/>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('ask.tag.index',['id'=>$tag->id,'source_type'=>'questions']) }}" target="_blank">{{ $tag->name }}</a></td>
                                            <td>@if($tag->category){{ $tag->category->name }} @else 无 @endif</td>
                                            <td width="50%">{{ $tag->summary }}</td>
                                            <td>{{ $tag->followers }}</td>
                                            <td>{{ timestamp_format($tag->created_at) }}</td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.tag.edit',['id'=>$tag->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.tag.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $tags->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $tags->appends($filter)->links()) !!}
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
    @include("admin.public.change_category_modal",['type'=>'tags','form_id'=>'item_form','form_action'=>route('admin.tag.changeCategories')])
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.tag.index') }}");
    </script>
@endsection