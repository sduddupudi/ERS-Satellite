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

        <div id="coffee_break" class="right_content" style="background-image: url(assets/images/Coffee_Break.png);">
            <?php if ($row_lobby['coffee_break_appears'] == 'yes') { ?>
                <div class="icon_div coffee_break_video_confrence">
                    <span><img src="assets/images/Icone_videoconference.png"></span>

                    <div class="icon_div_hover">
                        <a href="<?php if (isset($row_lobby['coffee_break_join_video_conference'])) {
                            echo $row_lobby['coffee_break_join_video_conference'];
                        } ?>" target="_blank">
                            <img src="assets/images/Icone_videoconference.png">
                            <p><?php if (isset($row_lobby['coffee_break_btn_text'])) {
                                    echo $row_lobby['coffee_break_btn_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="back-icon">
                <span><img src="assets/images/Icone_exit.png"></span>

                <div class="back-icon-btn">
                    <a href="<?php echo $siteURL; ?>lobby.php">
                        <img src="assets/images/Icone_exit.png">
                        <p>back to lobby</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="icon-help">
        <a href="<?php if (isset($row_lobby['help_link'])) {
            echo $row_lobby['help_link'];
        } ?>" target="_blank"><img src="assets/images/icone_chatbot.png"></a>
    </div>

<?php include 'footer.php'; ?>