<?php
include 'header.php';

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();
?>
    <div id="main-wrapper">
        <div class="sidebar-main">
            <div class="logo-main">
                <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_lobby['site_logo']; ?>"></a>
            </div>

            <div class="sidebar-toggle-main">
                <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
            </div>

            <div class="sidebar-map-main">
                <a href="javascript:void(0)"><img src="assets/images/icone-map.png"></a>
            </div>
            <?php if ($row_lobby['footer_hyperlink_text_appears'] == 'yes') { ?>
                <div class="mentionlégales">
                    <a href="<?php if (isset($row_lobby['footer_hyperlink'])) {
                        echo $row_lobby['footer_hyperlink'];
                    } ?>" target=”_blank” style="color:#ED1C24; font-size:10px">
                        <p><?php if (isset($row_lobby['footer_hyperlink_text'])) {
                                echo $row_lobby['footer_hyperlink_text'];
                            } ?></p></a>
                </div>
            <?php } ?>
        </div>

        <div id="breakout_4" class="right_content" style="background-image: url(assets/images/conf_4.png);">
            <?php if ($row_lobby['breakout_4_appears'] == 'yes') { ?>
                <div class="icon_div video_confrence">
                    <span><img src="assets/images/Icone_videoconference.png"></span>
                    <div class="icon_div_hover">
                        <a href="<?php if (isset($row_lobby['breakout4_join_video_conference'])) {
                            echo $row_lobby['breakout4_join_video_conference'];
                        } ?>" target="_blank">
                            <img src="assets/images/Icone_videoconference.png">
                            <p><?php if (isset($row_lobby['cardio_metabolic_btn_text'])) {
                                    echo $row_lobby['cardio_metabolic_btn_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="back-icon">
                <span><img src="assets/images/Icone_exit.png"></span>
                <div class="back-icon-btn">
                    <a href="<?php echo $siteURL; ?>corridor1.php">
                        <img src="assets/images/Icone_exit.png">
                        <p>back to corridor</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile_footer d-none">
        <ul class="d-flex">
            <li>
                <a href="lobby.php">
                    <img src="assets/images/lobby_icon_active.png">
                </a>
            </li>
            <li>
                <a href="pleniere.php">
                    <img src="assets/images/plenary_icon.png">
                </a>
            </li>
            <li>
                <a href="breakout1.php">
                    <img src="assets/images/break1_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout2.php">
                    <img src="assets/images/break2_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout3.php">
                    <img src="assets/images/break3_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout4.php">
                    <img src="assets/images/break4_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout5.php">
                    <img src="assets/images/break5_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout6.php">
                    <img src="assets/images/break6_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout7.php">
                    <img src="assets/images/break7_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout8.php">
                    <img src="assets/images/break8_icon.jpg">
                </a>
            </li>
            <li>
                <a href="breakout9.php">
                    <img src="assets/images/break9_icon.jpg">
                </a>
            </li>
        </ul>
    </div>

    <div class="icon-help">
        <a href="<?php if (isset($row_lobby['help_link'])) {
            echo $row_lobby['help_link'];
        } ?>" target="_blank"><img src="assets/images/icone_chatbot.png"></a>
    </div>

<?php include 'footer.php'; ?>