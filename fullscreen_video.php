<?php
include 'header.php';

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();
?>

<div class="fullscreen_video">
    <iframe src="<?php if (isset($row_lobby['video_url'])) {
        echo $row_lobby['video_url'];
    } ?>" width="100%" height="800" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
</div>

<div class="back-icon-webinar back_icon_video_plenary">
    <span><img src="assets/images/icone_Retour.png"></span>

    <div class="back-icon-webinar-btn">
        <a href="<?php echo $siteURL; ?>lobby">
            <img src="assets/images/icone_Retour.png">
            <p>Go Back</p>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>