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
                <li><a href="/u/dwqs/answers">回答 <span class="badge">142</span></a></li>
                <li class="active"><a href="/u/dwqs/questions">提问 <span class="badge">8</span></a></li>
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
            <h2 class="h4">2 个提问</h2>
            <div class="stream-list border-top board">
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views">
                            208<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">5月25日</p>
                        <h2 class="title">
                            <a href="/q/1010000002792328">插入 jsfiddle 的HTTPS 的URL, 不能正确识别并展示"在线预览"的功能.
                            </a>
                        </h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/segmentfault" data-toggle="popover" data-original-title="segmentfault" data-id="1040000000089399">segmentfault</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/jsfiddle" data-toggle="popover" data-original-title="jsfiddle" data-id="1040000000169634">jsfiddle</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/https" data-toggle="popover" data-original-title="https" data-id="1040000000090541">https</a></li>            </ul>
                    </div>
                </section>
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views">
                            424<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <p class="text-muted mb0">2014年11月03日</p>
                        <h2 class="title">
                            <a href="/q/1010000000754758">segmentFault 的后端开发人员在设计用户由未登录到登录之后,跳回原来所在的页面是怎么想的,怎么会有这种想法?
                            </a>
                        </h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/segmentfault" data-toggle="popover" data-original-title="segmentfault" data-id="1040000000089399">segmentfault</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E7%99%BB%E5%BD%95" data-toggle="popover" data-original-title="登录" data-id="1040000000090891">登录</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%8C%AA%E5%A4%B7%E6%89%80%E6%80%9D" data-toggle="popover" data-original-title="匪夷所思" data-id="1040000000754755">匪夷所思</a></li>            </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection