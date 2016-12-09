@extends('theme::layout.public')

@section('seo_title')编辑问题 - {{ Setting()->get('website_name') }}>@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">

@endsection

@section('content')
    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.ask') }}">问答</a></li>
            <li><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a></li>
            <li class="active">编辑问题</li>
        </ol>
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.update') }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $question->id }}" />
            <input type="hidden" id="tags" name="tags" value="{{ $question->tags->implode('name',',') }}" />

            <div class="form-group @if($errors->has('title')) has-error @endif ">
                <label for="title">问题标题:</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="请在这里概述您的问题" value="{{ old('title',$question->title) }}" />
                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>
            <div class="form-group  @if($errors->has('description')) has-error @endif">
                <label for="question_editor">问题描述(选填)</label>
                <div id="question_editor">{!! old('description',$question->description) !!}</div>
                @if($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="0">请选择分类</option>
                        @include('admin.category.option',['type'=>'questions','select_id'=>$question->category_id])
                    </select>
                </div>
                <div class="col-xs-8">
                    <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >
                        @foreach($question->tags as $tag)
                            <option selected="selected">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-20">
                <div class="col-xs-12 col-md-11">
                    <ul class="list-inline">
                        @if( Setting()->get('code_create_question') )
                            <li class="pull-right">
                                <div class="form-group @if ($errors->first('captcha')) has-error @endif">
                                    <input type="text" class="form-control" name="captcha" required="" placeholder="验证码" />
                                    @if ($errors->first('captcha'))
                                        <span class="help-block">{{ $errors->first('captcha') }}</span>
                                    @endif
                                    <div class="mt-10"><a href="javascript:void(0);" id="reloadCaptcha"><img src="{{ captcha_src()}}"></a></div>
                                </div>
                            </li>
                        @endif
                        <li><input type="checkbox" name="hide" value="1"  @if($question->hide==1) checked @endif />&nbsp;匿名</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-1">
                    <input type="hidden" id="question_editor_content"  name="description" value="{{ $question->description }}"  />
                    <button type="submit" class="btn btn-primary pull-right">确认修改</button>
                </div>

            </div>
        </form>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.min.js') }}"></script>
    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>

    <script type="text/javascript">
        var category_id = "{{ $question->category_id }}";

        $(document).ready(function() {
            $('#question_editor').summernote({
                lang: 'zh-CN',
                height: 180,
                placeholder:'您可以在这里继续补充问题细节',
                toolbar: [ {!! config('tipask.summernote.ask') !!} ],
                callbacks: {
                    onChange:function (contents, $editable) {
                        var code = $(this).summernote("code");
                        $("#question_editor_content").val(code);
                    },
                    onImageUpload: function(files) {
                        upload_editor_image(files[0],'question_editor');
                    }
                }
            });

            $("#category_id option").each(function(){
                if( $(this).val() == category_id ){
                    $(this).attr("selected","selected");
                }
            });
        });
    </script>
@endsection