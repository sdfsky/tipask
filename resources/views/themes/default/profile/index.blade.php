@extends('theme::profile.layout')

@section('main')
    <h2 class="h3 mt30 post-title">个人资料</h2>
    <div class="row mt30">
        <div class="col-md-3 col-md-push-9">
            <img class="avatar-128" src="//static.segmentfault.com/global/img/user-256.png" alt="头像">
            <div class="change-avatar">
                <input type="file" id="avatarFile" name="avatar" class="file hide">
                <button type="button" id="avatarBtn" class="btn btn-default btn-m mt10">修改头像</button>
                <p class="text-muted mt10">从电脑中选择图片上传, 图像大小不要超过 2 MB</p>
            </div><div class="change-avatar loading hidden">上传中</div>
        </div>
        <div class="col-md-8 col-md-pull-3">
            <form action="/api/settings/profile/edit" method="post">
                <div class="form-group">
                    <label for="name" class="required control-label col-sm-3">用户名</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" maxlength="32" placeholder="用户名唯一" class="form-control" value="自由的风" required="">
                        <span class="help-block">用户名 90 天内只能修改一次</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="setting-slug" class="required control-label col-sm-3">个性网址</label>
                    <div class="col-sm-9">
                        <input name="slug" type="text" maxlength="32" id="setting-slug" placeholder="缩略名" data-do="checkUserSlug" class="form-control setting-slug" value="sdf_sky" required="">
                        <code class="input-desc input-preview">
                            segmentfault.com/u/<strong class="preview">sdf_sky</strong>
                        </code>
                        <span class="error--slug ml10 hide">已存在</span>
                        <span class="help-block">个性网址 90 天内只能修改一次</span>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">性别</label>
                    <div class="col-sm-9">
                        <label class="radio-inline"><input name="gender" type="radio" id="sex-none" value="0"> 保密</label>
                        <label class="radio-inline"><input name="gender" type="radio" id="sex-male" value="1" checked=""> 男</label>
                        <label class="radio-inline"><input name="gender" type="radio" id="sex-female" value="2"> 女</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="setting-birthday" class="control-label col-sm-3">生日</label>
                    <div class="col-sm-9">
                        <input name="birthday" id="setting-birthday" type="text" placeholder="格式 YYYY-MM-DD" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="setting-city" class="control-label col-sm-3">所在城市</label>
                    <div class="col-sm-9">
                        <div class="typehelper" style="position: relative;"><input type="text" class="form-control" autocomplete="off" name="city" data-value="" id="setting-city" placeholder="如：杭州市" value=""><ul class="dropdown-menu" role="menu" style="display: none; width: 407px;"><li><a href="#" data-value="北京市">北京市</a></li><li><a href="#" data-value="上海市">上海市</a></li><li><a href="#" data-value="深圳市">深圳市</a></li><li><a href="#" data-value="杭州市">杭州市</a></li></ul></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="setting-address" class="control-label col-sm-3">通讯地址</label>
                    <div class="col-sm-9">
                        <input name="address" id="setting-address" type="text" maxlength="32" placeholder="详细通讯地址" class="form-control" value="">
                        <span class="help-block">此地址将用于寄送纪念品以及活动报名使用，不会公开给第三方</span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="setting-homepage" class="control-label col-sm-3">个人网站</label>
                    <div class="col-sm-9">
                        <input name="homepage" id="setting-homepage" type="url" placeholder="http://example.com" value="" class="form-control mono">
                    </div>
                </div>

                <div class="form-group">
                    <label for="setting-description" class="control-label col-sm-3">自我简介</label>
                    <div class="col-sm-9">
                        <textarea name="description" id="setting-description" class="form-control mono" rows="6"></textarea>
                    </div>
                </div>

                <div class="form-action row">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-xl btn-primary profile-sub" type="submit">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection