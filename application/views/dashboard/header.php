<?php
if (!isset($loggedin) || $loggedin != true) {
    redirect(base_url() . 'welcome/signIn');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TNT Crud | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/css/style.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assest/plugins/summernote/summernote-bs4.min.css">
    <style>
        #input:active {
            /* border: 2px solid black; */
            outline: 1px solid skyblue;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user" data-toggle="tooltip" data-placement="bottom" title="User Detail"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <div class="d-flex flex-row align-items-center">
                            <span class="col-6">
                                <img class="rounded-circle col-md-12 col-sm-12 my-2" src="<?= base_url() . 'uploads/' . $imgpath  ?>" alt="User Image">
                            </span>
                            <span class="col-6">
                                <p class="" style="font-size:20px;"><?php
                                    echo $username;
                                    ?></p>
                            </span>
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="my-1">
                            <a class="nav-link d-inline" href="<?= base_url() . 'welcome/changepass' ?>">
                                <button class="btn btn-sm btn-outline-info">Change Password</button>
                            </a>
                            <a class="nav-link d-inline" href="<?= base_url() . 'welcome/logout' ?>">
                                <button class="btn btn-sm btn-info my-1">LogOut</button>
                            </a>
                        </div>

                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <?php
        include "sidebar.php";

        // include "main.php";
        ?>