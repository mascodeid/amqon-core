<!-- Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url("Home"); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>Q</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>AmQon</b> Core</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>assets/dist/img/avatar4.png" width="160" height="160"
                             class="user-image" alt="User Image">
                        <span
                            class="hidden-xs"><?php echo huruf_besar_awal(auth_user()->username); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url(); ?>assets/dist/img/avatar4.png" width="160" height="160"
                                 class="img-circle" alt="User Image">

                            <p>
                                <?php echo huruf_besar_awal(auth_user()->first_name). ' ' . huruf_besar_awal(auth_user()->last_name) . ' - ' . huruf_besar_awal(auth_user_groups()->name); ?>
                                <small><?php echo huruf_besar_awal(auth_user()->company); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat"><i class="fa fa-gear"></i> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url("auth/logout"); ?>" class="btn btn-default btn-flat"><i
                                        class="fa fa-sign-out"></i> Log out</a>
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
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar4.png" width="160" height="160"
                     class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo huruf_besar_awal(auth_user()->first_name); ?></p>
                <a href=""><i class="fa fa-circle text-success"></i> <?php echo huruf_besar_awal(auth_user_groups()->name); ?>
                </a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php echo menu_samping(); ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- end header -->
