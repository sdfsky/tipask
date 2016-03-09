@extends('theme::layout.public')

@section('seo')
    <title>发起提问 - {{ Setting()->get('website_name') }}</title>
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
            <li><a href="{{ route('website.ask') }}">问答</a></li>
            <li class="active">发起提问</li>
        </ol>
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.store') }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" id="tags" name="tags" value="" />
            <input type="hidden" name="to_user_id" value="{{ $to_user_id }}" />
            <div class="form-group">
                <label for="title">@if($toUser) 正在向 <a href="{{ route('auth.space.index',['id'=>$toUser->id]) }}">{{ $toUser->name }}</a> 提问 @else 请将您的问题告诉我们 @endif :</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="请在这里概述您的问题" value="" />
            </div>

            <div id="titleSuggest" class="panel hide widget-suggest panel-default">
                <div class="panel-body">
                    <p>
                        <strong>这些问题可能有你需要的答案</strong>
                        <button type="button" class="widget-suggest__close btn btn-default btn-xs">关闭提示</button>
                    </p>
                    <ul id="qList" class="list-unstyled widget-suggest__list"><li><a href="/q/1010000003465862" class="mr10"> | 解决 PHP的框架通常用于小型项目吗？php</a><span class="text-muted">9 个回答</span></li><li><a href="/q/1010000002911607" class="mr10"> | 解决 homebrew/php/php56-redis   josegonzalez/php/php56-redis?</a><span class="text-muted">2 个回答</span></li><li><a href="/q/1010000000450602" class="mr10"> php：php_scws安装失败</a><span class="text-muted">0 个回答</span></li><li><a href="/q/1010000002403181" class="mr10"> PHP转OC</a><span class="text-muted">4 个回答</span></li><li><a href="/q/1010000002523405" class="mr10"> | 解决 php配置的问题？</a><span class="text-muted">1 个回答</span></li><li><a href="/q/1010000000647710" class="mr10"> php怎么执行变量里的PHP模板代码？</a><span class="text-muted">3 个回答</span></li><li><a href="/q/1010000002719551" class="mr10"> | 解决 关于php事件</a><span class="text-muted">2 个回答</span></li></ul>
                </div>
            </div>
            <div class="form-group">
                <label for="editor">问题描述(选填)</label>
                <textarea name="description" id="description" placeholder="您可以在这里继续补充问题细节" style="height:100px;width: 1000px;"></textarea>
            </div>

            <div class="form-group">
                <label for="select_tags">添加话题</label>
                <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" ></select>
            </div>


            <div class="row mt-20">
                <div class="col-md-8">
                    <div class="checkbox pull-left">
                        悬赏
                        <select name="price">
                            <option selected="selected" value="0">0</option><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="30">30</option><option value="50">50</option><option value="80">80</option><option value="100">100</option>
                        </select> 金币
                        <span class="span-line">|</span>
                        <label>
                            <input type="checkbox" name="hide" value="1" /> 匿名
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
    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 180,
                placeholder:true,
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