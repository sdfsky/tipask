@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-10">
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.update') }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $question->id }}" />
            <div class="form-group">
                <label for="title">问题标题:</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="请在这里概述您的问题" value="{{ $question->title }}" />
            </div>
            <div class="form-group">
                <label for="editor">问题描述(选填)</label>
                <textarea name="description" id="description" placeholder="您可以在这里继续补充问题细节" style="height:100px;width: 1000px;">{{ $question->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="tags">添加话题</label>
                <input type="text" class="form-control" placeholder="话题越精准，越容易让相关领域专业人士看到你的问题" name="tags" value="{{ $question->tags->implode('name',' ') }}" />
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
                    <button type="submit" class="btn btn-primary pull-right">发布问题</button>
                </div>

            </div>
        </form>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 180,
                placeholder:true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                },
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"description",$("#editor_token").val());
                }
            });
        });
    </script>
@endsection