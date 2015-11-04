@extends('theme::public.layout')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container mt-30">
        <form id="questionForm" method="POST" role="form" action="{{ route('ask.question.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">请将您的问题告诉我们:</label>
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

            <div class="operations mt20">
                <div class="pull-right">

                    <span class="text-muted hidden" id="editorStatus">已保存</span>
                    <a id="dropIt" href="javascript:void(0);" class="mr10 hidden">
                        [舍弃]
                    </a>

                    <button type="submit" class="btn btn-success">发布问题</button>
                </div>
            </div>
        </form>
        <div class="clearfix">
            <div class="shareToWeibo checkbox pull-left mr10">
                <label for="shareToWeibo"><input type="checkbox" id="shareToWeibo" checked="checked"> 同步到新浪微博</label>
            </div>
        </div>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 120,
                placeholder:true,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });
        });
    </script>
@endsection