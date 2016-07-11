@extends('theme::layout.public')

@section('seo_title')编辑回答 - {{ Setting()->get('website_name') }}>@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.ask') }}">问答</a></li>
            <li><a href="{{ route('ask.question.detail',['id'=>$answer->question_id]) }}">{{ $answer->question->title }}</a></li>
            <li class="active">编辑回答</li>
        </ol>
        <form id="answer_form" method="POST" role="form" action="{{ route('ask.answer.update',['id'=>$answer->id]) }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">

            <div class="form-group  @if($errors->has('content')) has-error @endif">
                <div id="answer_editor">{!! old('content',$answer->content) !!}</div>
                @if($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
            </div>
            <div class="row mt-20">
                <div class="col-md-12">
                    <input type="hidden" id="answer_editor_content"  name="content" value="{{ $answer->content }}"  />
                    <button type="submit" class="btn btn-primary pull-right editor-submit" >保存修改</button>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            /*回答编辑器初始化*/
            $('#answer_editor').summernote({
                lang: 'zh-CN',
                height: 240,
                placeholder:'撰写答案',
                toolbar: [ {!! config('tipask.summernote.ask') !!} ],
                callbacks: {
                    onChange:function (contents, $editable) {
                        var code = $(this).summernote("code");
                        $("#answer_editor_content").val(code);
                    },
                    onImageUpload: function(files) {
                        upload_editor_image(files[0],'answer_editor');
                    }
                }
            });
        });
    </script>
@endsection