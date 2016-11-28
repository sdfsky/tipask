@extends('theme::layout.public')

@section('seo_title')我的私信 - {{ Setting()->get('website_name') }}@endsection

@section('css')
    <link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
    <style>
        .select2-result-repository { padding-top: 4px; padding-bottom: 3px; }
        .select2-result-repository__avatar { float: left; width: 60px; margin-right: 10px; }
        .select2-result-repository__avatar img { width: 100%; height: auto; border-radius: 2px; }
        .select2-result-repository__meta { margin-left: 70px; }
        .select2-result-repository__title { color: black; font-weight: bold; word-wrap: break-word; line-height: 1.1; margin-bottom: 4px; }
        .select2-result-repository__forks, .select2-result-repository__stargazers { margin-right: 1em; }
        .select2-result-repository__forks, .select2-result-repository__stargazers, .select2-result-repository__watchers { display: inline-block; color: #aaa; font-size: 11px; }
        .select2-result-repository__description { font-size: 13px; color: #777; margin-top: 4px; }
        .select2-results__option--highlighted .select2-result-repository__title { color: white; }
        .select2-results__option--highlighted .select2-result-repository__forks, .select2-results__option--highlighted .select2-result-repository__stargazers, .select2-results__option--highlighted .select2-result-repository__description, .select2-results__option--highlighted .select2-result-repository__watchers { color: #c6dcef; }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">
                我的私信
                <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#send_message_model" >写消息</button>
            </h2>
            <div class="widget-streams messages">
                @foreach($messages as $message)
                <section id="session_{{ $message->from_user_id }}" class="hover-show streams-item @if($message->is_read===0) not_read @endif ">
                    <div class="stream-wrap media">
                        <div class="pull-left">
                            <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}" >
                                <img class="media-object avatar-40" src="{{ get_user_avatar($message->from_user_id) }}" alt="{{ $message->fromUser->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}"> {{ $message->fromUser->name }}</a> :
                            <div class="full-text fmt">{{ $message->content }}</div>
                            <div class="meta mt-10">
                                <span class="text-muted">{{ timestamp_format($message->created_at) }}</span>
                                <span class="pull-right">
                                    <a href="{{ route('auth.message.show',['use_id'=>$message->from_user_id]) }}">查看对话详情</a> <span class="span-line">|</span>
                                    <a href="javascript:void(0)" class="text-muted" onclick="delete_session({{ $message->from_user_id }})">删除</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
             @endforeach
            </div>
            <div class="text-center">
                {!! str_replace('/?', '?', $messages->render()) !!}

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection

@section('script')

    <div class="modal fade" id="send_message_model"  role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">发送私信</h4>
                </div>
                <div class="modal-body">
                    <form name="messageForm" id="message_form">
                        <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="to_user_id" class="control-label">发给:</label>
                            <select  id="select_message_user" name="to_user_id"></select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">内容:</label>
                            <textarea class="form-control" id="message-text" name="content"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="message_submit_button">发送</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>

    <script type="text/javascript">

        function formatRepo (repo) {
            if (repo.loading) return repo.name;

            var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='"+repo.avatar+"' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.name + "</div>";

            if (repo.title) {
                markup += "<div class='select2-result-repository__description'>" + repo.title + "</div>";
            }

            markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'>"+ repo.coins +" 金币</div>" +
                    "<div class='select2-result-repository__stargazers'>"+ repo.followers +" 粉丝</div>" +
                    "<div class='select2-result-repository__watchers'>"+ repo.answers +" 回答</div>" +
                    "</div>" +
                    "</div></div>";

            return markup;
        }

        function formatRepoSelection (repo) {
            return repo.name || repo.name;
        }



        $(function(){

            $("#select_message_user").select2({
                theme:'bootstrap',
                placeholder: "搜索用户",
                ajax: {
                    url: "/ajax/loadUsers",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            word: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });



            $("#message_submit_button").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('auth.message.store') }}",
                    data: $('#message_form').serialize(),
                    success: function(msg){
                        alert('消息发送成功');
                        $("#send_message_model").modal('hide');
                    },
                    error: function(){
                        alert("发送失败！");
                    }
                });
            });



        });

        function delete_session(from_user_id)
        {
            if(!confirm('确认删除该信息？')){
                return false;
            }

            $.get('/message/destroySession/'+from_user_id,function(msg){
                if(msg === 'ok'){
                    $("#session_"+from_user_id).remove();
                }else{
                    alert('操作失败，请稍后再试！');
                }
            });

        }
    </script>
@endsection