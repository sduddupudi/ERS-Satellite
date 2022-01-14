<?php
include 'header.php';

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();

$setting_sql = $pdo->prepare("SELECT * FROM settings");
$setting_sql->execute();
$row_setting = $setting_sql->fetch();
?>

    <div class="fullscreen_video">
        <div style="position:absolute;top:0;left:0;width:<?php if ($row_setting['pleniere_de_iframe_full_width'] == 'yes') {
            echo '100%';
        } else {
            echo '70%';
        } ?>;height:100%;">
            <iframe src="<?php if (isset($row_lobby['stream_video'])) {
                echo $row_lobby['stream_video'];
            } ?>" frameborder="0" width="640" height="480" allow="autoplay; fullscreen" allowfullscreen
                    style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>

            <div class="back-icon-webinar back_icon_video_plenary">
                <span><img src="assets/images/Icone_exit.png"></span>

                <div class="back-icon-webinar-btn">
                    <a href="<?php echo $siteURL; ?>pleniere">
                        <img src="assets/images/Icone_exit.png">
                        <p>Retour</p>
                    </a>
                </div>
            </div>
        </div>

        <iframe src="https://app.sli.do/event/5pnwevwb" height="100%" width="100%" frameBorder="0"
                style="min-height: 560px;float: right;width: 30%;"></iframe>
    </div>

    <script type="text/javascript" src="https://cdn.pubble.io/javascript/loader.js" defer></script>

<?php include 'footer.php'; ?>