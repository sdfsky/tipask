@extends('admin/public/layout')
@section('title')编辑专家认证信息@endsection
@section('content')
    <section class="content-header">
        <h1>编辑专家认证信息</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.authentication.update',['id'=>$authentication->user_id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('real_name')) has-error @endif">
                                <label>真实姓名</label>
                                <input type="text" name="real_name" class="form-control " placeholder="真实姓名" value="{{ old('real_name',$authentication->real_name) }}">
                                @if($errors->has('real_name')) <p class="help-block">{{ $errors->first('real_name') }}</p> @endif
                            </div>

                            <div class="form-group @if($errors->has('id_card')) has-error @endif">
                                <label>身份证号码</label>
                                <input type="text" name="id_card" class="form-control " placeholder="身份证号码" value="{{ old('id_card',$authentication->id_card) }}">
                                @if($errors->has('id_card')) <p class="help-block">{{ $errors->first('id_card') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>身份证正面图片</label>
                                <input type="file" name="id_card_image" />
                                @if($authentication->id_card_image)
                                <div style="margin-top: 10px;">
                                    <img class="img-responsive" width="400" src="{{ route('website.image.show',['image_name'=>$authentication->id_card_image]) }}" />
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>所属分类</label>
                                <select name="category_id" class="form-control">
                                    <option value="0">选择分类</option>
                                    @include('admin.category.option',['type'=>'experts','select_id'=>$authentication->category_id])
                                </select>
                            </div>

                            <div class="form-group @if($errors->has('skill')) has-error @endif">
                                <label>认证领域</label>
                                <input type="text" name="skill" class="form-control " placeholder="认证领域" value="{{ old('skill',$authentication->skill) }}">
                                @if($errors->has('skill')) <p class="help-block">{{ $errors->first('skill') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>专业性证明文件</label>
                                <input type="file" name="skill_image" />
                                @if($authentication->skill_image)
                                    <div style="margin-top: 10px;">
                                        <img class="img-responsive" width="400" src="{{ route('website.image.show',['image_name'=>$authentication->skill_image]) }}" />
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="0" @if($authentication->status === 0) checked @endif /> 待审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="1" @if($authentication->status === 1) checked @endif /> 通过审核
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="4" @if($authentication->status === 4 ) checked @endif /> 审核失败
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>审核失败的原因</label>
                                <textarea class="form-control" name="failed_reason" placeholder="仅审核失败的情况下填写"></textarea>
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
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.authentication.index') }}");
    </script>
@endsection