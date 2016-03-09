@extends('theme::layout.public')

@section('seo')
    <title>编辑问题 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.ask') }}">问答</a></li>
            <li><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a></li>
            <li class="active">编辑问题</li>
        </ol>
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.update') }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $question->id }}" />
            <input type="hidden" id="tags" name="tags" value="{{ $question->tags->implode('name',',') }}" />

            <div class="form-group">
                <label for="title">问题标题:</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="请在这里概述您的问题" value="{{ $question->title }}" />
            </div>
            <div class="form-group">
                <label for="editor">问题描述(选填)</label>
                <textarea name="description" id="description" placeholder="您可以在这里继续补充问题细节" style="height:100px;width: 1000px;">{{ $question->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="select_tags">添加话题</label>
                <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >
                    @foreach($question->tags as $tag)
                        <option selected="selected">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mt-20">
                <div class="col-md-8">
                    <div class="checkbox pull-left">
                        <label>
                            <input type="checkbox" name="hide" value="1"  @if($question->hide==1) checked @endif /> 匿名
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary pull-right">确认修改</button>
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
            $('#description').summernote({
                height: 180,
                placeholder: true,
                toolbar:ask_editor_options.toolbar,
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