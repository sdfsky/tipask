@extends('admin/public/layout')
@section('title')文章管理@endsection
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
                                    <a href="{{ route('blog.article.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新问题"><i class="fa fa-plus"></i></a>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_delete('确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.article.index') }}" method="GET">
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
                        <form name="itemForm" id="item_form" method="POST" action="{{ route('admin.article.destroy') }}">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle" /></th>
                                    <th>标题</th>
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
                                        <td>{{ $article->user->name }}</td>
                                        <td>{{ $article->collections }} / {{ $article->views }}</td>
                                        <td>{{ timestamp_format($article->created_at) }}</td>
                                        <td><span class="label @if($article->status===0) label-danger  @else label-success @endif">{{ trans_common_status($article->status) }}</span> </td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.article.edit',['id'=>$article->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix text-right">
                        {!! str_replace('/?', '?', $articles->render()) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.article.index') }}");
    </script>
@endsection