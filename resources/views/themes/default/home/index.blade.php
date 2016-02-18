@extends('theme::layout.public')

@section('jumbotron')
    @if(Auth()->guest())
    <div class="jumbotron text-center">
        <h4>现在加入Tipask问答网，一起记录站长的世界 <a class="btn btn-primary ml-10" href="{{ route('auth.user.register') }}" role="button">立即注册</a> <a class="btn btn-success ml-5" href="{{ route('auth.user.login') }}" role="button">用户登陆</a></h4>
    </div>
    @endif
@endsection

@section('content')
    <div class="row mt-10">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-box">
                <h4 class="widget-box-title">最新推荐</h4>
                <div class="job-list-item row">
                    <div class="col-md-6 job-list-item-block">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="leftmodbox">
                                <div class="item">
                                    <a href="http://www.juqingku.net/plot/63829/1.html" target="_blank"><img src="http://2.im.guokr.com/S-iNTKhNmwt5f_Gsmr6Divh09iHyEH_XFoB0rtvdWE2AAgAAyAEAAEpQ.jpg?imageView2/1/w/330/h/235" alt="刘诗诗演绎一代女医 霍建华黄轩争权夺爱"></a>
                                    <div class="carousel-caption">
                                        <h3>刘诗诗演绎一代女医 霍建华黄轩争权夺爱</h3>
                                        <p></p>
                                    </div>
                                </div><div class="item active">
                                    <a href="http://www.juqingku.net/plot/63833/1.html" target="_blank"><img src="http://1.im.guokr.com/dH3agcf_PusFxKVtgTR7uP98ggSyBxANsV6Gz31k4UL6AQAAaAEAAEpQ.jpg?imageView2/1/w/330/h/235" alt="刘恺威郑爽剜心虐恋"></a>
                                    <div class="carousel-caption">
                                        <h3>刘恺威郑爽剜心虐恋</h3>
                                        <p></p>
                                    </div>
                                </div><div class="item ">
                                    <a href="http://www.juqingku.net/plot/63817/1.html" target="_blank"><img src="http://3.im.guokr.com/9FbjrviSIOJDttg0caNbOgwokdDOTGdd4rmmi2TmwkMtAQAA1gAAAEpQ.jpg" alt="童瑶李晨共谱办公室恋曲"></a>
                                    <div class="carousel-caption">
                                        <h3>童瑶李晨共谱办公室恋曲</h3>
                                        <p></p>
                                    </div>
                                </div>                    </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 job-list-item-block">
                        <ul class="widget-links list-unstyled">
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/8">你们家装修是什么样子的，总共花费是多少？</a>
                                <small class="text-muted">1 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/1">如何看待微信将对提现收取手续费？</a>
                                <small class="text-muted">2 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/6">如何评价豆瓣广告《我们的精神角落》？</a>
                                <small class="text-muted">2 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/5">大学毕业是去大城市好还是回小城市好?</a>
                                <small class="text-muted">2 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/7">网络上有哪些免费的教育资源？</a>
                                <small class="text-muted">1 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/8">你们家装修是什么样子的，总共花费是多少？</a>
                                <small class="text-muted">1 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/1">如何看待微信将对提现收取手续费？</a>
                                <small class="text-muted">2 回答</small>
                            </li>
                            <li class="widget-links-item">
                                <a href="http://www.tipaskx.com/question/6">如何评价豆瓣广告《我们的精神角落》？</a>
                                <small class="text-muted">2 回答</small>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-box clearfix">
                <h4 class="widget-box-title">活跃用户</h4>

                @foreach($activeUsers as $activeUser)
                <div class="media col-md-3">
                    <a class="pull-left" href="{{ route('auth.space.index',['user_id'=>$activeUser->id]) }}"><img class="media-object avatar-50" src="{{ route('website.image.avatar',['avatar_name'=>$activeUser->id.'_middle'])}}" alt="{{ $activeUser->name }}"></a>
                    <div class="media-body ">
                        <a href="{{ route('auth.space.index',['user_id'=>$activeUser->id]) }}" class="media-heading">{{ $activeUser->name }}</a>
                        <p class="text-muted">{{ $activeUser->title }}</p>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="widget-box">
                <div class="job-list-item row">
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">热门问答</h4>
                        <ul class="widget-links list-unstyled">
                            <li class="widget-links-item">
                                <a title="如何找到靠谱的医院？" href="http://www.tipaskx.com/article/6">如何找到靠谱的医院？</a>
                                <small class="text-muted">6 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="融资为什么要先找投资经理" href="http://www.tipaskx.com/article/5">融资为什么要先找投资经理</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="你也是产品设计师" href="http://www.tipaskx.com/article/4">你也是产品设计师</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个程序员的怒吼" href="http://www.tipaskx.com/article/3">一个程序员的怒吼</a>
                                <small class="text-muted">1 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个产品是什么，首先必须不是什么" href="http://www.tipaskx.com/article/2">一个产品是什么，首先必须不是什么</a>
                                <small class="text-muted">2 浏览</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">悬赏问答</h4>

                        <ul class="widget-links list-unstyled">
                            <li class="widget-links-item">
                                <a title="如何找到靠谱的医院？" href="http://www.tipaskx.com/article/6">如何找到靠谱的医院？</a>
                                <small class="text-muted">6 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="融资为什么要先找投资经理" href="http://www.tipaskx.com/article/5">融资为什么要先找投资经理</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="你也是产品设计师" href="http://www.tipaskx.com/article/4">你也是产品设计师</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个程序员的怒吼" href="http://www.tipaskx.com/article/3">一个程序员的怒吼</a>
                                <small class="text-muted">1 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个产品是什么，首先必须不是什么" href="http://www.tipaskx.com/article/2">一个产品是什么，首先必须不是什么</a>
                                <small class="text-muted">2 浏览</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="job-list-item row">
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">热门文章</h4>
                        <ul class="widget-links list-unstyled">
                            <li class="widget-links-item">
                                <a title="如何找到靠谱的医院？" href="http://www.tipaskx.com/article/6">如何找到靠谱的医院？</a>
                                <small class="text-muted">6 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="融资为什么要先找投资经理" href="http://www.tipaskx.com/article/5">融资为什么要先找投资经理</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="你也是产品设计师" href="http://www.tipaskx.com/article/4">你也是产品设计师</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个程序员的怒吼" href="http://www.tipaskx.com/article/3">一个程序员的怒吼</a>
                                <small class="text-muted">1 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个产品是什么，首先必须不是什么" href="http://www.tipaskx.com/article/2">一个产品是什么，首先必须不是什么</a>
                                <small class="text-muted">2 浏览</small>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">最新文章</h4>
                        <ul class="widget-links list-unstyled">
                            <li class="widget-links-item">
                                <a title="如何找到靠谱的医院？" href="http://www.tipaskx.com/article/6">如何找到靠谱的医院？</a>
                                <small class="text-muted">6 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="融资为什么要先找投资经理" href="http://www.tipaskx.com/article/5">融资为什么要先找投资经理</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="你也是产品设计师" href="http://www.tipaskx.com/article/4">你也是产品设计师</a>
                                <small class="text-muted">3 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个程序员的怒吼" href="http://www.tipaskx.com/article/3">一个程序员的怒吼</a>
                                <small class="text-muted">1 浏览</small>
                            </li>
                            <li class="widget-links-item">
                                <a title="一个产品是什么，首先必须不是什么" href="http://www.tipaskx.com/article/2">一个产品是什么，首先必须不是什么</a>
                                <small class="text-muted">2 浏览</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-3 side">

            <div class="widget-box">
                <h4 class="widget-box-title">最新公告</h4>
                <ul class="widget-links list-unstyled">
                    <li class="widget-links-item">
                        <a title="如何找到靠谱的医院？" href="http://www.tipaskx.com/article/6">如何找到靠谱的医院？</a>
                    </li>
                    <li class="widget-links-item">
                        <a title="融资为什么要先找投资经理" href="http://www.tipaskx.com/article/5">融资为什么要先找投资经理</a>
                    </li>
                    <li class="widget-links-item">
                        <a title="你也是产品设计师" href="http://www.tipaskx.com/article/4">你也是产品设计师</a>
                    </li>
                    <li class="widget-links-item">
                        <a title="一个程序员的怒吼" href="http://www.tipaskx.com/article/3">一个程序员的怒吼</a>
                    </li>
                    <li class="widget-links-item">
                        <a title="一个产品是什么，首先必须不是什么" href="http://www.tipaskx.com/article/2">一个产品是什么，首先必须不是什么</a>
                    </li>
                </ul>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">热议话题 <a href="{{ route('website.topic') }}" title="更多">»</a></h2>
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

            <div class="widget-box mt30">
                <h2 class="widget-box-title">
                    财富榜
                </h2>
                <ol id="usersDaily" class="widget-top10">
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/305/423/3054230534-561d20a868d2e_big64">
                        <a href="/u/universe_of_code" class="ellipsis">
                            代码宇宙
                        </a>
                        <span class="text-muted pull-right">+222</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/304/698/3046988269-5644b84c17ed3_big64">
                        <a href="/u/youmingdot" class="ellipsis">
                            有明
                        </a>
                        <span class="text-muted pull-right">+79</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/275/720/275720874-553ae32cd2b02_big64">
                        <a href="/u/jamesfancy" class="ellipsis">
                            边城
                        </a>
                        <span class="text-muted pull-right">+67</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://dfnjy7g2qaazm.cloudfront.net/v-56b1c937/global/img/user-64.png">
                        <a href="/u/luca1986" class="ellipsis">
                            luca1986
                        </a>
                        <span class="text-muted pull-right">+56</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/891/710/891710192-1030000000445043_big64">
                        <a href="/u/yellowlemon" class="ellipsis">
                            yellowlemon
                        </a>
                        <span class="text-muted pull-right">+54</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/151/837/1518375183-54f135ef0d731_big64">
                        <a href="/u/akong" class="ellipsis">
                            kikong
                        </a>
                        <span class="text-muted pull-right">+52</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/305/322/3053223291-564c4e7d37faa_big64">
                        <a href="/u/cuixiaozhuai" class="ellipsis">
                            崔小拽
                        </a>
                        <span class="text-muted pull-right">+46</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/381/879/3818797108-5485c6dc7d677_big64">
                        <a href="/u/lwxyfer" class="ellipsis">
                            LWXYFER
                        </a>
                        <span class="text-muted pull-right">+36</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://sfault-avatar.b0.upaiyun.com/147/700/1477005669-55f23e2566f36_big64">
                        <a href="/u/liuchao_55d0a0a7c90f3" class="ellipsis">
                            刘懿超
                        </a>
                        <span class="text-muted pull-right">+35</span>
                    </li>
                    <li class="text-muted">
                        <img class="avatar-24" src="https://dfnjy7g2qaazm.cloudfront.net/v-56b1c937/global/img/user-64.png">
                        <a href="/u/105310" class="ellipsis">
                            mlyknown
                        </a>
                        <span class="text-muted pull-right">+33</span>
                    </li>
                </ol>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">最近热门的</h2>

            </div>
        </div>
    </div>
@endsection