@extends('theme::layout.public')

@section('seo_title')编辑文章 - {{ Setting()->get('website_name') }}@endsection

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/editormd/css/editormd.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('website.blog') }}">文章</a></li>
            <li><a href="{{ route('blog.article.detail',['id'=>$article->id]) }}">{{ $article->title }}</a></li>
            <li class="active">编辑文章</li>
        </ol>
        <form id="article_form" method="POST" role="form" enctype="multipart/form-data" action="{{ route('blog.article.update',['id'=>$article->id]) }}">
            <input type="hidden" id="editor_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="tags" name="tags" value="{{ $article->tags->implode('name',',') }}" />


            <div class="form-group @if($errors->has('title')) has-error @endif ">
                <label for="title">文章标题:</label>
                <input id="title" type="text" name="title"  class="form-control input-lg" placeholder="我想起那天下午在夕阳下的奔跑,那是我逝去的青春" value="{{ old('title',$article->title) }}" />
                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>

            <div class="form-group @if($errors->has('logo')) has-error @endif">
                <label>文章封面</label>
                <input type="file" name="logo" />
                @if($article->logo)
                <div style="margin-top: 10px;">
                    <img src="{{ route('website.image.show',['image_name'=>$article->logo]) }}" />
                </div>
                @endif
                @if($errors->has('logo')) <p class="help-block">{{ $errors->first('logo') }}</p> @endif
            </div>


            <div class="form-group  @if($errors->has('content')) has-error @endif">
                <label for="md_editor">文章正文：</label>
                <?php 
                    $mdcontent = htmlspecialchars(old('content','')); 
                    if ($mdcontent == '') {
                        $mdcontent = $article->content;
                    }
                ?>
                <textarea id="md_editor_content" style="display:none;">{{ $mdcontent }}</textarea>
                <div id="md_editor">
                    <textarea style="display:none;" name="content"></textarea>
                </div>
                @if($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
            </div>

            <div class="form-group">
                <label for="editor">文章导读：</label>
                <textarea name="summary" class="form-control">{{ $article->summary }}</textarea>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="0">请选择分类</option>
                        @include('admin.category.option',['type'=>'articles','select_id'=>$article->category_id])
                    </select>
                </div>
                <div class="col-xs-8">
                    <select id="select_tags" name="select_tags" class="form-control" multiple="multiple" >
                        @foreach($article->tags as $tag)
                            <option selected="selected">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-20">
                <div class="col-xs-12 col-md-11">
                    <ul class="list-inline">
                        @if( Setting()->get('code_create_article') )
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
                    </ul>
                </div>
                <div class="col-xs-12 col-md-1">
                    <button type="submit" class="btn btn-primary pull-right editor-submit">提交修改</button>
                </div>
            </div>
        </form>

    </div>

@endsection
@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.min.js') }}"></script>
    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('/static/js/editormd/editormd.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var category_id = "{{ $article->category_id }}";

            editormd("md_editor", {
	            path: "/static/js/editormd/lib/",
                height: 640,
                syncScrolling: "single",
                saveHTMLToTextarea: true, 
                appendMarkdown: $("#md_editor_content").text(),
                imageUpload: true,
                imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL: "/image/upload"
            });


            $("#category_id option").each(function(){
                if( $(this).val() == category_id ){
                    $(this).attr("selected","selected");
                }
            });

        });
    </script>
@endsection