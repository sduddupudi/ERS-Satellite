<?php
include '../db_connection.php';
session_start();
include 'helpers/checkAuth.php';
checkRedirect();

if (isset($_POST['sign_in__button'])) {
    $sign_in_email = $_POST['sign_in_email'];
    $sign_in_password = $_POST['sign_in_password'];
    $encript_password = md5($sign_in_password);
    $user_type = 'customer';

    $stmt = $pdo->prepare("SELECT * FROM user WHERE `userName` = ? AND `userType` = ?");
    $stmt->execute([
        $sign_in_email,
        $user_type
    ]);
    $row = $stmt->fetch();

    if (!empty($row)) {
        if ($row['loginAttempt'] < 3) {
            if ($row['Password'] === $encript_password) {
                $query = "INSERT INTO `loginout` (`user_id`, `username`, `logout`) VALUES (:userID, :userName, NOW())";
                $params = [
                    ':userID' => $row['userID'],
                    ':userName' => $row['userName']
                ];
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $last_id = $pdo->lastInsertId();

                $_SESSION["userID"] = $row['userID'];
                $_SESSION["userName"] = $row['userName'];
                $_SESSION["userType"] = $row['userType'];

                checkRedirect();
            } else {
                $params = [
                    'login_attempt' => $row['loginAttempt'] + 1,
                    'user_id' => $row['userID']
                ];

                $update_sql = "UPDATE user SET 
                    loginAttempt=:login_attempt
                WHERE
                    userID=:user_id";

                $stmt = $pdo->prepare($update_sql);
                $stmt->execute($params);

                $sign_in_error = "Error: Incorrect username or password. Please try again!";
            }
        } else {
            $sign_in_error = "Error: 3 incorrect authentication attempts. Account blocked!";
        }
    } else {
        $sign_in_error = "Error: Incorrect username or password. Please try again!";
    }
}

$site_sql = $pdo->prepare("SELECT `site_logo`, `help_link`, `site_title` FROM lobby");
$site_sql->execute();
$row_site_logo = $site_sql->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $row_site_logo['site_title']; ?></title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/slick.min.css" rel="stylesheet"/>
    <link href="css/slick-theme.min.css" rel="stylesheet"/>

    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/responsive.css" rel="stylesheet">
</head>
<body>

<div class="login">
    <div class="login_left_content">
        <div class="login_header">
            <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_site_logo['site_logo']; ?>"></a>
        </div>
        <div class="form_body">
            <form class="login_form <?php if (empty($sign_up_error)) {
                echo 'active';
            } ?> " action="" method="POST">
                <h1>Enter Password</h1>
                <span style="color: red;"><?php if (!empty($sign_in_error)) {
                        echo $sign_in_error;
                    } ?></span>
                <span style="color: #4be84b;"><?php if (!empty($sign_up_sucess)) {
                        echo $sign_up_sucess;
                    } ?></span>
                <div class="form-group sign_in_email">
                    <label></label>
                    <div class="input_field">
                        <span class="input-group-icon"><img src="../assets/images/icone_mail.png"></span>
                        <input type="email" name="sign_in_email" placeholder="Enter your email" class="form-control">
                    </div>
                </div>
                <div class="form-group mb_0">
                    <label></label>
                    <div class="input_field">
                        <span class="input-group-icon"><img src="../assets/images/Icone_padlock.png"></span>
                        <input type="password" name="sign_in_password" placeholder="Enter your Password"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="sign_in__button" value="Sign In" class="custom_btn form-control">
                </div>
            </form>
        </div>
    </div>

    <div class="login_slider">
        <div>
            <img src="../assets/images/Slideshow_image_1.jpg">
        </div>
    </div>

    <div class="icon-help">
        <a href="<?php if (isset($row_site_logo['help_link'])) {
            echo $row_site_logo['help_link'];
        } ?>" target="_blank"><img src="../assets/images/icone_chatbot.png"></a>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.login_slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true
        });
    });
</script>

</body>
</html>