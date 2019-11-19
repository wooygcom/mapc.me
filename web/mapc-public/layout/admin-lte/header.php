<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= ROOT_URL; ?>smu/camps" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?= $campDetail['DISP_NAME']; ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= $campDetail['DISP_NAME']; ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"><?= _('메뉴'); ?></span>
      </a>

<?php
/*
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 messages</li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 notifications</li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li class="footer"><a href="#">View all tasks</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= ROOT_URL; ?>layout/admin-lte/images/if_male_628288.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $v['user']->name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= ROOT_URL; ?>layout/admin-lte/images/if_male_628288.png" class="img-circle" alt="User Image">

                <p>
                  <?= $v['user']->name; ?>
                  <small><?= $v['user']->group; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><?= _('정보보기'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?= ROOT_URL; ?>smu/users/signout" class="btn btn-default btn-flat"><?= _('로그아웃'); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
*/
?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= ROOT_URL; ?>layout/admin-lte/images/if_male_628288.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $v['user']->name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> ||
          <a href="<?= ROOT_URL; ?>smu/users/signout"></i> 로그아웃</a>
        </div>
      </div>
      <!-- search form -->
<!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?= _('메뉴'); ?></li>
        <li>
          <a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/info">
            <i class="fa fa-info-circle"></i> <span>내 정보</span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-edit"></i> <span>페이지관리</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu active">
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/intro/edit"><i class="fa fa-circle-o"></i>인사말</a></li>
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/history/edit"><i class="fa fa-circle-o"></i>연혁</a></li>
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/impellent/edit"><i class="fa fa-circle-o"></i>추진방향</a></li>
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/activities/edit"><i class="fa fa-circle-o"></i>주요활동</a></li>
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/orgsoc/edit"><i class="fa fa-circle-o"></i>운동조직</a></li>
            <li><a href="<?= ROOT_URL; ?>smu/camps/<?= $v['group1'] ?>/<?= $v['group2']; ?>/orgwork/edit"><i class="fa fa-circle-o"></i>사무조직</a></li>
          </ul>
        </li>
<!--
        <li>
          <a href="#" onclick="javascript:alert('준비중입니다.');">
            <i class="fa fa-th"></i> <span>활동소식</span>
          </a>
        </li>
        <li>
          <a href="#" onclick="javascript:alert('준비중입니다.');">
            <i class="fa fa-share"></i> <span>하부조직관리</span>
          </a>
        </li>
-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $v['pageTitle']; ?>
        <small>.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
