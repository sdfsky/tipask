@extends('theme::layout.public')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">问答</a></li>
            <li><a href="{{ route('ask.question.detail',['id'=>$answer->question_id]) }}">{{ $answer->question->title }}</a></li>
            <li class="active">编辑回答</li>
        </ol>
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.answer.update',['id'=>$answer->id]) }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="editor">我的回答</label>
                <textarea name="content" id="answer_content" placeholder="您可以在这里继续补充问题细节" style="height:100px;width: 1000px;">{{ $answer->content }}</textarea>
            </div>
            <div class="row mt-20">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">确认修改</button>
                </div>

            </div>
        </form>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#answer_content').summernote({
                height: 240,
                placeholder: true,
                toolbar:ask_editor_options.toolbar,
                codemirror:ask_editor_options.codemirror,
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"description",$("#editor_token").val());
                }
            });
        });
    </script>
@endsection