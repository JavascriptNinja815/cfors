<?php
if (isset($this->session->userdata['logged_in'])) {
$email = ($this->session->userdata['logged_in']['email']);
} else {
  redirect("UserAuthentication/user_login_process");
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cfors | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css');?>">
 <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css');?>">
 <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('css/AdminLTE.min.css');?>">
   <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('css/_all-skins.min.css');?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('css/morris.css');?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('css/jquery-jvectormap.css');?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap-datepicker.min.css');?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('css/daterangepicker.css');?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap3-wysihtml5.min.css');?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css');?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
   <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }
    .custom-td {
      width: 100px;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> Cfors </b> <!-- <small>My </small> --> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('images/img_u.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('images/img_u.jpg');?>" class="img-circle" alt="User Image">

                <p>
                  Admin
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a href="<?php echo site_url(); ?>/UserAuthentication/profile" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url(); ?>/UserAuthentication/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i>  Sign out</a>
                </div>
                <li>                        
          </li>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
          <img src="<?php echo base_url('images/img_u.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
        <li class="active"><a href="<?php echo site_url('DashbordController');?>"><i class="fa fa-dashboard"></i> Dashbord </a></li>
        <li><a href="<?php echo site_url('UsersController');?>"><i  class="fa fa-user-plus"></i>Users </a></li>
        <li><a href="<?php echo site_url('VedioController');?>"><i class="fa fa-video-camera"></i>Vedios List </a></li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
