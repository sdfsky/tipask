<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Tipask管理后台</title>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/static/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/css/icheck/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/js/scojs/sco.message.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/js/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('/static/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/css/admin/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini @if($sidebar_collapse) sidebar-collapse @endif">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->

        <div class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>T</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg text-center">
                <a class="navbar-brand admin_logo" href="{{ route('admin.index.index') }}"></a>
            </span>

        </div>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" id="sliderbar_control"  data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            @if(array_sum($notVerifiedData)>0)
                            <span class="label label-warning">@if(array_sum($notVerifiedData)>99)99+@else{{ array_sum($notVerifiedData) }}@endif</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">共有 {{ array_sum($notVerifiedData) }} 个待处理事项</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                @if(array_sum($notVerifiedData)>0)
                                <ul class="menu">
                                    @if( $notVerifiedData['users'] > 0 )
                                    <li>
                                        <a href="{{ route('admin.user.index') }}?status=0">
                                            <i class="fa fa-user-circle text-yellow"></i> {{ $notVerifiedData['users'] }} 个用户需要审核
                                        </a>
                                    </li>
                                    @endif
                                    @if( $notVerifiedData['experts'] > 0 )
                                        <li>
                                            <a href="{{ route('admin.authentication.index') }}?status=0">
                                                <i class="fa fa-graduation-cap text-yellow"></i> {{ $notVerifiedData['experts'] }} 个专家认证需要审核
                                            </a>
                                        </li>
                                    @endif
                                    @if( $notVerifiedData['questions'] > 0 )
                                    <li>
                                        <a href="{{ route('admin.question.index') }}?status=0">
                                            <i class="fa fa-question-circle text-yellow"></i> {{ $notVerifiedData['questions'] }} 个问题需要审核
                                        </a>
                                    </li>
                                    @endif
                                   @if( $notVerifiedData['answers'] > 0  )
                                    <li>
                                        <a href="{{ route('admin.answer.index') }}?status=0">
                                            <i class="fa fa-comment-o text-yellow"></i> {{ $notVerifiedData['answers'] }} 个回答需要审核
                                        </a>
                                    </li>
                                   @endif
                                   @if( $notVerifiedData['articles'] > 0  )
                                    <li>
                                        <a href="{{ route('admin.article.index') }}?status=0">
                                            <i class="fa fa-book text-yellow"></i> {{ $notVerifiedData['articles'] }} 篇文章需要审核
                                        </a>
                                    </li>
                                    @endif
                                    @if( $notVerifiedData['comments'] > 0  )
                                    <li>
                                        <a href="{{ route('admin.comment.index') }}?status=0">
                                            <i class="fa fa-comments-o text-yellow"></i> {{ $notVerifiedData['comments'] }} 个评论需要审核
                                        </a>
                                    </li>
                                    @endif
                                    @if( $notVerifiedData['exchanges'] > 0  )
                                        <li>
                                            <a href="{{ route('admin.exchange.index') }}?status=0">
                                                <i class="fa fa-exchange text-yellow"></i> {{ $notVerifiedData['exchanges'] }} 个兑换申请需要审核
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ get_user_avatar(Auth()->user()->id,'middle') }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{ Auth()->user()->name }}
                                    <small>{{ Auth()->user()->title }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{--<div class="pull-left">--}}
                                    {{--<a href="#" class="btn btn-default btn-flat">修改密码</a>--}}
                                {{--</div>--}}
                                <div class="pull-right">
                                    <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">退出登录</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
           @include('admin/public/menu')
        </section>
        <!-- /.sidebar -->



    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')
    </div><!-- /.content-wrapper -->

    @include('admin/public/footer')

</div><!-- ./wrapper -->

<!--scripts-->
@include('admin/public/script')

@yield('script')

</body>
</html>
