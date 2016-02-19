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
                                        <h4>刘诗诗演绎一代女医 霍建华黄轩争权夺爱</h4>
                                        <p></p>
                                    </div>
                                </div><div class="item active">
                                    <a href="http://www.juqingku.net/plot/63833/1.html" target="_blank"><img src="http://1.im.guokr.com/dH3agcf_PusFxKVtgTR7uP98ggSyBxANsV6Gz31k4UL6AQAAaAEAAEpQ.jpg?imageView2/1/w/330/h/235" alt="刘恺威郑爽剜心虐恋"></a>
                                    <div class="carousel-caption">
                                        <h4>刘恺威郑爽剜心虐恋</h4>
                                        <p></p>
                                    </div>
                                </div><div class="item ">
                                    <a href="http://www.juqingku.net/plot/63817/1.html" target="_blank"><img src="http://3.im.guokr.com/9FbjrviSIOJDttg0caNbOgwokdDOTGdd4rmmi2TmwkMtAQAA1gAAAEpQ.jpg" alt="童瑶李晨共谱办公室恋曲"></a>
                                    <div class="carousel-caption">
                                        <h4>童瑶李晨共谱办公室恋曲</h4>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
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
                            @foreach($hotQuestions as $hotQuestion)
                            <li class="widget-links-item">
                                <a title="{{ $hotQuestion->title }}"  href="{{ route('ask.question.detail',['id'=>$hotQuestion->id]) }}">{{ $hotQuestion->title }}</a>
                                <small class="text-muted">{{ $hotQuestion->answers }} 回答</small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">悬赏问答</h4>

                        <ul class="widget-links list-unstyled">
                            @foreach($rewardQuestions as $rewardQuestion)
                                <li class="widget-links-item">
                                    <span class="text-gold"><i class="fa fa-database"></i> {{ $rewardQuestion->price }}</span>
                                     <a title="{{ $rewardQuestion->title }}" href="{{ route('ask.question.detail',['id'=>$rewardQuestion->id]) }}">{{ $rewardQuestion->title }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="job-list-item row">
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">热门文章</h4>
                        <ul class="widget-links list-unstyled">
                            @foreach($hotArticles as $hotArticle)
                                <li class="widget-links-item">
                                    <a title="{{ $hotArticle->title }}"  href="{{ route('blog.article.detail',['id'=>$hotArticle->id]) }}">{{ $hotArticle->title }}</a>
                                    <small class="text-muted">{{ $hotArticle->views }} 浏览</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 job-list-item-block">
                        <h4 class="widget-box-title">最新文章</h4>
                        <ul class="widget-links list-unstyled">
                            @foreach($newestArticles as $newestArticle)
                                <li class="widget-links-item">
                                    <a title="{{ $newestArticle->title }}"  href="{{ route('blog.article.detail',['id'=>$newestArticle->id]) }}">{{ $newestArticle->title }}</a>
                                    <small class="text-muted">{{ $newestArticle->views }} 浏览</small>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-3 side">

            <div class="widget-box">
                <h4 class="widget-box-title">最新公告</h4>
                <ul class="widget-links list-unstyled">
                    @foreach($newestNotices as $newestNotice)
                    <li class="widget-links-item">
                        <a title="{{ $newestNotice->subject }}" href="{{ $newestNotice->url }}" target="_blank">{{ $newestNotice->subject }}</a>
                    </li>
                    @endforeach
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
                <ol class="widget-top10">
                    @foreach($topCoinUsers as $topCoinUser)
                    <li class="text-muted">
                        <img class="avatar-32" src="{{ route('website.image.avatar',['avatar_name'=>$topCoinUser->id.'_middle'])}}">
                        <a href="{{ route('auth.space.index',['user_id'=>$topCoinUser->id]) }}" class="ellipsis">{{ $topCoinUser->name }}</a>
                        <span class="text-muted pull-right">{{ $topCoinUser->coins }}</span>
                    </li>
                    @endforeach

                </ol>
            </div>

            <div class="widget-box">
                <h2 class="h4 widget-box-title">最近热门的</h2>

            </div>
        </div>
    </div>
@endsection