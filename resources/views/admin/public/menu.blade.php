<ul class="sidebar-menu" id="root_menu">
    <li class="header">管理菜单</li>
    <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> <span>首页</span> </a></li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> <span>全局</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="global">
            <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-circle-o"></i> 站点设置</a></li>
            <li><a href="{{ route('admin.setting.email') }}"><i class="fa fa-circle-o"></i> 邮箱设置</a></li>
            <li><a href="{{ route('admin.setting.register') }}"><i class="fa fa-circle-o"></i> 注册设置</a></li>
            <li><a href="{{ route('admin.setting.time') }}"><i class="fa fa-circle-o"></i> 时间设置</a></li>
            <li><a href="{{ route('admin.setting.irrigation') }}"><i class="fa fa-circle-o"></i> 防灌水设置</a></li>
            <li><a href="{{ route('admin.setting.credits') }}"><i class="fa fa-circle-o"></i> 积分设置</a></li>
            <li><a href="{{ route('admin.setting.seo') }}"><i class="fa fa-circle-o"></i> SEO设置</a></li>
            {{--<li><a href="{{ route('admin.setting.variables') }}"><i class="fa fa-circle-o"></i> 变量设置</a></li>--}}
            <li><a href="{{ route('admin.system.index') }}"><i class="fa fa-circle-o"></i> 系统工具</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>用户</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="manage_user">
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> 用户管理</a></li>
            <li><a href="{{ route('admin.authentication.index') }}"><i class="fa fa-circle-o"></i> 专家管理</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>内容</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="manage_content">
            <li><a href="{{ route('admin.question.index') }}"><i class="fa fa-circle-o"></i> 问题管理</a></li>
            <li><a href="{{ route('admin.answer.index') }}"><i class="fa fa-circle-o"></i> 回答管理</a></li>
            <li><a href="{{ route('admin.article.index') }}"><i class="fa fa-circle-o"></i> 文章管理</a></li>
            <li><a href="{{ route('admin.comment.index') }}"><i class="fa fa-circle-o"></i> 评论管理</a></li>
            <li><a href="{{ route('admin.tag.index') }}"><i class="fa fa-circle-o"></i> 标签管理</a></li>
            <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-circle-o"></i> 分类管理</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cutlery"></i> <span>运营</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="operations">
            <li><a href="{{ route('admin.notice.index') }}"><i class="fa fa-circle-o"></i> 公告管理</a></li>
            <li><a href="{{ route('admin.recommendation.index') }}"><i class="fa fa-circle-o"></i> 首页推荐</a></li>
            <li><a href="{{ route('admin.goods.index') }}"><i class="fa fa-circle-o"></i> 积分商城</a></li>
            <li><a href="{{ route('admin.exchange.index') }}"><i class="fa fa-circle-o"></i> 兑换记录</a></li>
            <li><a href="{{ route('admin.friendshipLink.index') }}"><i class="fa fa-circle-o"></i> 友情链接</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-database"></i> <span>财务</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="finance">
            <li><a href="{{ route('admin.credit.index') }}"><i class="fa fa-circle-o"></i> 积分管理</a></li>
        </ul>
    </li>


    <li class="treeview">
        <a href="#">
            <i class="fa fa-recycle"></i> <span>第三方</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="third_part">
            <li><a href="{{ route('admin.setting.xunSearch') }}"><i class="fa fa-circle-o"></i> XunSearch</a></li>
            <li><a href="{{ route('admin.setting.oauth') }}"><i class="fa fa-circle-o"></i>一键登录</a></li>
        </ul>
    </li>


    <li class="header">常用菜单</li>
    <li><a href="{{ route('website.index') }}" target="_blank"><i class="fa fa-circle-o text-success"></i> <span>网站首页</span></a></li>
    <li><a href="{{ route('admin.tool.clearCache') }}"><i class="fa fa-circle-o text-info"></i> <span>清空缓存</span></a></li>
    <li><a href="http://www.tipask.com" target="_blank"><i class="fa fa-circle-o text-yellow"></i> <span>官方求助</span></a></li>
</ul>
