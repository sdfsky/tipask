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
                                <li><a href="http://weibo.com/rebgin" class="icon-sn-weibo" target="_blank"></a></li><li><a href="https://github.com/dwqs" class="icon-sn-github" target="_blank"></a></li><li><a href="javascript:void(0);" class="icon-sn-qq" target="_blank"></a></li>                        </ul>
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
                <li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-01"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-02"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-03-03"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-04"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-05"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-03-06"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-07"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-08"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-03-09"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-10"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-11"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-03-12"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-13"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-14"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-15"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-16"></li><li class="rect bg-green" style="opacity: 0.53072625698324" title="" data-original-title="+11 声望<br>2015-03-17"></li><li class="rect bg-green" style="opacity: 0.52793296089385" title="" data-original-title="+10 声望<br>2015-03-18"></li><li class="rect bg-green" style="opacity: 0.55307262569832" title="" data-original-title="+19 声望<br>2015-03-19"></li><li class="rect bg-green" style="opacity: 0.72067039106145" title="" data-original-title="+79 声望<br>2015-03-20"></li><li class="rect bg-green" style="opacity: 0.57262569832402" title="" data-original-title="+26 声望<br>2015-03-21"></li><li class="rect bg-green" style="opacity: 0.56145251396648" title="" data-original-title="+22 声望<br>2015-03-22"></li><li class="rect bg-green" style="opacity: 0.51675977653631" title="" data-original-title="+6 声望<br>2015-03-23"></li><li class="rect bg-green" style="opacity: 0.50837988826816" title="" data-original-title="+3 声望<br>2015-03-24"></li><li class="rect bg-green" style="opacity: 0.51675977653631" title="" data-original-title="+6 声望<br>2015-03-25"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-26"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-03-27"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-28"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-03-29"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-03-30"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-03-31"></li><li class="rect bg-green" style="opacity: 0.55865921787709" title="" data-original-title="+21 声望<br>2015-04-01"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-04-02"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-04-03"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-04-04"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-04-05"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-04-06"></li><li class="rect bg-green" style="opacity: 0.6340782122905" title="" data-original-title="+48 声望<br>2015-04-07"></li><li class="rect bg-green" style="opacity: 0.70111731843575" title="" data-original-title="+72 声望<br>2015-04-08"></li><li class="rect bg-green" style="opacity: 0.5391061452514" title="" data-original-title="+14 声望<br>2015-04-09"></li><li class="rect bg-green" style="opacity: 0.50837988826816" title="" data-original-title="+3 声望<br>2015-04-10"></li><li class="rect bg-green" style="opacity: 0.56424581005587" title="" data-original-title="+23 声望<br>2015-04-11"></li><li class="rect bg-green" style="opacity: 0.50837988826816" title="" data-original-title="+3 声望<br>2015-04-12"></li><li class="rect bg-green" style="opacity: 0.51396648044693" title="" data-original-title="+5 声望<br>2015-04-13"></li><li class="rect bg-green" style="opacity: 0.51117318435754" title="" data-original-title="+4 声望<br>2015-04-14"></li><li class="rect bg-green" style="opacity: 0.50837988826816" title="" data-original-title="+3 声望<br>2015-04-15"></li><li class="rect bg-green" style="opacity: 0.52513966480447" title="" data-original-title="+9 声望<br>2015-04-16"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-04-17"></li><li class="rect bg-gray" title="" data-original-title="没有获得声望<br>2015-04-18"></li><li class="rect bg-green" style="opacity: 0.54469273743017" title="" data-original-title="+16 声望<br>2015-04-19"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-04-20"></li><li class="rect bg-green" style="opacity: 0.51117318435754" title="" data-original-title="+4 声望<br>2015-04-21"></li><li class="rect bg-green" style="opacity: 0.62849162011173" title="" data-original-title="+46 声望<br>2015-04-22"></li><li class="rect bg-green" style="opacity: 0.51117318435754" title="" data-original-title="+4 声望<br>2015-04-23"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-04-24"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-04-25"></li><li class="rect bg-green" style="opacity: 0.50279329608939" title="" data-original-title="+1 声望<br>2015-04-26"></li><li class="rect bg-green" style="opacity: 0.56145251396648" title="" data-original-title="+22 声望<br>2015-04-27"></li><li class="rect bg-green" style="opacity: 0.5391061452514" title="" data-original-title="+14 声望<br>2015-04-28"></li><li class="rect bg-green" style="opacity: 0.5195530726257" title="" data-original-title="+7 声望<br>2015-04-29"></li><li class="rect bg-green" style="opacity: 0.55307262569832" title="" data-original-title="+19 声望<br>2015-04-30"></li><li class="rect bg-green" style="opacity: 0.59776536312849" title="" data-original-title="+35 声望<br>2015-05-01"></li><li class="rect bg-green" style="opacity: 0.50558659217877" title="" data-original-title="+2 声望<br>2015-05-02"></li><li class="rect bg-green" style="opacity: 0.66480446927374" title="" data-original-title="+59 声望<br>2015-05-03"></li><li class="rect bg-green" style="opacity: 0.79888268156425" title="" data-original-title="+107 声望<br>2015-05-04"></li><li class="rect bg-green" style="opacity: 0.77932960893855" title="" data-original-title="+100 声望<br>2015-05-05"></li><li class="rect bg-green" style="opacity: 0.6731843575419" title="" data-original-title="+62 声望<br>2015-05-06"></li><li class="rect bg-green" style="opacity: 0.75698324022346" title="" data-original-title="+92 声望<br>2015-05-07"></li><li class="rect bg-green" style="opacity: 0.95251396648045" title="" data-original-title="+162 声望<br>2015-05-08"></li><li class="rect bg-green" style="opacity: 0.58938547486034" title="" data-original-title="+32 声望<br>2015-05-09"></li><li class="rect bg-green" style="opacity: 1" title="" data-original-title="+179 声望<br>2015-05-10"></li><li class="rect bg-green" style="opacity: 0.81005586592179" title="" data-original-title="+111 声望<br>2015-05-11"></li>                </ul>
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
                <li class="active"><a href="/u/dwqs">动态</a></li>
                <li><a href="/u/dwqs/rank">声望</a></li>
                <li><a href="/u/dwqs/tags">标签</a></li>
                <li><a href="/u/dwqs/answers">回答 <span class="badge">142</span></a></li>
                <li><a href="/u/dwqs/questions">提问 <span class="badge">8</span></a></li>
                <li><a href="/u/dwqs/blogs">专栏文章 <span class="badge">45</span></a></li>
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
            <h2 class="h4">最近动态</h2>
            <div class="widget-active clearfix">

                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">8 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002756831/a-1020000002756974">在sublime text里， 如何让emmet生成的带前缀css属性垂直对齐？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/emmet" data-toggle="popover" data-id="1040000000597075" data-original-title="emmet">emmet</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/css3" data-toggle="popover" data-id="1040000000090141" data-original-title="css3">css3</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            emmet本身没有提供这种设置：preferences 你可以试试这个插件：alignment
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">12 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 3
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002753884/a-1020000002756060">JS获取上一个页面的URL</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            考虑用一下HTML 5的API来改变历史记录：操纵浏览器的历史记录
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">12 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002754751/a-1020000002756049">如何使用脚本建立crontab任务？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/crontab" data-toggle="popover" data-id="1040000000204319" data-original-title="crontab">crontab</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/linux" data-toggle="popover" data-id="1040000000089392" data-original-title="linux">linux</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/linux%E8%BF%90%E7%BB%B4" data-toggle="popover" data-id="1040000000664856" data-original-title="linux运维">linux运维</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E8%87%AA%E5%8A%A8%E5%8C%96%E8%BF%90%E7%BB%B4" data-toggle="popover" data-id="1040000000497518" data-original-title="自动化运维">自动化运维</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            linux定时运行命令脚本——crontab
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">12 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002755964/a-1020000002756024">PHP写代码直接处理MySQL中的大量数据，卡死</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-id="1040000000089387" data-original-title="php">php</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/mysql" data-toggle="popover" data-id="1040000000089439" data-original-title="mysql">mysql</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            这种情况，大部分应该是SQL语句性能问题造成的，你可以尝试优化一下你的sql,附上一篇文章：MySQL性能优...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">12 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                            <span class="pull-right badge green">+1</span>
                        </p>
                        <div class="widget-active--right__title">
                            <span class="label label-success pull-left mr5">采纳</span>
                            <h4><a href="/q/1010000002755905/a-1020000002755983">当页面向下滚动时，单击一个小图片，那个大图片就在上面了。没有按中间正常显示。</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-id="1040000000117807" data-original-title="web前端开发">web前端开发</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            你想要的是这种效果吗？https://jsfiddle.net/dwqs/14gxgsjc/ 你可以把弹出层改为position:fixed试试
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">13 小时前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 2
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002755859/a-1020000002755874">微信图文编辑器</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%BE%AE%E4%BF%A1%E5%85%AC%E4%BC%97%E5%B9%B3%E5%8F%B0" data-toggle="popover" data-id="1040000000189880" data-original-title="微信公众平台">微信公众平台</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/thinkphp" data-toggle="popover" data-id="1040000000090482" data-original-title="thinkphp">thinkphp</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            选择单图文或多图文消息 有一些第三方微信图文编辑 135易点 去网上找找 网上应该有类似的
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002753160/a-1020000002753217">现在做网站是否还需要考虑禁用javascript的情况呢？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            如果还要考虑这个 那是不是还要考虑用户有没有电脑 有电脑的有没有网络 有网络的速度快不快 能不能访问...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 15
                            <span class="pull-right badge green">+1</span>
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002753188/a-1020000002753193">jquery的这个this.find(":not(:has(:first))")什么意思？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-id="1040000000089733" data-original-title="jquery">jquery</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E9%80%89%E6%8B%A9%E5%99%A8" data-toggle="popover" data-id="1040000002753185" data-original-title="选择器">选择器</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            :has(:first)用于获取子元素中运用:first伪类的父元素 :not(selector)则用于排除和selector匹配的元素 :...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <span class="label label-success pull-left mr5">采纳</span>
                            <h4><a href="/q/1010000002745994/a-1020000002753166">css小问题</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/css" data-toggle="popover" data-id="1040000000089434" data-original-title="css">css</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            CSS:权重和层叠规则决定了其优先级,按照权重的计算规则， {代码...} 其权重是0.0.1.2(12) {代码...} 其...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 5
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002753016/a-1020000002753149">知乎、segmentfault为了方便美观，图片就缩小了。当用户想单击这个较小的图片时就变大起来了。这是什么原理？不会跳到新窗口</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/web" data-toggle="popover" data-id="1040000000089794" data-original-title="web">web</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            准备一张大图和小图，点击小图时，将src替换成大图的url或者改变小图的大小
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 2
                            <span class="pull-right badge green">+3</span>
                        </p>
                        <div class="widget-active--right__title">
                            <span class="label label-success pull-left mr5">采纳</span>
                            <h4><a href="/q/1010000002752727/a-1020000002753039">还有一年毕业，有一些问题，求过来人解答</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E6%AF%95%E4%B8%9A%E7%94%9F" data-toggle="popover" data-id="1040000002752704" data-original-title="毕业生">毕业生</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            个人觉得，题主没有必要去参加培（坑）训（人）。我也是大3，学校号称中医院校中的哈佛（非985,211的一...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                            <span class="pull-right badge green">+2</span>
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002752058/a-1020000002752834">svg和css做同样的效果哪个比较合适</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/html" data-toggle="popover" data-id="1040000000089571" data-original-title="html">html</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            CSS动画优缺点 优点： 简单、高效 声明式的 不依赖与主线程，采用硬件加速（GPU） 简单的控制keyframe a...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002745424/a-1020000002752720">html5 input datetime为什么调不出来日历控件？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/html5" data-toggle="popover" data-id="1040000000089409" data-original-title="html5">html5</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-id="1040000000117807" data-original-title="web前端开发">web前端开发</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            {代码...} demo:https://jsfiddle.net/dwqs/3epxmg2n/ chrome 31+和opera 27+完美支持
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                            <span class="pull-right badge green">+1</span>
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002749558/a-1020000002750043">python如何清空数组？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/python" data-toggle="popover" data-id="1040000000089534" data-original-title="python">python</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E6%95%B0%E7%BB%84" data-toggle="popover" data-id="1040000000089924" data-original-title="数组">数组</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            {代码...}
                        </p>
                    </div>
                </section>


                <section class="widget-active__article">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-file"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">1 天前发表文章 <small class="ml10 glyphicon glyphicon-comment"></small> 2
                            <span class="pull-right badge green">+2</span>
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/a/1190000002750033">CSS3的content属性详解</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/css" data-toggle="popover" data-id="1040000000089434" data-original-title="css">css</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/css3" data-toggle="popover" data-id="1040000000090141" data-original-title="css3">css3</a>
                                </li>
                            </ul>
                        </div>
                        <p class="mb0 wordbreak">
                            CSS中主要的伪元素有四个：before/after/first-letter/first-line，在before/after伪元素选择器中，有一...
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">2 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002746746/a-1020000002748068">如果在网页设置过多的setInterval，会不会对网页的效率和内存有影戏</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-id="1040000000117807" data-original-title="web前端开发">web前端开发</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E7%A7%BB%E5%8A%A8web%E5%BC%80%E5%8F%91" data-toggle="popover" data-id="1040000000089604" data-original-title="移动web开发">移动web开发</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-id="1040000000089733" data-original-title="jquery">jquery</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            会占用比较多的内存，容易造成内存泄露：JavaScript 高级计时器 详细分析
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">2 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 4
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002737319/a-1020000002747907">收到了两份offer，不知道选哪一家对以后来说才是正确的</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%B7%A5%E4%BD%9C%E8%BF%B7%E8%8C%AB" data-toggle="popover" data-id="1040000000182842" data-original-title="工作迷茫">工作迷茫</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            可以考虑一下两家公司目前的主营业务跟你想要学习的东西的关系，哪一家的关联性比较强，就选择哪一家，...
                        </p>
                    </div>
                </section>


                <section class="widget-active__ask">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-question-sign"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">2 天前提问 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002742023">火狐下，怎么让文本框获取焦点？focus方法不行,IE下出现诡异现象</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-id="1040000000089436" data-original-title="javascript">javascript</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/input" data-toggle="popover" data-id="1040000000144771" data-original-title="input">input</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E7%84%A6%E7%82%B9" data-toggle="popover" data-id="1040000000133603" data-original-title="焦点">焦点</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E7%81%AB%E7%8B%90" data-toggle="popover" data-id="1040000000090132" data-original-title="火狐">火狐</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">2 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <span class="label label-success pull-left mr5">采纳</span>
                            <h4><a href="/q/1010000002741726/a-1020000002741732">ruby 如何判断一个字符串编码是 gbk 还是 utf8</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/ruby" data-toggle="popover" data-id="1040000000089699" data-original-title="ruby">ruby</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            UTF8编码和正则表达式
                        </p>
                    </div>
                </section>


                <section class="widget-active__answer">
                    <div class="widget-active--left">
                        <span class="glyphicon glyphicon-comment"></span>
                    </div>
                    <div class="widget-active--right">
                        <p class="widget-active--right__info">2 天前回答 <small class="ml10 glyphicon glyphicon-comment"></small> 0
                        </p>
                        <div class="widget-active--right__title">
                            <h4><a href="/q/1010000002741553/a-1020000002741682">如何获取字符串中的内容？</a></h4>
                            <ul class="taglist--inline ib">
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F" data-toggle="popover" data-id="1040000000089653" data-original-title="正则表达式">正则表达式</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-id="1040000000089387" data-original-title="php">php</a>
                                </li>
                                <li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%AD%97%E7%AC%A6%E4%B8%B2" data-toggle="popover" data-id="1040000000090421" data-original-title="字符串">字符串</a>
                                </li>
                            </ul>
                        </div>
                        <p class="widget-active--right__quote">
                            JavaScript版 用match {代码...} 用exec {代码...} 有点复杂 {代码...} 还需要对返回的数组做一下简单就...
                        </p>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection