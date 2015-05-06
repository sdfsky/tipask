<ul class="sidebar-menu">
        <li class="header">管理菜单</li>
        <li @if ($current_menu_url=='/admin/dashboard/index') class="active"@endif><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> <span>总览</span></a></li>
        @define $menu_tree = list_to_tree($_menus)

        @foreach($menu_tree as $_menu)
            @if($_menu['pid']==0)

                @define $menu_urls = array()
                @if (isset($_menu['_child']))
                    @define $menu_urls = array_fetch($_menu['_child'],'url')
                @endif

                <li @if (in_array($current_menu_url,$menu_urls)) class="treeview active" @else class="treeview" @endif>
                    <a href="{{ url($_menu['url']) }}">
                        <i class="{{ $_menu['icon'] }}"></i> <span>{{ $_menu['name'] }}</span>
                        @if (isset($_menu['_child']))
                        <i class="fa fa-angle-left pull-right"></i>
                        @endif
                    </a>
                    @if (isset($_menu['_child']))
                        <ul class="treeview-menu">
                        @foreach($_menu['_child'] as $submenu)
                            <li @if ($current_menu_url==$submenu['url']) class="active"@endif><a href="{{ url($submenu['url']) }}"><i class="fa fa-circle-o"></i>{{ $submenu['name'] }}</a></li>
                        @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
        <li class="header">常用菜单</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
</ul>
