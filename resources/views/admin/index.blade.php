<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title> 主页</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css?v=4.1.0')}}" rel="stylesheet">
    <style>
        .nav > li > a .glyphicon {
            margin-right: 6px;
        }
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">hAdmin</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">hAdmin
                        </div>
                    </li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">控制台</span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('index_v1')}}">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('cart')}}">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-label">购物</span>
                        </a>
                    </li>
                    <li class="line dk"></li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">管理</span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('user')}}"><i class="fa fa-users"></i> <span class="nav-label">售货员 </span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('type')}}"><i class="fa fa-tty"></i> <span class="nav-label">类型 </span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('goods')}}"><i class="fa fa-gift"></i> <span class="nav-label">商品 </span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('discount')}}"><i class="fa fa-minus"></i> <span class="nav-label">折扣 </span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('notice/edit')}}"><i class="fa fa-bell"></i> <span class="nav-label">公告 </span></a>
                    </li>
                    <li class="line dk"></li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">统计</span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('memberList')}}"><i class="fa fa-user"></i> <span class="nav-label">会员列表 </span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('adminOrder')}}"><i class="fa fa-table"></i> <span class="nav-label">订单列表 </span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" src="{{url('index_v1')}}" width="100%" height="100%" frameborder="0" seamless>
                </iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/plugins/layer/layer.min.js')}}"></script>

    <!-- 自定义js -->
    <script src="{{asset('js/hAdmin.js?v=4.1.0')}}"></script>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>

    <!-- 第三方插件 -->
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
<div style="text-align:center;">
<p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</div>
</body>

</html>
