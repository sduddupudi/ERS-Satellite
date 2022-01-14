<?php
include 'db_connection.php';
session_start();
include 'admin/helpers/checkAuth.php';
checkRedirect();

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check IP from internet.
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check IP is passed from proxy.
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Get IP address from remote address.
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_geolocation($ipGeolocationApi, $ip, $lang = "en", $fields = "*", $excludes = "")
{
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey=" . $ipGeolocationApi . "&ip=" . $ip . "&lang=" . $lang . "&fields=" . $fields . "&excludes=" . $excludes;
    $cURL = curl_init();

    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));

    return curl_exec($cURL);
}

// IP LOCATION START
$ip = getRealIpAddr();
if (!in_array($ip, ['127.0.0.1', '::1'])) {
    $location = get_geolocation($ipGeolocationApi, $ip);
    $decodedLocation = json_decode($location, true);

    $countryname = $decodedLocation["country_name"];
    $city = $decodedLocation["city"];
    $state = $decodedLocation["state_prov"];
    $ipadd = $decodedLocation["ip"];
    $usrlocation = "$countryname / $state / $city / $ipadd ";
}
// IP LOCATION END

if (isset($_POST['sign_in_button'])) {
    $sign_in_email = $_POST['sign_in_email'];
    $sign_in_password = $_POST['sign_in_password'];
    $encript_password = md5($sign_in_password);
    $user_type = 'subscriber';

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
$row_site = $site_sql->fetch();

$ips_sql = $pdo->prepare("SELECT * FROM index_page_settings");
$ips_sql->execute();
$row_ips = $ips_sql->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $row_site['site_title']; ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/slick.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="login">
    <div class="login_left_content">
        <div class="login_header">
            <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_site['site_logo']; ?>"></a>
        </div>
        <div class="form_body">
            <form class="login_form active" action="" method="POST">
                <h1><?php if (isset($row_ips['sign_in_form_heading'])) {
                        echo $row_ips['sign_in_form_heading'];
                    } ?></h1>
                <span style="color: red;"><?php if (!empty($sign_in_error)) {
                        echo $sign_in_error;
                    } ?></span>

                <div class="form-group">
                    <label>Username</label>
                    <div class="input_field">
                        <span class="input-group-icon"><img src="assets/images/icone_mail.png"></span>
                        <input required type="email" name="sign_in_email" placeholder="Enter your email"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group mb_0">
                    <label>Password</label>
                    <div class="input_field">
                        <span class="input-group-icon"><img src="assets/images/Icone_padlock.png"></span>
                        <input required type="password" name="sign_in_password" placeholder="Enter your Password"
                               class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="termsandcond">
                    <?php if ($row_ips['privacy_policy_text_appears'] == 'yes') {
                        if (isset($row_ips['privacy_policy_text'])) {
                            echo $row_ips['privacy_policy_text'];
                        }
                    } ?>

                    <?php if ($row_ips['privacy_policy_checkbox_text_appears'] == 'yes') { ?>
                        <br><input type="checkbox" id="myCheck" name="test"
                                   required> <?php if (isset($row_ips['privacy_policy_checkbox_text'])) {
                            echo $row_ips['privacy_policy_checkbox_text'];
                        } ?><br>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <input type="submit" name="sign_in_button"
                           value="<?php if (isset($row_ips['sign_in_button_text'])) {
                               echo $row_ips['sign_in_button_text'];
                           } ?>" onclick="myFunction();" class="custom_btn form-control">
                </div>
            </form>
        </div>
    </div>

    <div class="login_slider">
        <div>
            <img src="<?php echo $row_ips["index_page_image"]; ?>">
        </div>
    </div>

    <div class="icon-help">
        <a href="<?php if (isset($row_site['help_link'])) {
            echo $row_site['help_link'];
        } ?>" target="_blank"><img src="assets/images/icone_chatbot.png"></a>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script>
    $(document).ready(function () {
        $('.login_slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true
        });

        $(".login_footer span a").click(function () {
            $(".form_body .login_form").removeClass("active");
            $(".form_body .signup_form").addClass("active");
            $(".login_footer").hide();
            $(".signup_footer").show();
        });

        $(".signup_footer span a").click(function () {
            $(".form_body .signup_form").removeClass("active");
            $(".form_body .login_form").addClass("active");
            $(".login_footer").show();
            $(".signup_footer").hide();
        });
    });
</script>
</body>
</html>