<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';

if (isset($_POST['add_lobby_btn'])) {

    $customer_id = $_SESSION["userID"];
    try{
        $lobby_id = $_POST['lobbyid'];
        $help_desk = checkField($_POST["help_desk"], 'Lobby Helpdesk URL', ['min' => 2, 'max' => 256, 'empty' => true]);
        $video_in_fullscreen = $_POST['lobbyid'];
        $coffee_break_btn_text = checkField($_POST["coffee_break_btn_text"], 'Coffee Break – Button Text', ['min' => 2, 'max' => 32, 'empty' => true]);
        $coffee_break_join_video_conference = checkField($_POST["coffee_break_join_video_conference"], 'offee Break – Franchise Meeting', ['min' => 2, 'max' => 256, 'empty' => true]);
        $stream_video = checkField($_POST["stream_video"], 'Plenary stream video URL', ['min' => 2, 'max' => 256, 'empty' => true]);
        $atelier_stream_video = checkField($_POST["atelier_stream_video"], 'Atelier stream video URL', ['min' => 2, 'max' => 256, 'empty' => true]);
        $help_link = checkField($_POST["help_link"], 'Help Link', ['min' => 2, 'max' => 256, 'empty' => true]);
        $information_text = checkField($_POST["information_text"], 'Information Text', ['min' => 2, 'max' => 256, 'empty' => true]);
        $video_url = checkField($_POST["video_url"], 'Video URL', ['min' => 2, 'max' => 256, 'empty' => true]);
        $help_desk_appears = $_POST['help_desk_appears'];
        $stream_video_appears = $_POST['stream_video_appears'];
        $atelier_stream_video_appears = $_POST['atelier_stream_video_appears'];
        $resources_icon_appears = $_POST['resources_icon_appears'];
        $information_text_appears = $_POST['information_text_appears'];
        $site_title = checkField($_POST["site_title"], 'Site Title', ['min' => 2, 'max' => 128, 'empty' => true]);
        $coffee_break_appears = $_POST['coffee_break_appears'];
        $footer_hyperlink_text = checkField($_POST["footer_hyperlink_text"], 'Footer Hyperlink Text', ['min' => 2, 'max' => 256, 'empty' => true]);
        $footer_hyperlink_text_appears = $_POST['footer_hyperlink_text_appears'];
        $footer_hyperlink = checkField($_POST["footer_hyperlink"], 'Footer Hyperlink', ['min' => 2, 'max' => 256, 'empty' => true]);
        $help_desk_text = checkField($_POST["help_desk_text"], 'Lobby Helpdesk Button Text', ['min' => 2, 'max' => 32, 'empty' => true]);
        $pleanry_text = checkField($_POST["pleanry_text"], 'Plenary Text', ['min' => 2, 'max' => 256, 'empty' => true]);
        $atelier_text = checkField($_POST["atelier_text"], 'Atelier Text', ['min' => 2, 'max' => 256, 'empty' => true]);
        $resources_text = checkField($_POST["resources_text"], 'Resources Text', ['min' => 2, 'max' => 256, 'empty' => true]);

        $get_sql = $pdo->prepare("SELECT `customerID`, `information_video`, `site_logo`, `site_favicon`, `help_desk_icon`, `pleanry_icon`, `atelier_icon`, `resources_icon`, `information_icon`, `background_img` FROM lobby WHERE `lobbyID` = ?");
        $get_sql->execute([
            $lobby_id
        ]);
        $row = $get_sql->fetch();

        $information_video = uploadFile($row, 'information_video', 'video', ['type' => 'video', 'empty' => true]);
        $site_logo = uploadFile($row, 'site_logo', 'site_logo', ['type' => 'image', 'empty' => true]);
        $help_desk_icon = uploadFile($row, 'help_desk_icon', 'image', ['type' => 'image', 'empty' => true]);
        $pleanry_icon = uploadFile($row, 'pleanry_icon', 'image', ['type' => 'image', 'empty' => true]);
        $atelier_icon = uploadFile($row, 'atelier_icon', 'image', ['type' => 'image', 'empty' => true]);
        $resources_icon = uploadFile($row, 'resources_icon', 'image', ['type' => 'image', 'empty' => true]);
        $information_icon = uploadFile($row, 'information_icon', 'image', ['type' => 'image', 'empty' => true]);
        $background_img = uploadFile($row, 'background_img', 'image', ['type' => 'image', 'empty' => true]);
        $site_favicon = uploadFile($row, 'site_favicon', 'site_favicon', ['type' => 'favicon', 'empty' => true]);

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        if (empty($row)) {
            try {
                $query = "INSERT INTO `lobby` (
                `help_desk`,
                `video_in_fullscreen`,
                `coffee_break_btn_text`,
                `coffee_break_join_video_conference`,
                `stream_video`,
                `atelier_stream_video`,
                `help_link`,
                `information_text`,
                `information_video`,
                `site_title`,
                `site_logo`,
                `site_favicon`,
                `coffee_break_appears`,
                `video_url`,
                `help_desk_appears`,
                `stream_video_appears`,
                `atelier_stream_video_appears`,
                `resources_icon_appears`,            
                `information_text_appears`,            
                `footer_hyperlink_text`,            
                `footer_hyperlink_text_appears`,            
                `footer_hyperlink`,            
                `help_desk_text`,            
                `help_desk_icon`,            
                `pleanry_text`,            
                `pleanry_icon`,            
                `atelier_text`,            
                `atelier_icon`,            
                `resources_text`,            
                `resources_icon`,            
                `background_img`,
                `information_icon`            
            ) VALUES (
                :help_desk,
                :video_in_fullscreen,
                :coffee_break_btn_text,
                :coffee_break_join_video_conference,
                :stream_video,
                :atelier_stream_video,
                :help_link,
                :information_text,
                :information_video,
                :site_title,
                :site_logo,
                :site_favicon,
                :coffee_break_appears,
                :video_url,
                :help_desk_appears,
                :stream_video_appears,
                :atelier_stream_video_appears,
                :resources_icon_appears,            
                :information_text_appears,            
                :footer_hyperlink_text,            
                :footer_hyperlink_text_appears,            
                :footer_hyperlink,            
                :help_desk_text,            
                :help_desk_icon,            
                :pleanry_text,            
                :pleanry_icon,            
                :atelier_text,            
                :atelier_icon,            
                :resources_text,            
                :resources_icon,            
                :background_img,
                :information_icon
            )";
                $params = [
                    ':help_desk' => $help_desk,
                    ':video_in_fullscreen' => $video_in_fullscreen,
                    ':coffee_break_btn_text' => $coffee_break_btn_text,
                    ':coffee_break_join_video_conference' => $coffee_break_join_video_conference,
                    ':stream_video' => $stream_video,
                    ':atelier_stream_video' => $atelier_stream_video,
                    ':help_link' => $help_link,
                    ':information_text' => $information_text,
                    ':information_video' => $information_video,
                    ':site_title' => $site_title,
                    ':site_logo' => $site_logo,
                    ':site_favicon' => $site_favicon,
                    ':coffee_break_appears' => $coffee_break_appears,
                    ':video_url' => $video_url,
                    ':help_desk_appears' => $help_desk_appears,
                    ':stream_video_appears' => $stream_video_appears,
                    ':atelier_stream_video_appears' => $atelier_stream_video_appears,
                    ':resources_icon_appears' => $resources_icon_appears,
                    ':information_text_appears' => $information_text_appears,
                    ':footer_hyperlink_text' => $footer_hyperlink_text,
                    ':footer_hyperlink_text_appears' => $footer_hyperlink_text_appears,
                    ':footer_hyperlink' => $footer_hyperlink,
                    ':help_desk_text' => $help_desk_text,
                    ':help_desk_icon' => $help_desk_icon,
                    ':pleanry_text' => $pleanry_text,
                    ':pleanry_icon' => $pleanry_icon,
                    ':atelier_text' => $atelier_text,
                    ':atelier_icon' => $atelier_icon,
                    ':resources_text' => $resources_text,
                    ':resources_icon' => $resources_icon,
                    ':background_img' => $background_img,
                    ':information_icon`' => $information_icon
                ];

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $msg = "Lobby insert successfully";
            } catch (PDOException $e) {
                $error = "Error: Failed!";
            }

        } else {
            try {
                $params = [
                    'help_desk' => $help_desk,
                    'video_in_fullscreen' => $video_in_fullscreen,
                    'coffee_break_btn_text' => $coffee_break_btn_text,
                    'coffee_break_join_video_conference' => $coffee_break_join_video_conference,
                    'stream_video' => $stream_video,
                    'atelier_stream_video' => $atelier_stream_video,
                    'help_link' => $help_link,
                    'information_text' => $information_text,
                    'information_video' => $information_video,
                    'site_title' => $site_title,
                    'site_logo' => $site_logo,
                    'site_favicon' => $site_favicon,
                    'coffee_break_appears' => $coffee_break_appears,
                    'video_url' => $video_url,
                    'help_desk_appears' => $help_desk_appears,
                    'stream_video_appears' => $stream_video_appears,
                    'atelier_stream_video_appears' => $atelier_stream_video_appears,
                    'resources_icon_appears' => $resources_icon_appears,
                    'information_text_appears' => $information_text_appears,
                    'footer_hyperlink_text' => $footer_hyperlink_text,
                    'footer_hyperlink_text_appears' => $footer_hyperlink_text_appears,
                    'footer_hyperlink' => $footer_hyperlink,
                    'help_desk_text' => $help_desk_text,
                    'help_desk_icon' => $help_desk_icon,
                    'pleanry_text' => $pleanry_text,
                    'pleanry_icon' => $pleanry_icon,
                    'atelier_text' => $atelier_text,
                    'atelier_icon' => $atelier_icon,
                    'resources_text' => $resources_text,
                    'resources_icon' => $resources_icon,
                    'background_img' => $background_img,
                    'information_icon' => $information_icon,
                    'lobby_id' => $lobby_id,
                ];
                $update_sql = "UPDATE lobby SET 
            help_desk=:help_desk,
            video_in_fullscreen=:video_in_fullscreen,
            coffee_break_btn_text=:coffee_break_btn_text,
            coffee_break_join_video_conference=:coffee_break_join_video_conference,
            stream_video=:stream_video,
            atelier_stream_video=:atelier_stream_video,
            help_link=:help_link,
            information_text=:information_text,
            information_video=:information_video,
            site_title=:site_title,
            site_logo=:site_logo,
            site_favicon=:site_favicon,
            coffee_break_appears=:coffee_break_appears,
            video_url=:video_url,
            help_desk_appears=:help_desk_appears,
            stream_video_appears=:stream_video_appears,
            atelier_stream_video_appears=:atelier_stream_video_appears,
            resources_icon_appears=:resources_icon_appears,
            information_text_appears=:information_text_appears,
            footer_hyperlink_text=:footer_hyperlink_text,
            footer_hyperlink_text_appears=:footer_hyperlink_text_appears,
            footer_hyperlink=:footer_hyperlink,
            help_desk_text=:help_desk_text,
            help_desk_icon=:help_desk_icon,
            pleanry_text=:pleanry_text,
            pleanry_icon=:pleanry_icon,
            atelier_text=:atelier_text,
            atelier_icon=:atelier_icon,
            resources_text=:resources_text,
            resources_icon=:resources_icon,
            background_img=:background_img,
            information_icon=:information_icon
        WHERE 
            lobbyID=:lobby_id";

                $stmt = $pdo->prepare($update_sql);
                $stmt->execute($params);
                $msg = "Record updated successfully";
            } catch (PDOException $e) {
                $error = "Error updating record";
            }
        }
    }
}

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();

?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Lobby</h6>
        </div>
        <div class="card-body">
            <span style="color: green;"><?php if (!empty($msg)) {
                    echo $msg;
                } ?></span>
            <span id="error" style="color: red;"><?php if (!empty($error)) {
                    echo $error;
                } ?></span>
            <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
                <input type="hidden" name="lobbyid" class="form-control"
                       value="<?php if (isset($row_lobby['lobbyID'])) {
                           echo $row_lobby['lobbyID'];
                       } ?>">
                <fieldset>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="help_desk">Lobby Helpdesk URL</label>
                        <div class="col-md-6">
                            <input type="text" id="help_desk" name="help_desk" class="form-control"
                                   value="<?php if (isset($row_lobby['help_desk'])) {
                                       echo $row_lobby['help_desk'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="help_desk_appears"
                                       name="help_desk_appears"
                                       value="yes" <?php if ($row_lobby['help_desk_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="help_desk_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="help_desk_text">Lobby Helpdesk Button
                            Text</label>
                        <div class="col-md-6">
                            <input type="text" id="help_desk_text" name="help_desk_text" class="form-control"
                                   value="<?php if (isset($row_lobby['help_desk_text'])) {
                                       echo $row_lobby['help_desk_text'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="help_desk_icon">Lobby Helpdesk
                            Icon</label>
                        <div class="col-md-3">
                            <input type="file" id="help_desk_icon" name="help_desk_icon" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["help_desk_icon"]) { ?>
                                <img src="/<?php echo $row_lobby["help_desk_icon"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="stream_video">Plenary stream video
                            URL</label>
                        <div class="col-md-6">
                            <input type="text" id="stream_video" name="stream_video" class="form-control"
                                   value="<?php if (isset($row_lobby['stream_video'])) {
                                       echo $row_lobby['stream_video'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="stream_video_appears"
                                       name="stream_video_appears"
                                       value="yes" <?php if ($row_lobby['stream_video_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="stream_video_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleanry_text">Plenary Text</label>
                        <div class="col-md-6">
                            <input type="text" id="pleanry_text" name="pleanry_text" class="form-control"
                                   value="<?php if (isset($row_lobby['pleanry_text'])) {
                                       echo $row_lobby['pleanry_text'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleanry_icon">Plenary Icon</label>
                        <div class="col-md-3">
                            <input type="file" id="pleanry_icon" name="pleanry_icon" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["pleanry_icon"]) { ?>
                                <img src="/<?php echo $row_lobby["pleanry_icon"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="atelier_stream_video">Atelier stream
                            video URL</label>
                        <div class="col-md-6">
                            <input type="text" id="atelier_stream_video" name="atelier_stream_video"
                                   class="form-control" value="<?php if (isset($row_lobby['atelier_stream_video'])) {
                                echo $row_lobby['atelier_stream_video'];
                            } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="atelier_stream_video_appears"
                                       name="atelier_stream_video_appears"
                                       value="yes" <?php if ($row_lobby['atelier_stream_video_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="atelier_stream_video_appears">Pleasse Check if need
                                    to appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="atelier_text">Atelier Text</label>
                        <div class="col-md-6">
                            <input type="text" id="atelier_text" name="atelier_text" class="form-control"
                                   value="<?php if (isset($row_lobby['atelier_text'])) {
                                       echo $row_lobby['atelier_text'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="atelier_icon">Atelier Icon</label>
                        <div class="col-md-3">
                            <input type="file" id="atelier_icon" name="atelier_icon" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["atelier_icon"]) { ?>
                                <img src="/<?php echo $row_lobby["atelier_icon"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resources_text">Resources Text</label>
                        <div class="col-md-6">
                            <input type="text" id="resources_text" name="resources_text" class="form-control"
                                   value="<?php if (isset($row_lobby['resources_text'])) {
                                       echo $row_lobby['resources_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="resources_icon_appears"
                                       name="resources_icon_appears"
                                       value="yes" <?php if ($row_lobby['resources_icon_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="resources_icon_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resources_icon">Resources Icon</label>
                        <div class="col-md-3">
                            <input type="file" id="resources_icon" name="resources_icon" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["resources_icon"]) { ?>
                                <img src="/<?php echo $row_lobby["resources_icon"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>


                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="information_text">Information
                            Text </label>
                        <div class="col-md-6">
                            <input type="text" id="information_text" name="information_text" class="form-control"
                                   value="<?php if (isset($row_lobby['information_text'])) {
                                       echo $row_lobby['information_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="information_text_appears"
                                       name="information_text_appears"
                                       value="yes" <?php if ($row_lobby['information_text_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="information_text_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="information_icon">Information
                            Icon</label>
                        <div class="col-md-3">
                            <input type="file" id="information_icon" name="information_icon" class="form-control"
                                   value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["information_icon"]) { ?>
                                <img src="/<?php echo $row_lobby["information_icon"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="coffee_break_btn_text">Coffee Break –
                            Button Text </label>
                        <div class="col-md-6">
                            <input type="text" id="coffee_break_btn_text" name="coffee_break_btn_text"
                                   class="form-control" value="<?php if (isset($row_lobby['coffee_break_btn_text'])) {
                                echo $row_lobby['coffee_break_btn_text'];
                            } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coffee_break_appears"
                                       name="coffee_break_appears"
                                       value="yes" <?php if ($row_lobby['coffee_break_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="coffee_break_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="coffee_break_join_video_conference">Coffee
                            Break – Franchise Meeting </label>
                        <div class="col-md-6">
                            <input type="text" id="coffee_break_join_video_conference"
                                   name="coffee_break_join_video_conference" class="form-control"
                                   value="<?php if (isset($row_lobby['coffee_break_join_video_conference'])) {
                                       echo $row_lobby['coffee_break_join_video_conference'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="help_link">Help Link </label>
                        <div class="col-md-6">
                            <input type="text" id="help_link" name="help_link" class="form-control"
                                   value="<?php if (isset($row_lobby['help_link'])) {
                                       echo $row_lobby['help_link'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="video_url">Video URL </label>
                        <div class="col-md-6">
                            <input type="text" id="video_url" name="video_url" class="form-control"
                                   value="<?php if (isset($row_lobby['video_url'])) {
                                       echo $row_lobby['video_url'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="information_video">Information
                            Video </label>
                        <div class="col-md-3">
                            <input type="file" id="information_video" name="information_video" class="form-control"
                                   value="">
                        </div>
                        <div class="col-md-3">
                            <a target="_blank" href="<?php echo $row_lobby["information_video"]; ?>">uploaded video</a>

                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="site_title">Site Title </label>
                        <div class="col-md-6">
                            <input type="text" id="site_title" name="site_title" class="form-control"
                                   value="<?php if (isset($row_lobby['site_title'])) {
                                       echo $row_lobby['site_title'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="site_logo">Site Logo </label>
                        <div class="col-md-3">
                            <input type="file" id="site_logo" name="site_logo" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["site_logo"]) { ?>
                                <img src="/<?php echo $row_lobby["site_logo"]; ?>" width="100" height="30">
                            <?php } ?>
                        </div>
                    </div>


                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="site_favicon">Site Favicon </label>
                        <div class="col-md-3">
                            <input type="file" id="site_favicon" name="site_favicon" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["site_favicon"]) { ?>
                                <img src="/<?php echo $row_lobby["site_favicon"]; ?>" width="100" height="30">
                            <?php } ?>
                        </div>
                    </div>


                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="footer_hyperlink_text">Footer
                            Hyperlink Text </label>
                        <div class="col-md-6">
                            <input type="text" id="footer_hyperlink_text" name="footer_hyperlink_text"
                                   class="form-control" value="<?php if (isset($row_lobby['footer_hyperlink_text'])) {
                                echo $row_lobby['footer_hyperlink_text'];
                            } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="footer_hyperlink_text_appears"
                                       name="footer_hyperlink_text_appears"
                                       value="yes" <?php if ($row_lobby['footer_hyperlink_text_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="footer_hyperlink_text_appears">Pleasse Check if
                                    need to appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="footer_hyperlink">Footer
                            Hyperlink </label>
                        <div class="col-md-6">
                            <input type="text" id="footer_hyperlink" name="footer_hyperlink" class="form-control"
                                   value="<?php if (isset($row_lobby['footer_hyperlink'])) {
                                       echo $row_lobby['footer_hyperlink'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="background_img">Lobby Background
                            image</label>
                        <div class="col-md-3">
                            <input type="file" id="background_img" name="background_img" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_lobby["background_img"]) { ?>
                                <img src="/<?php echo $row_lobby["background_img"]; ?>" width="50" height="50">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_lobby_btn" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
