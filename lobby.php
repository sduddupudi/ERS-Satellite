<?php
include 'header.php';

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();

$info_icon_sql = $pdo->prepare("SELECT * FROM info_icon");
$info_icon_sql->execute();
$row_info_icon = $info_icon_sql->fetch();
?>

<style>
    body {
        overflow: hidden;
    }
</style>

<div id="main-wrapper">
    <div class="sidebar-main">
        <div class="logo-main">
            <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_lobby['site_logo']; ?>"></a>
        </div>
        <div class="sidebar-toggle-main">
            <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
        </div>
        <div class="sidebar-map-main">
            <a href="javascript:void(0)"><i class="fa fa-map-marker"></i></a>
        </div>
        <?php if ($row_lobby['footer_hyperlink_text_appears'] == 'yes') { ?>
            <div class="mentionlegal d-none">
                <a href="<?php if (isset($row_lobby['footer_hyperlink'])) {
                    echo $row_lobby['footer_hyperlink'];
                } ?>" target=”_blank” style="color:#1272DE; font-size:10px">
                    <p><?php if (isset($row_lobby['footer_hyperlink_text'])) {
                            echo $row_lobby['footer_hyperlink_text'];
                        } ?></p>
                </a>
            </div>
        <?php } ?>
    </div>

    <?php if (!empty($row_lobby['background_img'])){ ?>
    <div id="lobby" class="right_content" style="background-image: url(<?php echo $row_lobby['background_img'] ?>);">
        <?php }else{ ?>
        <div id="lobby" class="right_content" style="background-image: url(https://digiplace.s3.eu-west-3.amazonaws.com/Lobby.png);">
            <?php } ?>
            <?php if ($row_lobby['stream_video_appears'] == 'yes') { ?>
                <div class="go-plenary">
                    <span><img src="<?php echo $row_lobby["pleanry_icon"]; ?>"></span>
                    <div class="go-plenary-btn">
                        <a href="<?php echo $siteURL; ?>pleniere.php">
                            <img src="<?php echo $row_lobby["pleanry_icon"]; ?>">
                            <p><?php if (isset($row_lobby['pleanry_text'])) {
                                    echo $row_lobby['pleanry_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <?php if ($row_lobby['information_text_appears'] == 'yes') { ?>
                <div class="info-icon">
                    <span><img src="<?php echo $row_lobby["information_icon"]; ?>"></span>
                    <div class="go-atelier-btn">
                        <a href="<?php echo $siteURL; ?>atelier.php">
                            <img src="<?php echo $row_lobby["information_icon"]; ?>">
                            <p><?php if (isset($row_lobby['atelier_text'])) {
                                    echo $row_lobby['atelier_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <?php if ($row_lobby['help_desk_appears'] == 'yes') { ?>
                <div class="helpdesk-girl-icon">
                    <a href="<?php if (isset($row_lobby['help_desk'])) {
                        echo $row_lobby['help_desk'];
                    } ?>" target="_blank">
                        <div class="helpdesk-girl-icon1">
                            <img src="<?php echo $row_lobby["help_desk_icon"]; ?>">
                        </div>
                        <div class="helpdesk-girl-icon2">
                            <img src="<?php echo $row_lobby["help_desk_icon"]; ?>">
                        </div>

                        <p><?php if (isset($row_lobby['help_desk_text'])) {
                                echo $row_lobby['help_desk_text'];
                            } ?> </p>
                    </a>
                </div>
            <?php } ?>

            <?php if ($row_lobby['atelier_stream_video_appears'] == 'yes') { ?>
                <div class="go-atelier">
                    <span><img src="<?php echo $row_lobby["atelier_icon"]; ?>"></span>
                    <div class="go-atelier-btn">
                        <a href="<?php echo $siteURL; ?>atelier.php">
                            <img src="<?php echo $row_lobby["atelier_icon"]; ?>">
                            <p><?php if (isset($row_lobby['atelier_text'])) {
                                    echo $row_lobby['atelier_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <?php if ($row_lobby['resources_icon_appears'] == 'yes') { ?>
                <div class="go-ressources">
                    <span><img src="<?php echo $row_lobby["resources_icon"]; ?>"></span>
                    <div class="go-ressources-btn">
                        <a href="javascript:void(0)">
                            <img src="<?php echo $row_lobby["resources_icon"]; ?>">
                            <p><?php if (isset($row_lobby['resources_text'])) {
                                    echo $row_lobby['resources_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="watch-video-full">
                <span><img src="assets/images/icone_fullscreen.png"></span>
                <div class="watch-video-full-btn">
                    <a href="<?php echo $siteURL; ?>fullscreen_video.php" target="_blank">
                        <img src="assets/images/icone_fullscreen.png">
                        <p>Watch the video in fullscreen</p>
                    </a>
                </div>
            </div>

            <?php if ($row_lobby['resources_icon_appears'] == 'yes') { ?>
                <div class="go-ressources">
                    <span><img src="<?php echo $row_lobby["resources_icon"]; ?>"></span>
                    <div class="go-ressources-btn">
                        <a href="javascript:void(0)">
                            <img src="<?php echo $row_lobby["resources_icon"]; ?>">
                            <p><?php if (isset($row_lobby['resources_text'])) {
                                    echo $row_lobby['resources_text'];
                                } ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="go-corridor1">
                <span><img src="assets/images/Icone_arrow-right.png"></span>
                <div class="go-corridor1-btn">
                    <a href="<?php echo $siteURL; ?>corridor1.php">
                        <img src="assets/images/Icone_arrow-right.png">
                        <p>Go to Corridor 1</p>
                    </a>
                </div>
            </div>

            <div class="container d-flex justify-content-center align-items-center h-100">
                <div class="row" style="margin-top: 180px;">
                    <?php if ($row_lobby['stream_video_appears'] == 'yes') { ?>
                        <div class="col-md-6">
                            <a href="<?php echo $siteURL; ?>pleniere" class="btn lobby_btn btn-block mb-3">
                                <img src="admin/uploads/image/right-arrow.png" class="mr-3" width="24">
                                <span><?php if (isset($row_lobby['pleanry_text'])) {
                                        echo $row_lobby['pleanry_text'];
                                    } ?></span>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if ($row_lobby['information_text_appears'] == 'yes') { ?>
                        <div class="col-md-6">
                            <a href="<?php echo $siteURL; ?>atelier.php" class="btn lobby_btn btn-block mb-3">
                                <img src="admin/uploads/image/right-arrow.png" class="mr-3" width="24">
                                <span><?php if (isset($row_lobby['atelier_text'])) {
                                        echo $row_lobby['atelier_text'];
                                    } ?></span>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if ($row_lobby['resources_icon_appears'] == 'yes') { ?>
                        <div class="col-md-6">
                            <a href="#" class="btn lobby_btn btn-block mb-3">
                                <img src="admin/uploads/image/right-arrow.png" class="mr-3" width="24">
                                <span><?php if (isset($row_lobby['resources_text'])) {
                                        echo $row_lobby['resources_text'];
                                    } ?></span>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="col-md-6">
                        <a href="<?php echo $siteURL; ?>corridor1.php" class="btn lobby_btn btn-block mb-3">
                            <img src="admin/uploads/image/right-arrow.png" class="mr-3" width="24">
                            <span>Go To Corridor 2</span>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="<?php echo $siteURL; ?>fullscreen_video.php" target="_blank"
                           class="btn lobby_btn btn-block mb-3">
                            <img src="admin/uploads/image/right-arrow.png" class="mr-3" width="24">
                            <p>Watch the video in fullscreen</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

