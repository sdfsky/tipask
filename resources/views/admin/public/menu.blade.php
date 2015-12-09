<ul class="sidebar-menu">
    <li class="header">管理菜单</li>

    @permission('admin.role.index|admin.permission.index')
    <li class="treeview">
        <a href="#">
            <i class="fa fa-shield"></i> <span>创始人</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="admin">
            @permission('admin.role.index')
            <li><a href="{{ route('admin.role.index') }}"><i class="fa fa-circle-o"></i> 角色管理</a></li>
            @endpermission
            @permission('admin.permission.index')
            <li><a href="{{ route('admin.permission.index') }}"><i class="fa fa-circle-o"></i> 权限管理</a></li>
            @endpermission
        </ul>
    @endpermission

    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> <span>全局</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="global">
            <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-circle-o"></i> 站点设置</a></li>
            <li><a href="{{ route('admin.setting.time') }}"><i class="fa fa-circle-o"></i> 时间设置</a></li>
            <li><a href="{{ route('admin.setting.credits') }}"><i class="fa fa-circle-o"></i> 积分设置</a></li>
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 验证码</a></li>
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 禁止访问</a></li>
        </ul>
    </li>

    @permission('admin.user.index|admin.user.create')
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>用户</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="manage_user">
            @permission('admin.user.create')
            <li><a href="{{ route('admin.user.create') }}"><i class="fa fa-circle-o"></i> 新建用户</a></li>
            @endpermission
            @permission('admin.user.index')
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> 用户管理</a></li>
            @endpermission
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> 新用户审核</a></li>
        </ul>
    </li>
    @endpermission

    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>内容</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 新问题审核</a></li>
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 新回答审核</a></li>
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 问题管理</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> 回答管理</a></li>
        </ul>
    </li>
    <li class="header">常用菜单</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
</ul>
