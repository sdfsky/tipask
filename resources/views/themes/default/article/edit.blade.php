@extends('theme::layout.public')

@section('seo')
    <title>编辑文章 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.blog') }}">文章</a></li>
            <li class="active">编辑文章</li>
        </ol>
        <form id="articleForm" method="POST" role="form" action="{{ route('blog.article.update',['id'=>$article->id]) }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="tags" name="tags" value="{{ $article->tags->implode('name',',') }}" />

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
                <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >
                    @foreach($article->tags as $tag)
                        <option selected="selected">{{ $tag->name }}</option>
                    @endforeach
                </select>
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
    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#article_editor').summernote({
                height: 300,
                codemirror:ask_editor_options.codemirror,
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"description",$("#editor_token").val());
                }
            });

            $("#select_tags").select2({
                theme:'bootstrap',
                placeholder: "话题越精准，越容易让相关领域专业人士看到你的问题",
                ajax: {
                    url: '/ajax/loadTags',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            word: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength:1,
                tags:true
            });

            $("#select_tags").change(function(){
                $("#tags").val($("#select_tags").val());
            });

        });
    </script>
@endsection