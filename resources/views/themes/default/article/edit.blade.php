@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.blog') }}">文章</a></li>
            <li class="active">编辑文章</li>
        </ol>
        <form id="articleForm" method="POST" role="form" action="{{ route('blog.article.update',['id'=>$article->id]) }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">文章标题:</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="我想起那天下午在夕阳下的奔跑,那是我逝去的青春" value="{{ $article->title }}" />
            </div>

            <div class="form-group">
                <label for="editor">文章正文：</label>
                <textarea name="content" id="article_editor" class="form-control"  style="height:300px;">{{ $article->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="editor">文章导读：</label>
                <textarea name="summary" class="form-control">{{ $article->summary }}</textarea>
            </div>

            <div class="form-group">
                <label for="tags">添加话题:</label>
                <input type="text" class="form-control" placeholder="话题越精准，越容易让相关领域专业人士看到你的问题" name="tags" value="{{ $article->tags->implode('name',' ')}}" />
            </div>

            <div class="row mt-20">
                <div class="col-md-4 col-md-offset-8">
                    <button type="submit" class="btn btn-primary pull-right">发布文章</button>
                </div>
            </div>
        </form>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#article_editor').summernote({
                height: 300,
                codemirror:ask_editor_options.codemirror,
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"description",$("#editor_token").val());
                }
            });
        });
    </script>
@endsection