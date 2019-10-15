<ul class="sidebar-menu" id="root_menu">
    <li class="header">管理菜单</li>
    <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> <span>首页</span> </a></li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> <span>全局</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="global">
            @if(Auth()->user()->hasPermission('admin.setting.website'))
                <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-circle-o"></i> 站点设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.email'))
                <li><a href="{{ route('admin.setting.email') }}"><i class="fa fa-circle-o"></i> 邮箱设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.register'))
                <li><a href="{{ route('admin.setting.register') }}"><i class="fa fa-circle-o"></i> 注册设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.time'))
                <li><a href="{{ route('admin.setting.time') }}"><i class="fa fa-circle-o"></i> 时间设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.irrigation'))
                <li><a href="{{ route('admin.setting.irrigation') }}"><i class="fa fa-circle-o"></i> 防灌水设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.credits'))
                <li><a href="{{ route('admin.setting.credits') }}"><i class="fa fa-circle-o"></i> 积分设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.seo'))
                <li><a href="{{ route('admin.setting.seo') }}"><i class="fa fa-circle-o"></i> SEO设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.custom'))
                <li><a href="{{ route('admin.setting.custom') }}"><i class="fa fa-circle-o"></i> 功能定制</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.attach'))
                <li><a href="{{ route('admin.setting.attach') }}"><i class="fa fa-circle-o"></i> 附件设置</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.system.index'))
                <li><a href="{{ route('admin.system.index') }}"><i class="fa fa-circle-o"></i> 系统工具</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.banIp.index'))
                <li><a href="{{ route('admin.banIp.index') }}"><i class="fa fa-circle-o"></i> IP黑名单</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.operationLog.index'))
                <li><a href="{{ route('admin.operationLog.index') }}"><i class="fa fa-circle-o"></i> 操作日志</a></li>
            @endif
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>用户</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="manage_user">
            @if(Auth()->user()->hasPermission('admin.user.index'))
                <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> 用户管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.authentication.index'))
                <li><a href="{{ route('admin.authentication.index') }}"><i class="fa fa-circle-o"></i> 专家管理</a></li>
            @endif
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>内容</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="manage_content">
            @if(Auth()->user()->hasPermission('admin.question.index'))
                <li><a href="{{ route('admin.question.index') }}"><i class="fa fa-circle-o"></i> 问题管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.answer.index'))
                <li><a href="{{ route('admin.answer.index') }}"><i class="fa fa-circle-o"></i> 回答管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.article.index'))
                <li><a href="{{ route('admin.article.index') }}"><i class="fa fa-circle-o"></i> 文章管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.comment.index'))
                <li><a href="{{ route('admin.comment.index') }}"><i class="fa fa-circle-o"></i> 评论管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.draft.index'))
                <li><a href="{{ route('admin.draft.index') }}"><i class="fa fa-circle-o"></i> 草稿管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.tag.index'))
                <li><a href="{{ route('admin.tag.index') }}"><i class="fa fa-circle-o"></i> 标签管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.category.index'))
                <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-circle-o"></i> 分类管理</a></li>
            @endif
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cutlery"></i> <span>运营</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="operations">
            @if(Auth()->user()->hasPermission('admin.notice.index'))
                <li><a href="{{ route('admin.notice.index') }}"><i class="fa fa-circle-o"></i> 公告管理</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.recommendation.index'))
                <li><a href="{{ route('admin.recommendation.index') }}"><i class="fa fa-circle-o"></i> 首页推荐</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.goods.index'))
                <li><a href="{{ route('admin.goods.index') }}"><i class="fa fa-circle-o"></i> 积分商城</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.exchange.index'))
                <li><a href="{{ route('admin.exchange.index') }}"><i class="fa fa-circle-o"></i> 兑换记录</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.friendshipLink.index'))
                <li><a href="{{ route('admin.friendshipLink.index') }}"><i class="fa fa-circle-o"></i> 友情链接</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.report.index'))
                <li><a href="{{ route('admin.report.index') }}"><i class="fa fa-circle-o"></i> 举报管理</a></li>
            @endif
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-database"></i> <span>财务</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="finance">
            @if(Auth()->user()->hasPermission('admin.credit.index'))
                <li><a href="{{ route('admin.credit.index') }}"><i class="fa fa-circle-o"></i> 积分管理</a></li>
                <li><a href="{{ route('admin.credit.create') }}"><i class="fa fa-circle-o"></i> 积分充值</a></li>
            @endif
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-recycle"></i> <span>系统整合</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="third_part">
            @if(Auth()->user()->hasPermission('admin.setting.xunSearch'))
                <li><a href="{{ route('admin.setting.xunSearch') }}"><i class="fa fa-circle-o"></i> XunSearch</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.oauth'))
                <li><a href="{{ route('admin.setting.oauth') }}"><i class="fa fa-circle-o"></i>一键登录</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.geetest'))
                <li><a href="{{ route('admin.setting.geetest') }}"><i class="fa fa-circle-o"></i>极验证整合</a></li>
            @endif
            @if(Auth()->user()->hasPermission('admin.setting.sms'))
                <li><a href="{{ route('admin.setting.sms') }}"><i class="fa fa-circle-o"></i>短信整合</a></li>
            @endif
        </ul>
    </li>


    <li class="header">常用菜单</li>
    <li><a href="{{ route('website.index') }}" target="_blank"><i class="fa fa-circle-o text-success"></i>
            <span>网站首页</span></a></li>
    <li><a href="{{ route('admin.tool.clearCache') }}"><i class="fa fa-circle-o text-info"></i>
            <span>清空缓存</span></a>
    </li>
    <li><a href="http://www.tipask.com" target="_blank"><i class="fa fa-circle-o text-yellow"></i> <span>官方求助</span></a>
    </li>
</ul>
