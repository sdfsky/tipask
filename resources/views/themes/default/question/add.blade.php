@extends('theme::public.layout')

@section('css')

    <link href="{{ asset('/css/default/question.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="container">
        <h1 class="h4 mt20">提问题
            <input type="hidden" value="" id="draftId">
            <input type="hidden" value="0" name="site" id="siteId">
        </h1>
        <form id="question" method="POST" role="form">
            <div class="form-group">
                <label for="" class="sr-only">标题</label>
                <input id="myTitle" type="text" name="title" required="" data-error="" autocomplete="off" class="form-control tagClose input-lg" placeholder="标题：一句话说清你遇到的开发问题" value="">
            </div>

            <div id="titleSuggest" class="panel hidden widget-suggest panel-default">
                <div class="panel-body">
                    <p>
                        <strong>这些问题可能有你需要的答案</strong>
                        <button type="button" class="widget-suggest__close btn btn-default btn-xs">关闭提示</button>
                    </p>
                    <ul id="qList" class="list-unstyled widget-suggest__list">
                    </ul>
                </div>
            </div>

            <label class="sr-only">标签：至少1个，最多5个</label>
            <ul id="questionTags" class="list-inline widget-addtags clearfix" data-error="">


                <li class="widget-addtags__input dropdown">            <div class="input-group">                <input type="text" class="tagText empty form-control input-sm" placeholder="标签，如：php">            </div><ul class="autoComplete-list dropdown-menu" style="display: none;"></ul>        </li><li class="widget-addtags__add hide">
                    <button type="button" class="tagAdd btn btn-default btn-xs required">添加</button>
                </li>
            </ul>
            <div id="questionText" class="editor liveMode">
                <div class="editor-toolbar" id="wmd-button-bar"><ul class="editor-mode"><li class="pull-right"><a class="editor__menu--preview" title="预览模式"></a></li><li class="pull-right"><a class="editor__menu--live muted" title="实况模式"></a></li><li class="pull-right"><a class="editor__menu--edit" title="编辑模式"></a></li><li class="pull-right editor__menu--divider"></li><li id="wmd-zen-button" class="pull-right" title="全屏"><a class="editor__menu--zen"></a></li></ul><ul id="wmd-button-row" class="editor__menu clearfix"><li class="wmd-button" id="wmd-bold-button" title="加粗 <strong> Ctrl+B" style="left: 0px;"><a class="editor__menu--bold" style="background-position: 0px 0px;"></a></li><li class="wmd-button" id="wmd-italic-button" title="斜体 <em> Ctrl+I" style="left: 25px;"><a class="editor__menu--bold" style="background-position: -20px 0px;"></a></li><li class="editor__menu--divider wmd-spacer1" id="wmd-spacer1"></li><li class="wmd-button" id="wmd-link-button" title="链接 <a> Ctrl+L" style="left: 75px;"><a class="editor__menu--bold" style="background-position: -40px 0px;"></a></li><li class="wmd-button" id="wmd-quote-button" title="引用 <blockquote> Ctrl+Q" style="left: 100px;"><a class="editor__menu--bold" style="background-position: -60px 0px;"></a></li><li class="wmd-button" id="wmd-code-button" title="代码 <pre><code> Ctrl+K" style="left: 125px;"><a class="editor__menu--bold" style="background-position: -80px 0px;"></a></li><li class="wmd-button" id="wmd-image-button" title="图片 <img> Ctrl+G" style="left: 150px;"><a class="editor__menu--bold" style="background-position: -100px 0px;"></a></li><li class="editor__menu--divider wmd-spacer2" id="wmd-spacer2"></li><li class="wmd-button" id="wmd-olist-button" title="数字列表 <ol> Ctrl+O" style="left: 200px;"><a class="editor__menu--bold" style="background-position: -120px 0px;"></a></li><li class="wmd-button" id="wmd-ulist-button" title="普通列表 <ul> Ctrl+U" style="left: 225px;"><a class="editor__menu--bold" style="background-position: -140px 0px;"></a></li><li class="wmd-button" id="wmd-heading-button" title="标题 <h1>/<h2> Ctrl+H" style="left: 250px;"><a class="editor__menu--bold" style="background-position: -160px 0px;"></a></li><li class="wmd-button" id="wmd-hr-button" title="分割线 <hr> Ctrl+R" style="left: 275px;"><a class="editor__menu--bold" style="background-position: -180px 0px;"></a></li><li class="editor__menu--divider wmd-spacer3" id="wmd-spacer3"></li><li class="wmd-button" id="wmd-undo-button" title="撤销 - Ctrl+Z" style="left: 325px;"><a class="editor__menu--bold" style="background-position: -200px -20px;"></a></li><li class="wmd-button" id="wmd-redo-button" title="重做 - Ctrl+Shift+Z" style="left: 350px;"><a class="editor__menu--bold" style="background-position: -220px -20px;"></a></li><li class="editor__menu--divider wmd-spacer4" id="wmd-spacer4"></li><li class="wmd-button" id="wmd-help-button" title="Markdown 语法" style="left: 400px;"><a class="editor__menu--bold" style="background-position: -300px 0px;"></a></li></ul></div><div class="wmd"><textarea id="myEditor" class="mono form-control wmd-input"></textarea></div><div class="editor-line"></div><div class="editor-preview fmt" id="wmd-preview"></div>
            </div><a class="editor__resize" href="javascript:void(0);">调整高度</a>
            <div class="operations mt20">
                <div class="pull-right">
                    <span class="text-muted hidden" id="editorStatus">已保存</span>
                    <a id="dropIt" href="javascript:void(0);" class="mr10 hidden">
                        [舍弃]
                    </a>
                    <button data-type="question" id="publishIt" class="btn btn-primary btn-lg ml20" data-bid="" data-id="" data-do="" data-url="" data-text="发布问题" data-name="">
                        发布问题
                    </button>
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