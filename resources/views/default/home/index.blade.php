@extends('default/common/base')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <p class="main-title hidden-xs">
                今天，你在开发时遇到了什么问题呢？
                <a id="goAsk" href="/ask" class="btn btn-primary">我要提问</a>
            </p>

            <ul class="nav nav-tabs nav-tabs-zen mb10">
                <li class="active"><a href="/questions/newest">最新的</a></li>
                <li><a href="/questions/hottest">热门的</a></li>
                <li><a href="/questions/unanswered">未回答</a></li>
            </ul>

            <div class="stream-list question-stream">
                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            10<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/yepman">YepMan</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606316" class="askDate" data-created="1426689518">29分钟前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606316">java 里面的polygon.contains()的漏洞</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/java" data-toggle="popover" data-original-title="java" data-id="1040000000089449">java</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            20<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/sharkman">sharkman</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606307" class="askDate" data-created="1426689413">31分钟前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606307">经常做相似的项目，怎么以后重复用这个项目的框架和配置？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-original-title="web前端开发" data-id="1040000000117807">web前端开发</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/yeoman" data-toggle="popover" data-original-title="yeoman" data-id="1040000000312939">yeoman</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/grunt" data-toggle="popover" data-original-title="grunt" data-id="1040000000248845">grunt</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%89%8D%E7%AB%AF" data-toggle="popover" data-original-title="前端" data-id="1040000000089899">前端</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            48<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/integ">Integ</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606232/a-1020000002606296">49分钟前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606232">在js中以下两种字典写法有什么区别？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            2<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            183<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/dyzdyz010">dyzdyz010</a>
                                <span class="split"></span>
                                <a href="/q/1010000002580630/a-1020000002606290">51分钟前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002580630">iOS 中单例模式好的实践是？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/ios" data-toggle="popover" data-original-title="ios" data-id="1040000000089442">ios</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            177<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/dyzdyz010">dyzdyz010</a>
                                <span class="split"></span>
                                <a href="/q/1010000002586707/a-1020000002606277">54分钟前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002586707">求推荐iOS开发方面的书</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/ios" data-toggle="popover" data-original-title="ios" data-id="1040000000089442">ios</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus hidden-xs">
                            2<small>投票</small>
                        </div>
                        <div class="answers answered">
                            8<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            1k<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li class="pull-right" title="5 收藏">
                                <small class="glyphicon glyphicon-bookmark"></small> 5
                            </li>
                            <li>
                                <a href="/u/songdandandan">宋丹丹丹</a>
                                <span class="split"></span>
                                <a href="/q/1010000002589542/a-1020000002606257">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002589542">一个没有理解面试题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            22<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/forecho">forecho</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606252" class="askDate" data-created="1426687143">1小时前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606252">Yii2 中一个 rules 对应的一条规格 可以映射另外一个 model 的 rules 吗？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/yii2" data-toggle="popover" data-original-title="yii2" data-id="1040000000409363">yii2</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            226<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li class="pull-right" title="3 收藏">
                                <small class="glyphicon glyphicon-bookmark"></small> 3
                            </li>
                            <li>
                                <a href="/u/dyzdyz010">dyzdyz010</a>
                                <span class="split"></span>
                                <a href="/q/1010000002577706/a-1020000002606248">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002577706">有哪些你离不开的 Cocoa 库？使用场景和理由是？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/ios" data-toggle="popover" data-original-title="ios" data-id="1040000000089442">ios</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/objective-c" data-toggle="popover" data-original-title="objective-c" data-id="1040000000090209">objective-c</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/cocoa" data-toggle="popover" data-original-title="cocoa" data-id="1040000000090722">cocoa</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            39<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/pang20c">pang20c</a>
                                <span class="split"></span>
                                <a href="/q/1010000002600501/a-1020000002606223">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002600501">php-fpm 一直是ESTABLISHED</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/php-fpm" data-toggle="popover" data-original-title="php-fpm" data-id="1040000000091174">php-fpm</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/nginx" data-toggle="popover" data-original-title="nginx" data-id="1040000000090145">nginx</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            2<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            63<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/cevin">cevin</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606152/a-1020000002606212">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606152">QQ会员表是如何进行分表的</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/mysql" data-toggle="popover" data-original-title="mysql" data-id="1040000000089439">mysql</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            66<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li class="pull-right" title="1 收藏">
                                <small class="glyphicon glyphicon-bookmark"></small> 1
                            </li>
                            <li>
                                <a href="/u/1000copy">1000copy</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605827/a-1020000002606194">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605827">input和button在一行写，一样的高度，为什么浏览器里不一样？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/html" data-toggle="popover" data-original-title="html" data-id="1040000000089571">html</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            1<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            50<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/integ">Integ</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606083/a-1020000002606189">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606083">为什么某些英文软件/网站的字体特别特别的小?</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%AD%97%E4%BD%93" data-toggle="popover" data-original-title="字体" data-id="1040000000090747">字体</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            2<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            55<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/ludou">露兜</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605356/a-1020000002606174">1小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605356">如何移动Wordpress目录？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/wordpress" data-toggle="popover" data-original-title="wordpress" data-id="1040000000089914">wordpress</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            45<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/gyf1">GYF</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606046/a-1020000002606128">2小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606046">用Angular的$http.get获取的png图片未能如愿缓存（预加载）</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/angularjs" data-toggle="popover" data-original-title="angularjs" data-id="1040000000210853">angularjs</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%9B%BE%E7%89%87%E9%A2%84%E5%8A%A0%E8%BD%BD" data-toggle="popover" data-original-title="图片预加载" data-id="1040000000745086">图片预加载</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            2<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            41<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/windoze">Windoze</a>
                                <span class="split"></span>
                                <a href="/q/1010000002606080/a-1020000002606104">2小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002606080">有没有轻量级嵌入式的KV存储引擎推荐？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/kv%E5%AD%98%E5%82%A8" data-toggle="popover" data-original-title="kv存储" data-id="1040000002606078">kv存储</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            3<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            52<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/hampotato">hampotato</a>
                                <span class="split"></span>
                                <a href="/q/1010000002604748/a-1020000002606066">2小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002604748">有将一台iphone（安卓）作为控制器，控制另一台ipad或屏幕的开源项目可以参考一下吗，或者能介绍一下怎么实现的吗？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/ios" data-toggle="popover" data-original-title="ios" data-id="1040000000089442">ios</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E8%93%9D%E7%89%99" data-toggle="popover" data-original-title="蓝牙" data-id="1040000000726606">蓝牙</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/wifi" data-toggle="popover" data-original-title="wifi" data-id="1040000000091203">wifi</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%B1%80%E5%9F%9F%E7%BD%91" data-toggle="popover" data-original-title="局域网" data-id="1040000000130639">局域网</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/android" data-toggle="popover" data-original-title="android" data-id="1040000000089658">android</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            2<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            57<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/dwqs">不写代码的码农</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605747/a-1020000002606028">3小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605747">PHP 正则表达式问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            1<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            55<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/hibernake">hibernake</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605854/a-1020000002606018">3小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605854">C++的开发问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/c%2B%2B" data-toggle="popover" data-original-title="c++" data-id="1040000000089741">c++</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            73<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/dwqs">不写代码的码农</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605701/a-1020000002606012">3小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605701">简单的正则表达式</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/javascript" data-toggle="popover" data-original-title="javascript" data-id="1040000000089436">javascript</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/web%E5%89%8D%E7%AB%AF%E5%BC%80%E5%8F%91" data-toggle="popover" data-original-title="web前端开发" data-id="1040000000117807">web前端开发</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/jquery" data-toggle="popover" data-original-title="jquery" data-id="1040000000089733">jquery</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F" data-toggle="popover" data-original-title="正则表达式" data-id="1040000000089653">正则表达式</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            1<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            43<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/jerryshao">小耗子杰瑞</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605960/a-1020000002606000">3小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605960">java static 和 非static能不能构成重载?</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/java" data-toggle="popover" data-original-title="java" data-id="1040000000089449">java</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            36<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/iamzhoug37">iamzhoug37</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605992" class="askDate" data-created="1426679149">3小时前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605992">java内部类名字的作用域?</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/java" data-toggle="popover" data-original-title="java" data-id="1040000000089449">java</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            30<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/angerbaby">angerbaby</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605978" class="askDate" data-created="1426678736">3小时前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605978">mysql中的next key与mvcc有何不同？各自的应用体现在哪？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/mysql" data-toggle="popover" data-original-title="mysql" data-id="1040000000089439">mysql</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/lock" data-toggle="popover" data-original-title="lock" data-id="1040000000089718">lock</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%B9%BB%E8%AF%BB" data-toggle="popover" data-original-title="幻读" data-id="1040000002605975">幻读</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered solved">
                            8<small>解决</small>
                        </div>
                        <div class="views hidden-xs">
                            400<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li class="pull-right" title="3 收藏">
                                <small class="glyphicon glyphicon-bookmark"></small> 3
                            </li>
                            <li>
                                <a href="/u/zayujunjiediqi">杂鱼君接地气</a>
                                <span class="split"></span>
                                <a href="/q/1010000002593740/a-1020000002605950">4小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002593740">为了防注入，对sql查询语句加转义addslashes后，语句语法出现问题</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/mysql" data-toggle="popover" data-original-title="mysql" data-id="1040000000089439">mysql</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/addslashes" data-toggle="popover" data-original-title="addslashes" data-id="1040000002593729">addslashes</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes plus hidden-xs">
                            1<small>投票</small>
                        </div>
                        <div class="answers answered">
                            3<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            144<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/woshicixide">woshicixide</a>
                                <span class="split"></span>
                                <a href="/q/1010000002600161/a-1020000002605942">4小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002600161">php + mysql 这个下单流程怎么确保数据的完整性？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/mysql" data-toggle="popover" data-original-title="mysql" data-id="1040000000089439">mysql</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers">
                            0<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            1<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/beikejiedewangling">贝克街de亡灵</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605912" class="askDate" data-created="1426675533">4小时前提问</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605912">微信支付无法获取prepayid</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/%E5%BE%AE%E4%BF%A1" data-toggle="popover" data-original-title="微信" data-id="1040000000090818">微信</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/android" data-toggle="popover" data-original-title="android" data-id="1040000000089658">android</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            2<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            32<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/gemini">Gemini</a>
                                <span class="split"></span>
                                <a href="/q/1010000002601439/a-1020000002605896">4小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002601439">在Android4.4系统中保存一个状态</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/android" data-toggle="popover" data-original-title="android" data-id="1040000000089658">android</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/ubuntu" data-toggle="popover" data-original-title="ubuntu" data-id="1040000000090245">ubuntu</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            78<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/nathanwu">nathan_wu</a>
                                <span class="split"></span>
                                <a href="/q/1010000002604325/a-1020000002605833">4小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002604325">用php将动态gif拆分成单帧</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/gif" data-toggle="popover" data-original-title="gif" data-id="1040000000090704">gif</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            86<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/someotherone">someotherone</a>
                                <span class="split"></span>
                                <a href="/q/1010000002605582/a-1020000002605816">4小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002605582">Vim 键位映射</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/vim" data-toggle="popover" data-original-title="vim" data-id="1040000000089467">vim</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            305<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/wifidog">WifiDog无线热点解决方案</a>
                                <span class="split"></span>
                                <a href="/q/1010000002525104/a-1020000002605777">5小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002525104">wifidog如何判断用户不在线？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/wifidog" data-toggle="popover" data-original-title="wifidog" data-id="1040000002525087">wifidog</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/%E8%B7%AF%E7%94%B1%E5%99%A8" data-toggle="popover" data-original-title="路由器" data-id="1040000000090544">路由器</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/php" data-toggle="popover" data-original-title="php" data-id="1040000000089387">php</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/openwrt" data-toggle="popover" data-original-title="openwrt" data-id="1040000000090724">openwrt</a></li>            </ul>
                    </div>
                </section>

                <section class="stream-list__item">
                    <div class="qa-rank">
                        <div class="votes hidden-xs">
                            0<small>投票</small>
                        </div>
                        <div class="answers answered">
                            1<small>回答</small>
                        </div>
                        <div class="views hidden-xs">
                            102<small>浏览</small>
                        </div>
                    </div>
                    <div class="summary">
                        <ul class="author list-inline">
                            <li>
                                <a href="/u/nathanwu">nathan_wu</a>
                                <span class="split"></span>
                                <a href="/q/1010000002596864/a-1020000002605756">5小时前回答</a>
                            </li>
                        </ul>
                        <h2 class="title"><a href="/q/1010000002596864">laravel中服务提供者的工作方式？</a></h2>
                        <ul class="taglist--inline ib">
                            <li class="tagPopup"><a class="tag tag-sm" href="/t/laravel" data-toggle="popover" data-original-title="laravel" data-id="1040000000196640">laravel</a></li><li class="tagPopup"><a class="tag tag-sm" href="/t/providers" data-toggle="popover" data-original-title="providers" data-id="1040000002596862">providers</a></li>            </ul>
                    </div>
                </section>

            </div><!-- /.stream-list -->

            <div class="text-center">
                <ul class="pagination"><li class="active"><a href="javascript:void(0);">1</a></li><li><a href="/questions/newest?page=2">2</a></li><li><a href="/questions/newest?page=3">3</a></li><li><a href="/questions/newest?page=4">4</a></li><li><a href="/questions/newest?page=5">5</a></li><li class="disabled"><span>…</span></li><li class="next"><a href="/questions/newest?page=2">下一页</a></li></ul>
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


            <div class="sfad-sidebar">
                <div class="sfad-item" data-adn="ad-981183" id="adid-981183"><div id="BAIDU_DUP_wrapper_981183_0"></div></div>

                <div class="sfad-item" data-adn="ad-981184" id="adid-981184"><div id="BAIDU_DUP_wrapper_981184_0"><iframe id="baidu_clb_slot_iframe_981184_0" src="about:blank" onload="BAIDU_DUP_CLB_renderFrame('981184_0')" width="233" height="60" vspace="0" hspace="0" allowtransparency="true" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="border:0; vertical-align:bottom; margin:0; display:block;"></iframe></div></div>

                <div class="sfad-item" data-adn="ad-981694" id="adid-981694"><div id="BAIDU_DUP_wrapper_981694_0"><iframe id="baidu_clb_slot_iframe_981694_0" src="about:blank" onload="BAIDU_DUP_CLB_renderFrame('981694_0')" width="233" height="60" vspace="0" hspace="0" allowtransparency="true" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="border:0; vertical-align:bottom; margin:0; display:block;"></iframe></div></div>

            </div>






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