@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">
                我的私信
                <a href="{{ route('auth.notification.readAll') }}" class="btn btn-primary btn-xs pull-right">写消息</a>
            </h2>
            <div class="widget-streams messages">

                <section class="hover-show streams-item">
                    <div class="stream-wrap media">
                        <div class="pull-left">
                            <a href="http://www.tipaskx.com/people/2" target="_blank">
                                <img class="media-object avatar-40" src="http://www.tipaskx.com/image/avatar/2_middle" alt="胡淼">
                            </a>
                        </div>
                        <div class="media-body">
                            <a target="_blank" href="http://www.tipaskx.com/people/2"> 胡淼</a> :
                            <div class="full-text fmt">
                                说道苦心经营人脉，牛魔王的人脉虽广，孙猴子的人脉可也不窄啊。而且境界明显更高一个层级。其实满天神佛对猴子的印象都不差，在天庭当差的时候，猴子可是交了不少朋友的。牛魔王为啥最后输给猴子，实力两者差不多，输就输在人脉上。另说一下擒拿牛魔王的过程，其实牛魔王真心是个人才，所以一直在活捉而从没考虑干死他。这...
                            </div>
                            <div class="meta mt-10">
                                <span class="text-muted">3小时前</span>
                                <span class="pull-right">
                                    <a href="#">共 1 条对话</a> <span class="span-line">|</span>
                                    <a href="javascript:;" class="text-muted" onclick="#">删除</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="text-center">
            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection