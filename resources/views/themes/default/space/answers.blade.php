@extends('theme::public.layout')
@section('css')
    <link href="{{ asset('/css/default/space.css')}}" rel="stylesheet">

@endsection

@section('space_header')
    <header class="bg-gray pt30">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-header media">
                        <a class="pull-left" href="/u/dwqs"><img class="media-object avatar-128" src="http://sfault-avatar.b0.upaiyun.com/402/690/4026901954-54aa510660a3d_huge256" alt="不写代码的码农"></a>
                        <div class="media-body">
                            <h4 class="media-heading">不写代码的码农</h4>
                            <ul class="sn-inline">
                                <li>时间的流逝</li>
                                <li>测试提问</li>
                                <li>hello</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <ul class="list-unstyled profile-links">
                        <li>所在城市：广州市</li>

                        <li>现任职位：<a href="/t/%E5%A4%A9%E6%9C%9D">天朝</a> 前端打杂工</li>

                        <li>院校专业：蓝翔 挖掘机炒菜</li>

                        <li>个人网站：<a href="http://www.ido321.com" target="_blank">http://www.ido321.com</a></li>
                    </ul>
                </div>
                <div class="text-right col-md-3">
                    <p class="mt30">
                        <strong><a class="funsCount" href="/u/dwqs/followed/users">23</a></strong> 个粉丝
                        <button type="button" class="btn btn-success ml10 userfollow" data-id="1030000000691249" data-refresh="true" data-callback="true">加关注</button>
                    </p>
                    <p>
                        <a href="/u/pandacoder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="PandaCoder"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/182/764/1827641216-55025285f24d9_small"></a>
                        <a href="/u/lidongtong" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="李栋同學"><img class="avatar-24" src="//static.segmentfault.com/global/img/user-32.png"></a>
                        <a href="/u/helloqingfeng" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="helloqingfeng"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/364/475/3644757698-554e3047062d6_small"></a>
                        <a href="/u/trigkit4" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="trigkit4"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/550/538/550538601-54b5303a2d493_small"></a>
                        <a href="/u/lionclock" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="莱恩克罗克"><img class="avatar-24" src="//static.segmentfault.com/global/img/user-32.png"></a>
                        <a href="/u/cruise" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cruise_Chan"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/932/946/932946215-547ca60913979_small"></a>
                        <a href="/u/genhao" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="严爬爬"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/132/687/1326875111-553f26f3e212d_small"></a>
                        <a href="/u/xueit1989" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="xueit"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/369/057/3690577844-5538c116c7a19_small"></a>
                    </p>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-4 profile">
            <ul class="list-unstyled profile-ranks">
                <li>
                    <a href="/u/dwqs/rank">
                        <strong>2171</strong>
                        <span class="text-muted">声望值</span>
                    </a>
                </li>
                <li>
                    <strong>0</strong>
                    <span class="text-muted">枚徽章</span>
                </li>
                <li class="">
                    <strong>114</strong>
                    <span class="text-muted">次被赞</span>
                </li>
            </ul>
            <ul class="rep-rects clearfix">
                <li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-01"></li>
            </ul>
            <div class="profile-bio mono">

                <p>久艾网：<a rel="nofollow" href="http://blog.92fenxiang.com/">http://blog.92fenxiang.com/</a></p>

            </div>
            <div class="profile-goodjob" id="goodJob" data-id="1030000000691249">
                <strong>擅长标签</strong>
                <div id="piechart" class="clearfix"><svg height="200" version="1.1" width="308" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: 0.5px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="#59bb0c" stroke="#ffffff" d="M76,100L34.77906565963164,43.42408134102424A70,70,0,0,1,117.22093434036839,43.42408134102426Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#7edb35" stroke="#ffffff" d="M76,100L117.22093434036839,43.42408134102426A70,70,0,0,1,145.33333498479396,90.36212368380126Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#62e65d" stroke="#ffffff" d="M76,100L145.33333498479396,90.36212368380126A70,70,0,0,1,132.1347684230202,141.81970557158306Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#c4ed68" stroke="#ffffff" d="M76,100L132.1347684230202,141.81970557158306A70,70,0,0,1,90.91607905532666,168.3923284120028Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#e2ff9e" stroke="#ffffff" d="M76,100L90.91607905532666,168.3923284120028A70,70,0,0,1,51.33257489937894,165.50967973441215Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#f0f2dd" stroke="#ffffff" d="M76,100L51.33257489937894,165.50967973441215A70,70,0,0,1,21.397538636671136,143.80149784044124Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#d7f6a0" stroke="#ffffff" d="M76,100L21.397538636671136,143.80149784044124A70,70,0,0,1,10.671372400198422,125.14299934229095Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#5de6a9" stroke="#ffffff" d="M76,100L10.671372400198422,125.14299934229095A70,70,0,0,1,6.495963842101162,108.31799000729696Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#a0d2f6" stroke="#ffffff" d="M76,100L6.495963842101162,108.31799000729696A70,70,0,0,1,6.223689169448392,94.40835919624249Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#80def0" stroke="#ffffff" d="M76,100L6.223689169448392,94.40835919624249A70,70,0,0,1,8.060821032485734,83.13975204156039Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#666666" stroke="#ffffff" d="M76,100L8.060821032485734,83.13975204156039A70,70,0,0,1,34.779065659631655,43.42408134102424Z" stroke-width="1" stroke-linejoin="round" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round;"></path><path fill="#000000" stroke="none" d="M76,100L34.77906565963164,43.42408134102424A70,70,0,0,1,117.22093434036839,43.42408134102426Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L117.22093434036839,43.42408134102426A70,70,0,0,1,145.33333498479396,90.36212368380126Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L145.33333498479396,90.36212368380126A70,70,0,0,1,132.1347684230202,141.81970557158306Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L132.1347684230202,141.81970557158306A70,70,0,0,1,90.91607905532666,168.3923284120028Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L90.91607905532666,168.3923284120028A70,70,0,0,1,51.33257489937894,165.50967973441215Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L51.33257489937894,165.50967973441215A70,70,0,0,1,21.397538636671136,143.80149784044124Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L21.397538636671136,143.80149784044124A70,70,0,0,1,10.671372400198422,125.14299934229095Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L10.671372400198422,125.14299934229095A70,70,0,0,1,6.495963842101162,108.31799000729696Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L6.495963842101162,108.31799000729696A70,70,0,0,1,6.223689169448392,94.40835919624249Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L6.223689169448392,94.40835919624249A70,70,0,0,1,8.060821032485734,83.13975204156039Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="#000000" stroke="none" d="M76,100L8.060821032485734,83.13975204156039A70,70,0,0,1,34.779065659631655,43.42408134102424Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><circle cx="165" cy="110" r="5" fill="#59bb0c" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="110" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.25" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20.0% - javascript</tspan></text><circle cx="165" cy="126.2" r="5" fill="#7edb35" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="126.2" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687500000003" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">12.8% - css</tspan></text><circle cx="165" cy="142.41875" r="5" fill="#62e65d" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="142.41875" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">12.4% - php</tspan></text><circle cx="165" cy="158.6375" r="5" fill="#c4ed68" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="158.6375" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">11.4% - jquery</tspan></text><circle cx="165" cy="174.85625" r="5" fill="#e2ff9e" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="174.85625" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">9.1% - html</tspan></text><circle cx="165" cy="191.075" r="5" fill="#f0f2dd" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="191.075" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">8.5% - css3</tspan></text><circle cx="165" cy="207.29375" r="5" fill="#d7f6a0" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="207.29375" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4.9% - java</tspan></text><circle cx="165" cy="223.5125" r="5" fill="#5de6a9" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="223.5125" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4.0% - python</tspan></text><circle cx="165" cy="239.73125" r="5" fill="#a0d2f6" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="239.73125" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3.2% - html5</tspan></text><circle cx="165" cy="255.95" r="5" fill="#80def0" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="255.95" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2.6% - web前端开发</tspan></text><circle cx="165" cy="272.16875" r="5" fill="#666666" stroke="none" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,-87.8438)"></circle><text x="180" y="272.16875" text-anchor="start" font="12px Arial, sans-serif" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial, sans-serif;" transform="matrix(1,0,0,1,0,-87.8438)"><tspan dy="4.254687499999989" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">11.1% - 其他</tspan></text></svg></div>
                <div class="joindate">
                    始于 2014年09月24日
                    <a href="#911" data-id="1030000000691249" data-toggle="modal" data-target="#911" data-type="user" data-typetext="用户" class="pull-right">举报</a>
                </div>
            </div>
        </div>

        <!-- Nav tabs -->
        <div class="col-md-8">
            <ul class="nav nav-pills">
                <li><a href="/u/dwqs">动态</a></li>
                <li  class="active"><a href="/u/dwqs/answers">回答 <span class="badge">142</span></a></li>
                <li><a href="/u/dwqs/questions">提问 <span class="badge">8</span></a></li>
                <li><a href="/u/dwqs/bookmarks">收藏</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        关注的 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/u/dwqs/following/tags">关注的标签 <span class="badge">22</span></a></li>
                    </ul>
                </li>

            </ul>
            <h2 class="h4">313 个回答</h2>
            <div class="stream-list board border-top">
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">3 分钟前</p>
                        <h2 class="title"><a href="/q/1010000003925881/a-1020000003926619">php 页面输出为什么换行符丢失了?</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/html" data-toggle="popover" data-original-title="html" data-id="1040000000089571">html</a></li>            </ul>
                        <p class="text-muted mb0">说明 PHP 在解析 php 文件时 结束符 (?&gt;) 后面如果是换行符, 会被忽略掉. 如果你想产生一个新行, 需要再多按一下回车.</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 小时前</p>
                        <h2 class="title"><a href="/q/1010000003925838/a-1020000003925874">switch语句的多次调用问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/switch%E8%AF%AD%E5%8F%A5" data-toggle="popover" data-original-title="switch语句" data-id="1040000002603107">switch语句</a></li>            </ul>
                        <p class="text-muted mb0">{代码...}</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            3<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">6 小时前</p>
                        <h2 class="title"><a href="/q/1010000003924218/a-1020000003924394">javascript如何把字母简单的转化成它对应的ASCII值？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                        <p class="text-muted mb0">https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charCodeAt 基于以上特性, 可以采用下面这样的代码得到. {代码...} 需要注意的是js中的 charCodeAt 返回的是字符所对...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            2<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">7 小时前</p>
                        <h2 class="title"><a href="/q/1010000003923921/a-1020000003924087">segment的图片上传是怎么做的？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/html" data-toggle="popover" data-original-title="html" data-id="1040000000089571">html</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/html5" data-toggle="popover" data-original-title="html5" data-id="1040000000089409">html5</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-original-title="jquery" data-id="1040000000089733">jquery</a></li>            </ul>
                        <p class="text-muted mb0">以下代码提取于该URL中: http://static.segmentfault.com/build/qa/js/question.d1d9f672.js 一个普通的 &lt;input type="file"&gt; 控件, 设置宽的透明度和层级, 让它挡到 选择图片, 这样在点它的时候, 是先点到...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">8 小时前</p>
                        <h2 class="title"><a href="/q/1010000003922647/a-1020000003923364">php嵌入html script标签内的问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                        <p class="text-muted mb0">好像楼上两位 @b9132 @kevins1022 没有理解楼主的问题所在. 楼主的问题是 $data 变量中有很多行, 即有换行符, 然后如果直接输出的话, 会在JS的代码块中出现换行,然后会产生JS错误.类似于这样: {代码...} 所以比较...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">18 小时前</p>
                        <h2 class="title"><a href="/q/1010000003922580/a-1020000003922599">node serve 关闭  再启动 </a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/node" data-toggle="popover" data-original-title="node" data-id="1040000003033284">node</a></li>            </ul>
                        <p class="text-muted mb0">按 Ctrl+C 不要按 Ctrl+Z.</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">18 小时前</p>
                        <h2 class="title"><a href="/q/1010000003922462/a-1020000003922498">JS闭包中元素驻留问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                        <p class="text-muted mb0">你的第二种情况就像下面这样: {代码...} 第一种就像下面这样: {代码...} 把你的问题简化之后, 希望你能明白过来, 为什么第一种会出错. 其实在你提供的代码里的 onclick 事件中, 使用 this.innerHTML 就可以得到你...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            2<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">20 小时前</p>
                        <h2 class="title"><a href="/q/1010000003921752/a-1020000003921782">python re和urllib的使用问题。</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/python2.7" data-toggle="popover" data-original-title="python2.7" data-id="1040000000734508">python2.7</a></li>            </ul>
                        <p class="text-muted mb0">我不知道你为什么会选择用Python来做, 我想你既然用Python了,至少得懂一点Python脚本吧. {代码...} 故你要输入的验证码字符是来自于 code.gif 这个文件中的, 不是你自己通过浏览器单独打开 验证码图片的URL 里的...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">1 天前</p>
                        <h2 class="title"><a href="/q/1010000003919891/a-1020000003920004">jquery如何在当前页面 单击手机找回按钮 把父元素hidden，再去掉手机步骤(2)的hidden?</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-original-title="jquery" data-id="1040000000089733">jquery</a></li>            </ul>
                        <p class="text-muted mb0">设定 .forget_main 默认为不可见. 设置 .forget_main.show 为可见状态. jQuery 通过 .forget_main.show 找到当前显示的这个, 然后根据需要决定是用 next/prev 来找它下一个/上一个节点, 然后切换样式, 实现显示/...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">1 天前</p>
                        <h2 class="title"><a href="/q/1010000003919398/a-1020000003919448">JQuery deferred 传递参数问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-original-title="jquery" data-id="1040000000089733">jquery</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/jquery-ajax" data-toggle="popover" data-original-title="jquery-ajax" data-id="1040000000090672">jquery-ajax</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/ajax" data-toggle="popover" data-original-title="ajax" data-id="1040000000090169">ajax</a></li>            </ul>
                        <p class="text-muted mb0">{代码...} 根据你评论里的要求, 你应该这么做: {代码...} 运行效果: 再次更新: {代码...}</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">1 天前</p>
                        <h2 class="title"><a href="/q/1010000003917518/a-1020000003917669">js数组分割代码优化（如下代码），求改进优化或更高效算法</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E4%BA%8C%E7%BB%B4%E6%95%B0%E7%BB%84" data-toggle="popover" data-original-title="二维数组" data-id="1040000000600621">二维数组</a></li>            </ul>
                        <p class="text-muted mb0">{代码...} 运行结果: {代码...}</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">1 天前</p>
                        <h2 class="title"><a href="/q/1010000003916643/a-1020000003916661">获取不到ajax数据 </a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-original-title="jquery" data-id="1040000000089733">jquery</a></li>            </ul>
                        <p class="text-muted mb0">你 2.php 输出的内容是什么? 更新:根据你提供的代码得到的结果: {代码...} 完整代码:test.html {代码...} 2.php 就是你提供的代码. 注意: 这两个文件保存时的编码都为 UTF-8 得出结论为: 根据你目前提供的代码, ...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">1 天前</p>
                        <h2 class="title"><a href="/q/1010000003916166/a-1020000003916193">登陆知乎验证码问题？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/python2.7" data-toggle="popover" data-original-title="python2.7" data-id="1040000000734508">python2.7</a></li>            </ul>
                        <p class="text-muted mb0">是否需要验证码是在seclogin中给出的, 你检测你获取的 首页的内容有什么用嘛? 还有为什么不按我说的方法做呢? 不管要不要, 直接获取验证码, 然后一块提交就行了. 你目前这样做, 要先提交一次登陆, 然后再判断要不...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 天前</p>
                        <h2 class="title"><a href="/q/1010000003915057/a-1020000003915095">python模拟登陆知乎遇到的forbidden问题？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/python2.7" data-toggle="popover" data-original-title="python2.7" data-id="1040000000734508">python2.7</a></li>            </ul>
                        <p class="text-muted mb0">请参考这个: http://segmentfault.com/q/1010000003855057和你一样的问题. {代码...}</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 天前</p>
                        <h2 class="title"><a href="/q/1010000003914468/a-1020000003914933">js判断数组最大值的原理是什么求解？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                        <p class="text-muted mb0">代码 + 注释: {代码...} 运行结果:</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 天前</p>
                        <h2 class="title"><a href="/q/1010000003913255/a-1020000003914120">file_get_contents 下载一张20K的图片资源特别慢，怎么解决</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li>            </ul>
                        <p class="text-muted mb0">$url 这一行上面增加 ini_set('default_socket_timeout', 1); 设置一下 默认超时时间. 你所请求的这个图片, 对方的服务器支持 Connection: keep-alive, 所以 PHP 在接收到数据之后, 维持了一段时间, 一直等到超时...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 天前</p>
                        <h2 class="title"><a href="/q/1010000003913603/a-1020000003913618">请教一下ftp自动下载脚本的问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/linux" data-toggle="popover" data-original-title="linux" data-id="1040000000089392">linux</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/ftp" data-toggle="popover" data-original-title="ftp" data-id="1040000000089893">ftp</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/shell" data-toggle="popover" data-original-title="shell" data-id="1040000000089669">shell</a></li>            </ul>
                        <p class="text-muted mb0">你先试一下你的系统里有没有这个工具 dos2unix. 如果没有的话通过这条命令安装一个: sudo apt-get install dos2unix -y (如果你的系统不是 debian 系的系统的话, 包管理软件可能不是 apt, 请使用相应的包管理软件...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2 天前</p>
                        <h2 class="title"><a href="/q/1010000003911136/a-1020000003911362">Nodejs发送POST请求</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/node.js" data-toggle="popover" data-original-title="node.js" data-id="1040000000089918">node.js</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/post" data-toggle="popover" data-original-title="post" data-id="1040000000206133">post</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%BE%AE%E4%BF%A1%E5%85%AC%E4%BC%97%E5%B9%B3%E5%8F%B0" data-toggle="popover" data-original-title="微信公众平台" data-id="1040000000189880">微信公众平台</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                        <p class="text-muted mb0">querystring.stringify 改为 JSON.stringify 'Content-Type' : 'application/x-www-form-urlencoded', 改为 'Content-Type' : 'application/json',. 因为没有申请过, 所以没有 token 没办法试, 如果按上面的改了,...</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            3<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">3 天前</p>
                        <h2 class="title"><a href="/q/1010000003909924/a-1020000003910058">js 如何对html已注册的事件进行拦截</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/event" data-toggle="popover" data-original-title="event" data-id="1040000000090581">event</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/interceptor" data-toggle="popover" data-original-title="interceptor" data-id="1040000003909894">interceptor</a></li>            </ul>
                        <p class="text-muted mb0">提供一种方法, 代码如下: {代码...} 如果需要原生的请将jQuery中相应的方法改为原生对应的代码即可. 但上面的方法有一些缺陷, 并不完美, 只是提供一种思路, 期待其他高手更高明的回复.</p>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus">
                            1<small>投票</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">3 天前</p>
                        <h2 class="title"><a href="/q/1010000003909862/a-1020000003910030">移动端，requirejs该不该用Rjs压缩</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/require.js" data-toggle="popover" data-original-title="require.js" data-id="1040000002576820">require.js</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/r" data-toggle="popover" data-original-title="r" data-id="1040000000090211">r</a></li>            </ul>
                        <p class="text-muted mb0">共同的文件/代码合并为一个文件, 然后通过script标签引入. 根据你的描述, 你的 jQuery 做为各页面中共用的代码, 不需要与其他页面中单独使用到的JS进行合并. A 页面只加载 jQuery 和 A页面 中使用到的JS代码,B 页...</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection