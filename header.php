<?php
include 'db_connection.php';
session_start();
include 'admin/helpers/logOut.php';
include 'admin/helpers/checkAuth.php';

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
    <link rel="shortcut icon" href="<?php echo $row_site_logo['site_favicon']; ?>" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $row_site_logo['site_title']; ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.min.css"/>
    <script src="assets/js/jquery.min.js"></script>

    <style type="text/css">
        @media (max-width: 767px) {
            .icon-help {
                display: none;
            }
        }

        button#logout_btn {
            background: transparent;
            color: black;
            border: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
</head>

<body>