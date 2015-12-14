@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4 mt0 mb20">
                我的通知
                <button type="button" class="btn btn-default btn-xs ingore-all ml10">全部标记为已读</button>
            </h2>
            <div class="stream-list notify-stream border-top">


                <section class="stream-list__item">
                    <i class="fa fa-fw fa-comment-o"></i>
                    <a href="/u/lorry">盯着小萝莉发呆</a> 回答了问题
                    <a href="/q/1010000004077763?_ea=481369" target="_blank">（已解决）C语言中“按位运算”的应用都有哪些？</a>
                    <span class="text-muted ml-10">2015-12-3 17:02</span>

                </section>
                <section class="stream-list__item viewed">
                    <a href="/u/yujilala">愚吉啦啦</a>, <a href="/u/parcelable">parcelable</a>, <a href="/u/lorry">盯着小萝莉发呆</a> 回答了问题

                    <a href="/q/1010000004077763?_ea=481369" target="_blank">（已解决）C语言中“按位运算”的应用都有哪些？</a>

                </section>
                <section class="stream-list__item viewed">
                    <a href="/u/yujilala">愚吉啦啦</a>, <a href="/u/parcelable">parcelable</a>, <a href="/u/lorry">盯着小萝莉发呆</a> 回答了问题

                    <a href="/q/1010000004077763?_ea=481369" target="_blank">（已解决）C语言中“按位运算”的应用都有哪些？</a>

                </section>
                <section class="stream-list__item viewed">
                    <a href="/u/imingyu">imingyu</a>, <a href="/u/xwartz">xwartz</a>, <a href="/u/yangbo">看不懂未来</a> 回答了问题

                    <a href="/q/1010000004020628?_ea=460045" target="_blank">想问下前端需要考虑的兼容性浏览器有哪些？</a>

                </section>

            </div><!-- /.stream-list -->

            <div class="text-center">

            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection