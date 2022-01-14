<?php

include '../config.php';
session_start();
include 'helpers/logOut.php';
include 'helpers/checkAuth.php';
checkRedirect();

$adminURL = $siteURL . 'admin/';

if (isset($_POST['logout_btn'])) {
    logOut();
    checkAuth();
}

$site_sql = $pdo->prepare("SELECT `site_logo`, `site_title`, `site_favicon` FROM lobby");
$site_sql->execute();
$row_site_logo = $site_sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../<?php echo $row_site_logo['site_favicon']; ?>" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $row_site_logo['site_title']; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <link href="css/jquery.timepicker.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<style type="text/css">
    button#logout_btn {
        background: transparent;
        color: black;
        border: none;
    }
</style>

<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="../<?php echo $row_site_logo['site_logo']; ?>" width="226" height="70"
                     style="background: #ffff;padding: 20px 25px 20px 25px;">
            </div>
        </a>
        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="<?php echo $adminURL; ?>">
                <i class="fas fa-fw fa-folder"></i>
                <span>Add Lobby</span></a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-calendar"></i>
                <span>Agenda</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_agenda">List of Agenda</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_agenda">Add Agenda</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_agenda_cat">List of Category</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_agenda_cat">Add category</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsespeaker"
               aria-expanded="true" aria-controls="collapsespeaker">
                <i class="fa fa-volume-up"></i>
                <span>Speakers</span>
            </a>
            <div id="collapsespeaker" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_speakers">list of Speakers</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_speakers">Add Speakers</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseresource"
               aria-expanded="true" aria-controls="collapseresource">
                <i class="fa fa-users"></i>
                <span>Resource</span>
            </a>
            <div id="collapseresource" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_resource">list of Resource</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_resource">Add Resource</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemeeting"
               aria-expanded="true" aria-controls="collapsemeeting">
                <i class="fa fa-handshake"></i>
                <span>Meetings Reply</span>
            </a>
            <div id="collapsemeeting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_meeting">list of Meetings Reply</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_meeting">Add Meetings Reply</a>
                </div>
            </div>
        </li>

        <li class="nav-item"><a class="nav-link" href="<?php echo $adminURL; ?>info_icon"><i
                        class="fas fa-fw fa-folder"></i><span>Info Icon</span></a></li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesetting"
               aria-expanded="true" aria-controls="collapsesetting">
                <i class="fas fa-fw fa-cog"></i>
                <span>Setting</span>
            </a>
            <div id="collapsesetting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>settings">Setting</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>index_page_settings">Index page Setting</a>
                </div>
            </div>
        </li>

        <li class="nav-item"><a class="nav-link" href="<?php echo $adminURL; ?>administration_interface_1"><i
                        class="fas fa-fw fa-user"></i><span>Administration Interface 1</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo $adminURL; ?>administration_interface_2"><i
                        class="fas fa-fw fa-user"></i><span>Administration Interface 2</span></a></li>

        <li class="nav-item"><a class="nav-link" href="<?php echo $adminURL; ?>registration"><i
                        class="fas fa-fw fa-user"></i><span>Add Registration Menu</span></a></li>

        <li class="nav-item"><a class="nav-link" href="<?php echo $adminURL; ?>administration"><i
                        class="fas fa-fw fa-user"></i><span>Add Administration Menu</span></a></li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_user"
               aria-expanded="true" aria-controls="collapse_user">
                <i class="fa fa-volume-up"></i>
                <span>User</span>
            </a>
            <div id="collapse_user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_users">Edit Users</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>upload_user">Upload User</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_strem"
               aria-expanded="true" aria-controls="collapse_strem">
                <i class="fa fa-volume-up"></i>
                <span>Strem Urls</span>
            </a>
            <div id="collapse_strem" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo $adminURL; ?>list_strem_urls">List Urls</a>
                    <a class="collapse-item" href="<?php echo $adminURL; ?>add_urls">Add Urls</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["userName"] ?></span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">

                            <div class="dropdown-divider"></div>
                            <form action="" method="POST">
                                <button type="submit" name="logout_btn" id="logout_btn" class="btn btn-primary">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>