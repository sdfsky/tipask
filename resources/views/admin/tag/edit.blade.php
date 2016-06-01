@extends('admin/public/layout')

@section('css')
    <link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('title')
    编辑话题
@endsection

@section('content')
    <section class="content-header">
        <h1>
            编辑话题
            <small>编辑话题信息</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.tag.index') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="tagForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.tag.update',['id'=>$tag->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label for="name">话题名称</label>
                                <input type="text" name="name" class="form-control " placeholder="话题名称" value="{{ old('name',$tag->name) }}">
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>话题图标</label>
                                <input type="file" name="logo" />
                                @if($tag->logo)
                                <div style="margin-top: 10px;">
                                    <img src="{{ route('website.image.show',['image_name'=>$tag->logo]) }}" />
                                </div>
                                @endif
                            </div>

                            <div class="form-group @if ($errors->has('summary')) has-error @endif">
                                <label for="name">简介</label>
                                <textarea name="summary" class="form-control" placeholder="话题简介" style="height: 80px;">{{ old('summary',$tag->summary) }}</textarea>
                                @if ($errors->has('summary')) <p class="help-block">{{ $errors->first('summary') }}</p> @endif
                            </div>

                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="name">话题详细介绍</label>
                                <textarea name="description" id="description" class="form-control" placeholder="话题详细介绍">{{ old('description',$tag->description) }}</textarea>
                                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-success">重置</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            set_active_menu('global',"{{ route('admin.tag.index') }}");
            $('#description').summernote({
                height: 300,
                placeholder:true,
                toolbar:ask_editor_options.toolbar,
                codemirror:ask_editor_options.codemirror,
                onImageUpload: function(files, editor, welEditable) {
                    upload_editor_image(files[0],"description",$("#editor_token").val());
                }
            });

        });
    </script>
@endsection