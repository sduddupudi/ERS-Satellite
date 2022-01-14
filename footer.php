<?php $cid = $_SESSION["userID"];

$site_sql = $pdo->prepare("SELECT `site_logo` FROM lobby");
$site_sql->execute();
$row_site_logo = $site_sql->fetch();

$setting_menu_sql = $pdo->prepare("SELECT * FROM settings");
$setting_menu_sql->execute();
$row_menu_setting = $setting_menu_sql->fetch();
?>

<style>
    .agenda_list_grid > h3, p {
        padding-bottom: 0px !important;

    }

    .slick-list {
        overflow-y: auto !important;
        height: 474px;
    }

    .slick-track {
        margin-left: unset !important;
    }

    .speaker_slider.slick-list.draggable {
        overflow-y: hidden !important;
    }

    .speaker_prof_bio h4 {
        font-size: 13px
    }

    #resources .resources_slider {
        overflow-y: auto;
        height: 400px;
    }

    #meeting-replay .slick-track {
        width: 1224px !important;
    }

    #meeting-replay .slick-slide {
        width: 306px !important;
    }

    .pagination a {
        font-size: 18px;
        color: #000;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #006CDD;
    }

    .pagination a.active {
        background-color: #006CDD;
    }

    .pagination a:hover:not(.active) {
        background-color: skyblue;
    }

    .speaker_inner.col-lg-4.col-md-4 {
        display: inline-block;
    }

    .modal-content {
        /*border-radius: 2.3rem;*/
    }

    .modal-content {
        background-color: #EFEFEF;
    }

    .modal-dialog {
        max-width: 700px;
    }

    .prof_download_link, .prof_watch_link {
        margin-top: unset !important;
    }

    section.agenda_section {
        height: 60vh;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-top: 24px;
        text-transform: capitalize;
        scrollbar-width: thin !important;
    }

    div.meeting_text_box {
        background-color: #006DDE;
    }

    div.meeting_text_box div.time_box {
        background-color: #006DDE;
        min-height: 30px;
        padding: 10px 15px;
        position: relative;
    }

    div.meeting_text_box div.time_box div.time {
        position: absolute;
        top: 49%;
        left: 50%;
        -webkit-transform: translate(-50%, -51%);
        -moz-transform: translate(-50%, -51%);
        -ms-transform: translate(-50%, -51%);
        -o-transform: translate(-50%, -51%);
        transform: translate(-50%, -51%);
    }

    div.meeting_text_box div.time_box div.time span {
        color: #ffffff;
        font-size: 14px;
        text-align: center;
        line-height: 15px;
    }

    div.meeting_text_box div.time_box div.time span.dash {
        margin-top: -3px;
    }

    div.meeting_text_box div.metting_title_box {
        background-color: #ffffff;
        border: 1px solid #006DDE;
        width: 100%;
        min-height: 66px;
        padding: 8px 16px;
    }

    div.meeting_text_box div.metting_title_box h6.metting_title {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 230px;
    }

    div.meeting_text_box div.metting_title_box div.btn_box {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    div.meeting_text_box div.metting_title_box div.btn_box {
        margin-top: 8px;
    }

    div.meeting_text_box div.metting_title_box div.btn_box a.customMeeting_btn {
        background-color: #006DDE;
        border: 1px solid #006dde;
        color: #ffffff;
        font-size: 11px;
        text-transform: uppercase;
        padding: 1px 8px;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -ms-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    div.meeting_text_box div.metting_title_box div.btn_box a.customMeeting_btn:hover {
        background-color: #ffffff;
        border: 1px solid #006dde;
        color: #006dde;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -ms-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    div.meeting_text_box div.metting_title_box div.btn_box a.customMeeting_btn:nth-child(2) {
        margin-left: 8px;
    }

    div.break_box {
        height: 62px;
        position: relative;
    }

    div.break_box hr {
        border-color: #006dde;
        width: 100%;
        position: absolute;
        top: 50%;
        left: 0;
        -webkit-transform: translate(0, -50%);
        -moz-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        transform: translate(0, -50%);
        margin: 0;
    }

    div.break_box div.break_text_box {
        background-color: #ffffff;
        position: absolute;
        top: 0;
        left: 50%;
        -webkit-transform: translate(-50%, 0);
        -moz-transform: translate(-50%, 0);
        -ms-transform: translate(-50%, 0);
        -o-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
        padding: 8px 16px;
    }

    div.break_box div.break_text_box h6.break_time,
    div.break_box div.break_text_box h6.break_title {
        color: #006dde;
        text-align: center;
    }

    div.break_box div.break_text_box h6.break_title {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 200px;
    }

    div.filter_box {
        height: 374px;
    }

    @media screen and (min-width: 767px) {
        div.meeting_text_box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        div.meeting_text_box div.time_box {
            min-width: 65px;
            min-height: 66px;
        }

        div.meeting_text_box div.time_box div.time {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    }

    @media screen and (max-width: 767px) {
        div.filter_agenda {
            margin-bottom: 16px !important;
        }

        div.filter_box {
            height: auto !important;
        }

        div.popup_content {
            padding-right: 70px !important;
        }
    }
</style>

<div class="custom_popup">
    <div class="custom_popup_inner">
        <div class="popup_header d-flex justify-content-between align-items-center">
            <div class="popup_logo">
                <a href="<?php echo $siteURL; ?>"><img src="<?php echo $row_lobby['site_logo']; ?>"></a>
            </div>
            <div class="popup_close">
                <img src="assets/images/close.png">
            </div>
        </div>
        <div class="popup_body">
            <div class="popup_tabs_bar d-flex justify-content-between align-items-center">
                <ul class="d-flex p_tab_ul">
                    <li>
                        <a href="<?php echo $siteURL; ?>" class="d-block d-md-none w-100 h-100">
                            <img src="<?php echo $row_lobby['site_logo']; ?>" class="img-fluid mb-0"
                                 style="width: 100px; height: 100px; max-height: 100px; margin-left: 41px;">
                        </a>
                        <div class="popup_close d-none ml-auto mr-3">
                            <img src="assets/images/close.png">
                        </div>
                    </li>
                    <?php if ($row_menu_setting['plan_menu'] == 'yes') { ?>
                        <li class="active_tab view_map_li d-none d-md-block">
                            <a href="javascript:void(0)" data-id="view-map">
                                <?php if ($row_menu_setting['plan_menu_mobile_appears'] == 'yes') { ?>
                                    <img class="mob_icon_img d-none" src="assets/images/icone-map.png">
                                    <img class="mob_icon_active_img d-none" src="assets/images/icone-map.png">
                                <?php } ?>
                                <span class="mob_txt_hide"><?php if (isset($row_menu_setting['plan_menu_text'])) {
                                        echo $row_menu_setting['plan_menu_text'];
                                    } ?> </span>

                            </a>
                        </li>
                    <?php }
                    if ($row_menu_setting['program_menu'] == 'yes') { ?>
                        <li class="view_agenda_li d-none d-md-block">
                            <a href="javascript:void(0)" data-id="view-agenda">
                                <?php if ($row_menu_setting['program_menu_mobile_appears'] == 'yes') { ?>
                                    <img class="mob_icon_img d-none" src="assets/images/agenda_icon.png">
                                    <img class="mob_icon_active_img d-none" src="assets/images/agenda_icon_active.png">
                                <?php } ?>
                                <span class="mob_txt_hide"><?php if (isset($row_menu_setting['program_menu_text'])) {
                                        echo $row_menu_setting['program_menu_text'];
                                    } ?> </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <div class="mobile_view_sidemenu w-100 d-block d-md-none">
                    <img src="admin/uploads/image/Demo.jpg" class="img-fluid w-100 mb-3 px-3"
                         style="margin-top: -25px;">
                    <div class="row mx-0">
                        <div class="col-6">
                            <a href="agenda.php" class="d-block text-center py-4 px-3 mb-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="d-block mt-2">Agenda</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="speakers.php" class="d-block text-center py-4 px-3 mb-3">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <span class="d-block mt-2">Speakers</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="resources.php" class="d-block text-center py-4 px-3 mb-3">
                                <i class="fa fa-rocket" aria-hidden="true"></i>
                                <span class="d-block mt-2">Resources</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="map.php" class="d-block text-center py-4 px-3 mb-3">
                                <i class="fa fa-map-o" aria-hidden="true"></i>
                                <span class="d-block mt-2">Map</span>
                            </a>
                        </div>
                    </div>
                </div>

                <ul class="d-flex p_link_ul">
                    <?php if ($row_menu_setting['speaker_menu'] == 'yes') { ?>
                        <li class="d-none d-md-block">
                            <a href="javascript:void(0)" data-id="speakers">
                                <?php if ($row_menu_setting['speaker_menu_mobile_appears'] == 'yes') { ?>
                                    <img class="mob_icon_img d-none" src="assets/images/speakers_icon.png">
                                    <img class="mob_icon_active_img d-none"
                                         src="assets/images/speakers_icon_active.png">
                                <?php } ?>
                                <span class="mob_txt_hide"><?php if (isset($row_menu_setting['speaker_menu_text'])) {
                                        echo $row_menu_setting['speaker_menu_text'];
                                    } ?> </span>

                            </a>
                        </li>
                    <?php }
                    if ($row_menu_setting['resource_menu'] == 'yes') { ?>
                        <li class="d-none d-md-block">
                            <a href="javascript:void(0)" data-id="resources">
                                <?php if ($row_menu_setting['resource_menu_mobile_appears'] == 'yes') { ?>
                                    <img class="mob_icon_img d-none" src="assets/images/ressources_icon.png">
                                    <img class="mob_icon_active_img d-none"
                                         src="assets/images/ressources_icon_active.png">
                                <?php } ?>
                                <span class="mob_txt_hide"><?php if (isset($row_menu_setting['resource_menu_text'])) {
                                        echo $row_menu_setting['resource_menu_text'];
                                    } ?> </span>
                            </a>
                        </li>

                    <?php }
                    if ($row_menu_setting['meeting_reply_menu'] == 'yes') { ?>

                    <?php } ?>
                    <li class="logout_tab">
                        <form action="" method="POST">
                            <button type="submit" name="logout_btn" id="logout_btn" class="">
                                <img class="mob_icon_img d-none" src="assets/images/logout_icon.png">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="popup_content">
                <?php if ($row_menu_setting['plan_menu'] == 'yes') { ?>
                    <div class="view_map" id="view-map">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view_map_grid">
                                    <a href="<?php echo $siteURL; ?>lobby.php">
                                        <img src="assets/images/menu_lobby.jpg">
                                        <p>Lobby</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="view_map_grid">
                                    <a href="<?php echo $siteURL; ?>pleniere.php">
                                        <img src="assets/images/menu_planery.jpg">
                                        <p>plénière</p>
                                    </a>
                                </div>
                            </div>
                            <?php //} ?>
                            <?php if ($_SESSION['userType'] != 'customer' && $_SESSION['userType'] != 'subscriber') { ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <div id="view-agenda" class="view_agenda">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="filter_agenda">
                                <h2>Select Date</h2>
                                <div class="filter_box">
                                    <?php
                                    $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat");
                                    $cat_sql->execute();

                                    while ($cat_row = $cat_sql->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                       id="agenda_cat_<?php echo $cat_row["agenda_cat_id"]; ?>"
                                                       name="agenda_cat[]"
                                                       value="<?php echo $cat_row["agenda_cat_id"]; ?>"
                                                       onclick="getAgenda('<?php echo $cat_row["agenda_cat_id"]; ?>');">
                                                <span class="small"> <?php echo $cat_row["agenda_cat_name"]; ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-10">

                            <section class="agenda_section">
                                <div class="schedule_box">
                                    <div class="row" id="agendaList">
                                        <?php

                                        $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat");
                                        $cat_sql->execute();

                                        while ($cat_row = $cat_sql->fetch(PDO::FETCH_ASSOC)) {

                                            $sql = $pdo->prepare("SELECT * FROM agenda WHERE `agenda_category` = ? OR `agenda_category_2` = ? OR `agenda_category_3` = ? ORDER BY agenda_category, schedule_start_time ASC");
                                            $sql->execute([
                                                $cat_row["agenda_cat_id"],
                                                $cat_row["agenda_cat_id"],
                                                $cat_row["agenda_cat_id"]
                                            ]);
                                            ?>

                                            <div class="col-lg-6">
                                                <h5 class="day_heading text-center mb-3"><?php echo $cat_row['agenda_cat_name'] ?></h5>
                                                <?php
                                                while ($new = $sql->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($new["type"] == 'break') { ?>
                                                        <div class="break_box mb-3">
                                                            <hr>
                                                            <div class="break_text_box">
                                                                <h6 class="break_time"><?php echo $new["schedule_start_time"]; ?>
                                                                    - <?php echo $new["schedule_end_time"]; ?></h6>
                                                                <h6 class="break_title mb-0"><?php echo $new["agenda_name"]; ?></h6>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="meeting_text_box mb-3">
                                                            <div class="time_box">
                                                                <div class="time">
                                                                    <span class="start_time"><?php echo $new["schedule_start_time"]; ?> - <?php echo $new["schedule_end_time"]; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="metting_title_box">
                                                                <h6 class="metting_title mb-0"><?php echo $new["agenda_name"]; ?></h6>
                                                                <div class="btn_box">
                                                                    <?php if ($new["link_title"] != '') { ?>
                                                                        <a href="<?php echo $new["link_url"] ?>"
                                                                           class="btn customMeeting_btn btn-sm"><?php echo $new["link_title"]; ?></a>
                                                                    <?php } else { ?>
                                                                        <a href="<?php echo $new["link_url"] ?>"
                                                                           class="btn customMeeting_btn btn-sm">Go To
                                                                            Meeting</a>

                                                                    <?php } ?>

                                                                    <a href="#"
                                                                       class="btn customMeeting_btn btn-sm"><?php echo $cat_row['agenda_cat_name'] ?></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }
                                                } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div id="speakers" class="view_speakers hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="speaker_slider_12 row" id="speaker_append">
                                <?php
                                $per_page_record = 9;

                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }

                                $start_from = ($page - 1) * $per_page_record;

                                $sql = "SELECT count(*) FROM `speakers`";
                                $rs_result = $pdo->prepare($sql);
                                $rs_result->execute();
                                $total_records = $rs_result->fetchColumn();

                                $total_pages = ceil($total_records / $per_page_record);
                                $pagLink = "";
                                ?>

                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <?php if ($page >= 2) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getSpeakerPagination(<?php echo $page - 1; ?>);"
                                                   aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                        <?php for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $page) {
                                                $pagLink .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>" . $i . " </a></li>";
                                            } else {
                                                $pagLink .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getSpeakerPagination(" . $i . ");' >  " . $i . " </a></li>";
                                            }
                                        };
                                        echo $pagLink; ?>

                                        <li class="page-item">
                                            <?php if ($page < $total_pages) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getSpeakerPagination(<?php echo $page + 1; ?>);"
                                                   aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                    </ul>
                                </nav>

                                <?php

                                $sql_speakers = $pdo->prepare("SELECT * FROM speakers WHERE `del` = ? ORDER BY `speakers_order` ASC LIMIT $start_from, $per_page_record");
                                $sql_speakers->execute([
                                    0
                                ]);

                                $s_i = 1;

                                while ($row_speaker = $sql_speakers->fetch(PDO::FETCH_ASSOC)) {

                                    if ($row_speaker["description"] != '') {
                                        $des = $row_speaker["description"];
                                    } else {
                                        $des = 'Description not found yet..';
                                    }
                                    ?>

                                    <div class="speakers_col d-flex col-lg-4 col-md-4">
                                        <div class="speaker_prof_img">
                                            <p style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                               data-target="#myModal"
                                               data-images='<?php echo "admin/uploads/speaker/" . $row_speaker["profile"] ?>'
                                               data-description="<?php echo $des; ?>">
                                                <?php if ($row_speaker["profile"] != '') { ?>
                                                    <img src="admin/uploads/speaker/<?php echo $row_speaker["profile"]; ?>"/>
                                                <?php } else { ?>
                                                    <img src="admin/uploads/speaker/demo.jpg"/>
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="speaker_prof_bio">
                                            <h4 style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                                data-target="#myModal"
                                                data-images='<?php echo "admin/uploads/speaker/" . $row_speaker["profile"] ?>'
                                                data-description="description coming here"> <?php echo $row_speaker["speaker_name"]; ?></h4>
                                            <!-- <h4><?php echo $row_speaker["speaker_name"]; ?> <strong><?php echo $row_speaker["speaker_name2"]; ?></strong></h4> -->
                                            <p><?php echo $row_speaker["designation"]; ?></p>
                                            <ul class="d-flex profile_social">
                                                <li><a target="_blank" href="<?php echo $row_speaker["linkdin"]; ?>"><i
                                                                class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                                <li><a target="_blank"
                                                       href="mailto:<?php echo $row_speaker["email"]; ?>"><i
                                                                class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                    $s_i++;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="resources" class="view_resources hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="resources_slider_12 row" id="resources_append">
                                <?php
                                $per_page_record_r = 9;
                                if (isset($_GET["page_r"])) {
                                    $page_r = $_GET["page_r"];
                                } else {
                                    $page_r = 1;
                                }

                                $start_from_r = ($page_r - 1) * $per_page_record_r;

                                $query_r = "SELECT count(*) FROM `resource` WHERE `del` = ?";
                                $rs_result_r = $pdo->prepare($query_r);
                                $rs_result_r->execute([
                                    0
                                ]);
                                $total_records_r = $rs_result_r->fetchColumn();

                                $total_pages_r = ceil($total_records_r / $per_page_record_r);
                                $pagLink_r = "";
                                ?>

                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <?php if ($page_r >= 2) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getResourcePagination(<?php echo $page_r - 1; ?>);"
                                                   aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                        <?php for ($i = 1; $i <= $total_pages_r; $i++) {
                                            if ($i == $page_r) {
                                                $pagLink_r .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>" . $i . " </a></li>";
                                            } else {
                                                $pagLink_r .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getResourcePagination(" . $i . ");' >  " . $i . " </a></li>";
                                            }
                                        };
                                        echo $pagLink_r; ?>

                                        <li class="page-item">
                                            <?php if ($page_r < $total_pages_r) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getResourcePagination(<?php echo $page_r + 1; ?>);"
                                                   aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                    </ul>
                                </nav>

                                <?php
                                $sql_resources = $pdo->prepare("SELECT * FROM resource WHERE `del` = ? LIMIT $start_from_r, $per_page_record_r");
                                $sql_resources->execute([
                                    0
                                ]);

                                $r_i = 1;

                                while ($row_resources = $sql_resources->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <div class="speakers_col d-flex col-lg-4 col-md-4">
                                        <div class="speaker_prof_img">
                                            <img src="admin/uploads/resource/<?php echo $row_resources["resource_picture"]; ?>">
                                        </div>
                                        <div class="speaker_prof_bio">
                                            <h4><?php echo $row_resources["resource_name"]; ?></h4>
                                            <a href="admin/uploads/resource/<?php echo $row_resources["resource_pdf"]; ?> "
                                               target="_blank" class="prof_download_link">Regardez</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="meeting-replay" class="view_meeting_replay hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="meeting_slider_12 row" id="meeting_append">
                                <?php
                                $per_page_record_m = 9;
                                if (isset($_GET["page_m"])) {
                                    $page_m = $_GET["page_m"];
                                } else {
                                    $page_m = 1;
                                }

                                $start_from_m = ($page_m - 1) * $per_page_record_m;

                                $query_m = "SELECT count(*) FROM `meeting` WHERE `del` = ?";
                                $rs_result_m = $pdo->prepare($query_m);
                                $rs_result_m->execute([
                                    0
                                ]);
                                $total_records_m = $rs_result_m->fetchColumn();

                                $total_pages_m = ceil($total_records_m / $per_page_record_m);
                                $pagLink_m = "";
                                ?>

                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <?php if ($page_m >= 2) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getMeetingPagination(<?php echo $page_m - 1; ?>);"
                                                   aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                    <span>&lsaquo;&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                        <?php for ($i = 1; $i <= $total_pages_m; $i++) {
                                            if ($i == $page_m) {
                                                $pagLink_m .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>" . $i . " </a></li>";
                                            } else {
                                                $pagLink_m .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getMeetingPagination(" . $i . ");' >  " . $i . " </a></li>";
                                            }
                                        };
                                        echo $pagLink_m; ?>

                                        <li class="page-item">
                                            <?php if ($page_m < $total_pages_m) { ?>
                                                <a class="page-link" href="javascript:void(0)"
                                                   onclick="getMeetingPagination(<?php echo $page_m + 1; ?>);"
                                                   aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                    <span>&rsaquo;&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } ?>
                                        </li>

                                    </ul>
                                </nav>

                                <?php
                                $sql_meeting = $pdo->prepare("SELECT * FROM meeting WHERE `del` = ? LIMIT $start_from_m, $per_page_record_m");
                                $sql_meeting->execute([
                                    0
                                ]);

                                $r_i = 1;

                                while ($row_meeting = $sql_meeting->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <div class="speakers_col d-flex col-lg-4 col-md-4">
                                        <div class="speaker_prof_img">
                                            <img src="admin/uploads/meeting/<?php echo $row_meeting["meeting_picture"]; ?>">
                                        </div>
                                        <div class="speaker_prof_bio">
                                            <h4><?php echo $row_meeting["meeting_name"]; ?></h4>
                                            <p><?php echo $row_meeting["date"]; ?></p>
                                            <a target="_blank" href="<?php echo $row_meeting["watch_link"]; ?>"
                                               class="prof_watch_link">Watch</a>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <div class="modalbioimage"><p style="text-align: center;" id="image-desc"></p></div>
                    </div>
                    <div class="col-lg-8 col-md-9">
                        <p id="speaker-desc"></p>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".sidebar-map-main a").click(function () {
            $(".popup_tabs_bar > ul > li.view_map_li > a").click();
            $(".custom_popup").addClass("custom_popup_open");
        });

        $(".sidebar-toggle-main a").click(function () {

            $(".popup_tabs_bar > ul > li.view_agenda_li > a").click();
            $(".custom_popup").addClass("custom_popup_open");
            $('.agenda_slider').not('.slick-initialized').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 2,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows: 3
                        }
                    },

                ]
            });

        });

        $(".go-ressources-btn a").click(function () {
            $(".p_link_ul >   li:nth-child(2) > a").click();
            $(".custom_popup").addClass("custom_popup_open");

        });

        $(".popup_close").click(function () {
            $(".custom_popup").removeClass("custom_popup_open");
        });

        $(".popup_tabs_bar > ul > li > a").on("click", function () {
            $(".popup_tabs_bar > ul > li").removeClass("active_tab");
            $(this).parent().addClass("active_tab");
            var getDataId = $(this).attr("data-id");
            $(".popup_content > div").hide();
            $("#" + getDataId).show();
            setTimeout(function () {
                // alert();
                $('.agenda_slider').not('.slick-initialized').slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                rows: 3
                            }
                        },

                    ]
                });
            }, 2000);

        });

    })

    function remv() {
        alert("Page is loaded");
        document.getElementById('slick-list').style.overflowY = "hidden;"
    }

    function catCheck(agenda_category) {
        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        alert(val);
    }

    function getAgenda(agenda_category) {
        $('.agenda_slider').slick('unslick');
        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        $.ajax({
            type: "POST",
            url: '<?php echo $siteURL; ?>/ajaxnew.php',
            data: {action: 'call_agenda', agenda_category: val},
            success: function (data) {
                $('#agendaList').html('');
                $('#agendaList').html(data);

                $('.agenda_slider').slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                rows: 3
                            }
                        },

                    ]
                });

            }
        });
    }

    function slickreset() {
        setTimeout(function () {
        }, 1000);
    }

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('description')
        var recipient2 = button.data('images')
        var modal = $(this)
        modal.find('#speaker-desc').html(recipient)
        modal.find('#image-desc').html('<img src="' + recipient2 + '" style="width:100%">')
    })

    function getSpeakerPagination(page) {
        $.ajax({
            type: "POST",
            url: '<?php echo $siteURL; ?>/ajax.php',
            data: {action: 'callSpeakerPagination', page: page},
            success: function (data) {
                $('#speaker_append').html(data);

            }
        });
    }

    function getMeetingPagination(page_m) {
        $.ajax({
            type: "POST",
            url: '<?php echo $siteURL; ?>/ajax.php',
            data: {action: 'callMeetingPagination', page_m: page_m},
            success: function (data) {
                $('#meeting_append').html(data);

            }
        });
    }

    function getResourcePagination(page_r) {
        $.ajax({
            type: "POST",
            url: '<?php echo $siteURL; ?>/ajax.php',
            data: {action: 'callResourcePagination', page_r: page_r},
            success: function (data) {
                $('#resources_append').html(data);

            }
        });
    }
</script>
</body>
</html>