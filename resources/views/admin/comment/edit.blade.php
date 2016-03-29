@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            编辑评论
            <small>编辑评论信息</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/public/error')
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" action="{{ route('admin.comment.update',['id'=>$comment->id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label>评论内容</label>
                                <textarea name="content" class="form-control" style="height: 100px;">{{ $comment->content }}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection