
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/admin/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admin/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/themer.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admin/css/style.css" media="screen">

<title>@yield('title')</title>
<style type="text/css">
    body, 
#mws-container
{
    background-image:url('/admin/images/core/bg/diamond_upholstery.png');
}

#mws-sidebar, 
#mws-sidebar-bg, 
#mws-header, 
.mws-panel .mws-panel-header, 
#mws-login, 
#mws-login .mws-login-lock, 
.ui-accordion .ui-accordion-header, 
.ui-tabs .ui-tabs-nav, 
.ui-datepicker, 
.fc-event-skin, 
.ui-dialog .ui-dialog-titlebar, 
.jGrowl .jGrowl-notification, .jGrowl .jGrowl-closer, 
#mws-user-tools .mws-dropdown-menu .mws-dropdown-box, 
#mws-user-tools .mws-dropdown-menu.open .mws-dropdown-trigger
{
    background-color:#ff4f03;
}

#mws-header
{
    border-color:#69bf00;
}

.mws-panel .mws-panel-header span, 
#mws-navigation ul li.active a, 
#mws-navigation ul li.active span, 
#mws-user-tools #mws-username, 
#mws-navigation ul li .mws-nav-tooltip, 
#mws-user-tools #mws-user-info #mws-user-functions #mws-username, 
.ui-dialog .ui-dialog-title, 
.ui-state-default, 
.ui-state-active, 
.ui-state-hover, 
.ui-state-focus, 
.ui-state-default a, 
.ui-state-active a, 
.ui-state-hover a, 
.ui-state-focus a
{
    color:#10e8b9;
    text-shadow:0 0 6px rgba(42, 59, 212, 0.5);
}

#mws-searchbox .mws-search-submit, 
.mws-panel .mws-panel-header .mws-collapse-button span, 
.dataTables_wrapper .dataTables_paginate .paginate_disabled_previous, 
.dataTables_wrapper .dataTables_paginate .paginate_enabled_previous, 
.dataTables_wrapper .dataTables_paginate .paginate_disabled_next, 
.dataTables_wrapper .dataTables_paginate .paginate_enabled_next, 
.dataTables_wrapper .dataTables_paginate .paginate_active, 
.mws-table tbody tr.odd:hover td, 
.mws-table tbody tr.even:hover td, 
.ui-slider-horizontal .ui-slider-range, 
.ui-slider-vertical .ui-slider-range, 
.ui-progressbar .ui-progressbar-value, 
.ui-datepicker td.ui-datepicker-current-day, 
.ui-datepicker .ui-datepicker-prev, 
.ui-datepicker .ui-datepicker-next, 
.ui-accordion-header .ui-accordion-header-icon, 
.ui-dialog-titlebar-close
{
    background-color:#69bf00;
}

</style>

</head>

<body>

    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <!-- <img src="/admin/images/mws-logo.png" alt="mws admin"> -->

                <h3 style='color:white'>lamp214后台</h3>
            </div>
        </div>
        @php
            $uid = session('uid');

            $rs =  DB::table('users')
            ->join('message','users.id','=','message.uid')
            
            ->select('users.*','message.header')
            ->where('users.id','=',$uid)
            ->first();

             $res = DB::table('users')->where('id',$uid)->first();
        @endphp
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
            <!-- User Information and functions section -->
            <a<div id="mws-user-info" class="mws-inset">
            
                <!-- User Photo -->
                <div id="mws-user-photo">
                    @if($rs)
                        <a href="{{$rs->header}}" target="_blank"><img src="{{$rs->header}}" alt="User Photo"></a>
                    @else
                        <img src="/default.jpg" alt="User Photo"></a>
                        
                        
                    @endif
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        @if($res)
                        {{$res->username}}

                        @else
                        XXXX欢迎您

                        @endif
                        
                    </div>
                    <ul>
                        <li><a href="/admins/header">修改头像</a></li>
                        <li><a href="/admins/pass">修改密码</a></li>
                        <li><a href="/admins/logout">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
                <div id="mws-sidebar-stitch"></div>
                <div id="mws-sidebar-bg"></div>
                
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
            <!-- Main Navigation -->
            <div id="mws-navigation">

                 <ul>
                    <li>
                        <a href="#"><i class="icon-users"></i>管理员管理</a>
                        <ul class='closed'>
                            <li><a href="/admins/user/create">添加管理员</a></li>
                            <li><a href="/admins/user">浏览管理员</a></li>
                        </ul>
                    </li>
                   
                </ul> 
                <ul>
                    <li>
                        <a href="#"><i class="icon-user"></i>角色管理</a>
                        <ul class='closed'>
                            <li><a href="/admins/role/create">添加角色</a></li>
                            <li><a href="/admins/role">浏览角色</a></li>
                        </ul>
                    </li>
                   
                </ul> 
                 <ul>
                    <li>
                        <a href="#"><i class="icon-key"></i>权限管理</a>
                        <ul class='closed'>
                            <li><a href="/admins/permission/create">添加权限</a></li>
                            <li><a href="/admins/permission">浏览权限</a></li>
                        </ul>
                    </li>
                   
                </ul> 

                
                <ul>
                    <li>
                        <a href="#"><i class="icon-archive"></i>分类管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/type">浏览分类</a></li>
                            <li><a href="/admin/type/create">添加分类</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-shopping-cart"></i>商品管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/goods">浏览商品</a></li>
                            <li><a href="/admin/goods/create">添加商品</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            @section('content')


            @show             
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <!-- <script src="/admin/js/libs/jquery-1.8.3.min.js"></script> -->
    <!-- <script src="/js/jquery.js"></script> -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/admin/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/admin/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/admin/jui/jquery-ui.custom.min.js"></script>
    <script src="/admin/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admin/plugins/flot/jquery.flot.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/admin/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/admin/plugins/validate/jquery.validate-min.js"></script>
    <script src="/admin/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/admin/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/admin/js/demo/demo.dashboard.js"></script>

</body>
</html>
@section('js')

@show