<?php 
$user = $this->session->userdata('username');
$status = $this->session->userdata('status');
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/avatar.png') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello <?php echo $user?></p>
                <p>Status : <?php echo $status?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">SIDEBAR NAVIGATION</li>
            <li><a href="<?php echo base_url('index.php/market/Market_apps')?>"><i class="fa fa-fw fa-laptop"></i> Aplikasi Market</a></li>            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-cutlery"></i></span> Kue</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('index.php/market/list_kue') ?>"><i class="fa fa-circle-o"></i> List Kue</a></li>
                    <li><a href="<?php echo base_url('index.php/market/kategori_kue')?>"><i class="fa fa-circle-o"></i> Kategori Kue</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li>
            <li><a href="#"><i class="fa fa-book"></i> Laporan </a></li>
            <li class="header">User Account</li>
            <li><a href="<?php echo base_url('index.php/setting_account') ?>"><i class="fa fa-circle-o text-warning"></i>Setting Account</a></li>
            <li><a href="<?php echo base_url('index.php/welcome/logout')?>"><i class="fa fa-circle-o text-danger"></i>Logout</a></li>
           
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">