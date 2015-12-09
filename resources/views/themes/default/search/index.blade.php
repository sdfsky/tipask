@extends('theme::layout.public')

@section('content')
    <div class="container mt-20">
        <div class="row">
            <div class="container">
                <ul class="search-category nav nav-pills">
                    <li class="active"><a href="/search?q=php">全部</a></li>
                    <li><a href="/search?type=question&amp;q=php">问答</a></li>
                    <li><a href="/search?type=article&amp;q=php">文章</a></li>
                    <li><a href="/search?type=tag&amp;q=php">标签</a></li>
                    <li><a href="/search?type=user&amp;q=php">用户</a></li>
                    <li><a href="/search?type=activity&amp;q=php">活动</a></li>
                </ul>
                <form action="/search" class="row">
                    <div class="col-md-9">
                        <input class="input-lg form-control" type="text" name="q" value="php" placeholder="输入关键字搜索">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">搜索</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 main search-result">
                <h3 class="h5 mt0">找到约 <strong>4476</strong> 条结果</h3>

                <div class="best-tag">
                    <div class="clearfix">
                        <a href="/t/php" class="tag tag-lg pull-left">
                            <img class="avatar-16" src="http://sfault-avatar.b0.upaiyun.com/216/041/2160419118-54cb55dec50ee_icon" alt="php"> php</a>
                        <ul class="list-inline pull-right mt5">
                            <li><a href="/t/php/info">百科</a></li>
                            <li><a href="/t/php">问答</a></li>
                            <li><a href="/t/php/blogs">文章</a></li>
                        </ul>
                    </div>
                    <p class="excerpt"><strong class="key">PHP</strong>，是英文超文本预处理语言 Hypertext Preprocessor 的缩写。<strong class="key">PHP</strong> 是一种 HTML 内嵌式的语言，是一种在服务器端执行的嵌入 HTML 文档的脚本语言，语言的风格有类似于C语言，被广泛的运用。</p>
                </div>

                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000002911607" target="_blank">homebrew/<strong class="key">php</strong>/<strong class="key">php</strong>56-redis   josegonzalez/<strong class="key">php</strong>/<strong class="key">php</strong>56-redis?</a>
                    </h2>
                    <p class="excerpt">请问mac pro提示 $ brew install <strong class="key">php</strong>56-redis Error: Formulae found in multiple taps: * homebrew/<strong class="key">php</strong>/<strong class="key">php</strong>56-redis * josegonzalez/<strong class="key">php</strong>/<strong class="key">php</strong>56-redis Please use the fully-qualified name e.g. homebrew/<strong class="key">php</strong>/ph...</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000000758100" target="_blank">安装好<strong class="key">php</strong>为什么要复制一份<strong class="key">php</strong>.ini  到/usr/local/<strong class="key">php</strong>/lib/<strong class="key">php</strong>.ini</a>
                    </h2>
                    <p class="excerpt">安装好<strong class="key">php</strong>为什么要复制一份<strong class="key">php</strong>.ini 到/usr/local/<strong class="key">php</strong>/lib/<strong class="key">php</strong>.ini 我试过了 如果不复制一份 <strong class="key">php</strong>也能正常运行 为什么要从安装包里复制一份<strong class="key">php</strong>.ini 到 /usr/local/<strong class="key">php</strong>/lib/<strong class="key">php</strong>.ini 目录下呢</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <a href="/q/1010000004100953" target="_blank">nginx+<strong class="key">php</strong>:可以正确解释<strong class="key">php</strong>文件，但是点<strong class="key">php</strong>页面的链接会404或者直接显示<strong class="key">php</strong>文件所在目录的文件列表</a>
                    </h2>
                    <p class="excerpt">nginx已经可以正确解释<strong class="key">PHP</strong>文件。如果一个目录下有index.<strong class="key">php</strong>，nginx不会自动载入index.<strong class="key">php</strong>，手动点击可以正确解释。但是点击wordpress的index.<strong class="key">php</strong>，会直接显示wordpress目录下的文件列表。若点击drupal的index.<strong class="key">php</strong>...</p>
                </section>
                <section class="widget-tag">
                    <p><a href="/t/php-php%E8%BF%9B%E9%98%B6" class="tag tag-lg" target="_blank">
                            php-php进阶</a></p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000001806287" target="_blank">http://windows.<strong class="key">php</strong>.net/ 和 http://<strong class="key">php</strong>.net/ 都提供<strong class="key">PHP</strong>下载，到底什么区别呢？</a>
                    </h2>
                    <p class="excerpt">http://windows.<strong class="key">php</strong>.net/ 和 http://<strong class="key">php</strong>.net/ 都提供<strong class="key">PHP</strong>下载，到底什么区别呢？</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <a href="/q/1010000003921868" target="_blank"><strong class="key">php</strong>扩展Tokenizer <strong class="key">PHP</strong> Extension找不到！</a>
                    </h2>
                    <p class="excerpt">在<strong class="key">php</strong>.ini中找不到Tokenizer <strong class="key">PHP</strong> Extension怎么弄？</p>
                </section>
                <section class="widget-tag">
                    <p><a href="/t/php-_server-php_self" class="tag tag-lg" target="_blank">
                            php-_server-php_self</a></p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000003465862" target="_blank"><strong class="key">PHP</strong>的框架通常用于小型项目吗？<strong class="key">php</strong></a>
                    </h2>
                    <p class="excerpt">像大型项目怎么办呢？不用框架。都自己手写膜？还是不用<strong class="key">PHP</strong>。用其他语言做？</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <a href="/q/1010000000450602" target="_blank"><strong class="key">php</strong>：<strong class="key">php</strong>_scws安装失败</a>
                    </h2>
                    <p class="excerpt">参考官方的安装文档 在iis下成功安装并运行（<strong class="key">php</strong>为nts的），而在Apache下（<strong class="key">php</strong>是ts的）则安装失败，无法正常运行。 不知道scws是否只支持nts的呢？</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <a href="/q/1010000000647710" target="_blank"><strong class="key">php</strong>怎么执行变量里的<strong class="key">PHP</strong>模板代码？</a>
                    </h2>
                    <p class="excerpt">{代码...} 我自己Google到答案了 eval(' ?&gt;'.$tpl.'&lt;?<strong class="key">php</strong> '); http://stackoverflow.com/questions/1309800/<strong class="key">php</strong>-eval-that-evaluates-html-<strong class="key">php</strong></p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000002753412" target="_blank">既然apache也是调<strong class="key">php</strong>解析器<strong class="key">php</strong>-cgi.exe去执行<strong class="key">php</strong>的，为啥一定要安装apache呢？</a>
                    </h2>
                    <p class="excerpt">既然apache也是调<strong class="key">php</strong>解析器<strong class="key">php</strong>-cgi.exe去执行<strong class="key">php</strong>的，为啥一定要安装apache呢？ 为啥不是直接把请求给<strong class="key">php</strong>-cgi.exe, 还要经过apache绕一下？</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <a href="/q/1010000003773532" target="_blank"><strong class="key">php</strong> socket server.<strong class="key">php</strong>怎么设置成一直监听呢</a>
                    </h2>
                    <p class="excerpt"><strong class="key">php</strong> socket server.<strong class="key">php</strong>怎么设置成一直监听呢 一关了xshell 就不能用了 菜鸟求教</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000003853123" target="_blank">macport 安装<strong class="key">php</strong>55 后如何编译<strong class="key">PHP</strong> 安装其他插件？</a>
                    </h2>
                    <p class="excerpt">使用macport 安装了<strong class="key">php</strong>55 <strong class="key">php</strong>55-fpm 等。。 装好的<strong class="key">php</strong>环境中缺少iconv等函数库， 搜索了一下很多安装的办法，都是编译<strong class="key">php</strong>目录进行安装，如下所示：http://<strong class="key">php</strong>.net/manual/zh/iconv.installation.<strong class="key">php</strong> 可是macport...</p>
                </section>
                <section class="widget-question">
                    <h2 class="h4">
                        <span class="label label-success pull-left mr5">解决</span>                                <a href="/q/1010000000463947" target="_blank"><strong class="key">php</strong>5.4命令行运行<strong class="key">php</strong>报错</a>
                    </h2>
                    <p class="excerpt">我把<strong class="key">php</strong>.ini里magic_开头的参数都注释了然后重启还是没法运行，百度无果,有碰到过并解决的大神吗- - directive magic_quotes_gpc is no longer available in <strong class="key">php</strong></p>
                </section>


                <div class="text-center">
                    <ul class="pagination"><li class="active"><a href="javascript:void(0);">1</a></li><li><a href="/search?q=php&amp;page=2">2</a></li><li><a href="/search?q=php&amp;page=3">3</a></li><li><a href="/search?q=php&amp;page=4">4</a></li><li><a href="/search?q=php&amp;page=5">5</a></li><li class="disabled"><span>…</span></li><li class="next"><a rel="next" href="/search?q=php&amp;page=2">下一页</a></li></ul>
                </div>
            </div>
            <div class="col-md-3 side">
                <ul class="list-unstyled">
                    <li><a target="_blank" href="https://www.google.com/?gws_rd=ssl#newwindow=1&amp;q=site:segmentfault.com+php">在 Google 中搜索 »</a></li>
                    <li><a target="_blank" href="http://www.baidu.com/s?wd=site%3Asegmentfault.com%20php">在 百度 中搜索 »</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
