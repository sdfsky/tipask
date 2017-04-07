@extends('theme::layout.public')

@section('seo_title')发起提问 - {{ Setting()->get('website_name') }} @endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.ask') }}">问答</a></li>
            <li class="active">发起提问</li>
        </ol>
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.store') }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" id="tags" name="tags" value="" />
            <input type="hidden" name="to_user_id" value="{{ $to_user_id }}" />
            <div class="form-group  @if($errors->has('title')) has-error @endif">
                <label for="title">@if($toUser) 正在向 <a href="{{ route('auth.space.index',['id'=>$toUser->id]) }}">{{ $toUser->name }}</a> 提问 @else 请将您的问题告诉我们 @endif :</label>
                <input id="title" type="text" name="title"   class="form-control input-lg" placeholder="请在这里概述您的问题" value="{{ old('title','') }}" />
                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>

            <div id="titleSuggest" class="panel hide widget-suggest panel-default">
                <div class="panel-body">
                    <p>
                        <strong>这些问题可能有你需要的答案</strong>
                        <button type="button" class="widget-suggest-close btn btn-default btn-xs ml-10">关闭提示</button>
                    </p>
                    <ul id="suggest-list" class="list-unstyled widget-suggest-list"></ul>
                </div>
            </div>
            <div class="form-group  @if($errors->has('description')) has-error @endif">
                <label for="question_editor">问题描述(选填)</label>
                <div id="question_editor">{!! old('description','') !!}</div>
                @if($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="0">请选择分类</option>
                            @include('admin.category.option',['type'=>'questions','select_id'=>old('category_id',0)])
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >
                            @foreach(array_filter(explode(",",old('select_tags',''))) as $tag)
                                <option selected="selected">{{ $tag }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <li>
                            <select name="price">
                                <option selected="selected" value="0">0</option><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="30">30</option><option value="50">50</option><option value="80">80</option><option value="100">100</option>
                            </select>&nbsp;金币
                        </li>
                        <li><input type="checkbox" name="hide" value="1" />&nbsp;匿名</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-1">
                    <input type="hidden" id="question_editor_content"  name="description" value=""  />
                    <button type="submit" class="btn btn-primary pull-right" >发布问题</button>
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
        var suggest_timer = null;
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

            /*suggest处理*/
            $("#title").keydown(function(){

                if(suggest_timer){
                    clearTimeout(suggest_timer);
                }
                suggest_timer = setTimeout(function() {
                    var title = $("#title").val();
                    if( title.length > 1 ){
                        $.ajax({
                            url: '/question/suggest',
                            type:'post',
                            data:'word='+title,
                            cache: false,
                            success: function(html){
                                if(html == ''){
                                    $("#suggest-list").html('<li>没有找到相似问题！</li>');
                                    return;
                                }
                                $(".widget-suggest").removeClass("hide");
                                $("#suggest-list").html(html);
                            }
                        });
                    }
                }, 500);
            });

            $(".widget-suggest-close").click(function(){
                $(".widget-suggest").addClass("hide");
            });


        });
    </script>
@endsection