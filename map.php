<?php
include 'header.php';

$setting_menu_sql = $pdo->prepare("SELECT * FROM settings");
$setting_menu_sql->execute();
$row_menu_setting = $setting_menu_sql->fetch();
?>

    <div class="map_container">
        <div class="title_box mb-3">
            <a href="/" class="text-decoration-none"><i class="fa fa-reply-all text-white mt-1" style="float: left; font-size: 20px;"></i></a>
            <h4 class="text-white text-center mb-0">Map</h4>
        </div>
        <div class="row mx-0">
            <?php if ($row_menu_setting['plan_menu'] == 'yes') { ?>
                <div class="col-md-3 col-6">
                    <a href="<?php echo $siteURL; ?>lobby.php" class="d-block text-center py-4 px-3 mb-3">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="d-block mt-2 small">Lobby</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="<?php echo $siteURL; ?>pleniere.php" class="d-block text-center py-4 px-3 mb-3">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="d-block mt-2 small">plénière</span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

<?php include 'footer.php'; ?>