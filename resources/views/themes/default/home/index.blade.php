@extends('theme::public.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <p class="main-title hidden-xs">
                今天，你在开发时遇到了什么问题呢？
                <a id="goAsk" href="{{ route('ask.question.create') }}" class="btn btn-primary">我要提问</a>
            </p>

            <ul class="nav nav-tabs nav-tabs-zen mb10">
                <li class="active"><a href="/questions/newest">最新的</a></li>
                <li><a href="/questions/hottest">热门的</a></li>
                <li><a href="/questions/unanswered">未回答</a></li>
            </ul>

            <div class="stream-list question-stream">
                @foreach($questions as $question)
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            {{ $question->answers }}<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            {{ $question->views }}<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/yepman">YepMan</a>
                                <span class="split"></span>
                                <span class="askDate">{{ $question->created_at }}</span>
                            </li>
                        </ul>
                        <h2 class="title"><a href="{{ route('ask.question.detail',['id'=>$question->id]) }}">{{ $question->title }}</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/java" data-toggle="popover" data-original-title="java" data-id="1040000000089449">java</a></li>            </ul>
                    </div>
                </section>
                @endforeach

            </div><!-- /.stream-list -->

            <div class="text-center">
                {!! str_replace('/?', '?', $questions->render()) !!}
            </div>
        </div><!-- /.main -->
        <div class="col-xs-12 col-md-3 side mt30">
            <aside class="widget-welcome">
                <h2 class="h4 title">最专业的开发者社区</h2>
                <p>最前沿的技术问答，最纯粹的技术切磋。让你不知不觉中开拓眼界，提高技能，认识更多朋友。</p>
                <ul class="list-unstyled">
                    <li><a href="/user/oauth/google" class="3rdLogin btn btn-default btn-block btn-sn-google"><span class="icon-sn-google"></span> Google 账号登录</a></li>
                    <li><a href="/user/oauth/weibo" class="3rdLogin btn btn-default btn-block btn-sn-weibo"><span class="icon-sn-weibo"></span> 微博账号登录</a></li>
                </ul>
            </aside>









            <div class="widget-box">
                <h2 class="h4 widget-box__title">热议标签 <a href="/tags" title="更多">»</a></h2>
                <ul class="taglist--inline multi">
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript" href="/t/javascript">javascript</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089387" data-original-title="php" href="/t/php">php</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089534" data-original-title="python" href="/t/python">python</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089434" data-original-title="css" href="/t/css">css</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089442" data-original-title="ios" href="/t/ios">ios</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089658" data-original-title="android" href="/t/android">android</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089918" data-original-title="node.js" href="/t/node.js">node.js</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089409" data-original-title="html5" href="/t/html5">html5</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000090203" data-original-title="go" href="/t/go">go</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089488" data-original-title="mongodb" href="/t/mongodb">mongodb</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089431" data-original-title="redis" href="/t/redis">redis</a></li>
                    <li class="tagPopup"><a class="tag" data-toggle="popover" data-id="1040000000089556" data-original-title="程序员" href="/t/程序员">程序员</a></li>
                </ul>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box__title">最近热门的</h2>
                <ul class="widget-links list-unstyled">
                    <li class="widget-links__item">
                        <a href="/q/1010000002580638">为什么完整的移动端项目比较少？</a>
                        <small class="text-muted">
                            5 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002545549">微信支付 不允许跨号支付问题</a>
                        <small class="text-muted">
                            3 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002589542">一个没有理解面试题</a>
                        <small class="text-muted">
                            8 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002577584">Linux 内核双链表的实现太精妙了</a>
                        <small class="text-muted">
                            7 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002602574">《高性能javascript》和《javascript设计模式》这两本书怎么样？后者好像评价不好</a>
                        <small class="text-muted">
                            5 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002462719">Docker离成熟是否还很遥远?把Docker用在现实系统中的公司还很少吧?</a>
                        <small class="text-muted">
                            10 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002604023">路过的前端大大进来看看这个Jquery界面</a>
                        <small class="text-muted">
                            3 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002404545">GitHub上整理的一些工具，求补充</a>
                        <small class="text-muted">
                            7 回答                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000002593740">为了防注入，对sql查询语句加转义addslashes后，语句语法出现问题</a>
                        <small class="text-muted">
                            8 回答 | 已解决                            </small>
                    </li>
                    <li class="widget-links__item">
                        <a href="/q/1010000000250746">Android客户端如何获取php客户端验证码图片</a>
                        <small class="text-muted">
                            0 回答                            </small>
                    </li>
                </ul>
            </div>
        </div><!-- /.side -->
    </div>
@endsection