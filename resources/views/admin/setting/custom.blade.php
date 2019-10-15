@extends('admin/public/layout')
@section('title')功能定制@endsection
@section('content')
    <section class="content-header">
        <h1>功能定制</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header"><h3 class="box-title">问答功能设置</h3></div>
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.custom') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="answer_adopt_period">问题自动采纳时长（天）</label>
                                <span class="text-muted">(在限定时长内，如果问题没有采纳回答，则有程序按照默认策略进行采纳,0为不自动采纳，单位是天)</span>
                                <input type="text" name="answer_adopt_period" class="form-control" value="{{ Setting()->get('answer_adopt_period',0) }}" placeholder="问题自动采纳回答时长"  />
                            </div>
                            <div class="form-group">
                                <label for="answer_adopt_period">热门内容最大时长（天）</label>
                                <span class="text-muted">(根据配置动态筛选时长以内的热门问题、文章，避免长期显示相同内容)</span>
                                <input type="text" name="hot_content_period" class="form-control" value="{{ Setting()->get('hot_content_period',365) }}" placeholder="热门内容最大时长"  />
                            </div>

                            <div class="form-group">
                                <label for="website_url">开启自问自答</label>
                                <span class="text-muted">(开启后自己可以回答自己的问题)</span>
                                <div class="radio">
                                    <label><input type="radio" name="open_self_answer" value="1" @if(Setting()->get('open_self_answer','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="open_self_answer" value="0" @if(Setting()->get('open_self_answer','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="website_url">开启讨论模式</label>
                                <span class="text-muted">(开启后已解决问题也可以被回答)</span>
                                <div class="radio">
                                    <label><input type="radio" name="open_question_discuss" value="1" @if(Setting()->get('open_question_discuss','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="open_question_discuss" value="0" @if(Setting()->get('open_question_discuss','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="open_user_sign">开启签到功能</label>
                                <span class="text-muted">(开启后配合积分策略可以实现签到功能，首页会显示签到按钮)</span>
                                <div class="radio">
                                    <label><input type="radio" name="open_user_sign" value="1" @if(Setting()->get('open_user_sign','0') == 1) checked @endif > 开启 </label>
                                    <label class="ml-20"><input type="radio" name="open_user_sign" value="0" @if(Setting()->get('open_user_sign','0') != 1) checked @endif > 关闭 </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            set_active_menu('global',"{{ route('admin.setting.custom') }}");
        });
    </script>
@endsection