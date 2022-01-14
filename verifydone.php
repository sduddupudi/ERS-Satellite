<?php
include 'db_connection.php';

$site_sql = $pdo->prepare("SELECT `site_logo` FROM lobby");
$site_sql->execute();
$row_site_logo = $site_sql->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>

</head>
<body>

<style type="text/css">
    button.backToLogin a {
        color: #fff;
    }
</style>

<div class="login">
    <div class="thank_you_content">
        <div class="login_header">
            <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_site_logo['site_logo']; ?>"></a>
        </div>
        <div class="thanks_message">
            <h1>Thank you for Completion Verification of Email</h1>
            <p>You are able to Login Now</p>
            <button class="backToLogin"><a href="<?php echo $siteURL; ?>">Return to login</a></button>
        </div>
    </div>

    <div class="thank_you_content_slider">
        <div>
            <img src="assets/images/Slideshow_image_2.jpg">
        </div>
    </div>

    <div class="icon-help">
        <a href="<?php if (isset($row_site_logo['help_link'])) {
            echo $row_site_logo['help_link'];
        } ?>" target="_blank"><img src="assets/images/icone_chatbot.png"></a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.thank_you_content_slider').slick({
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