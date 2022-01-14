<?php
include 'header.php';
?>
    <style type="text/css">
        div.btn_box {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 8px;
        }

        div.btn_box a.customMeeting_btn {
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
            margin: 2px;
        }

        div.break_box {
            height: 62px;
            position: relative;
        }
    </style>
    <body>

<div class="agenda_container">
    <div class="title_box mb-3">
        <a href="<?php echo $siteURL; ?>" class="text-decoration-none"><i class="fa fa-reply-all text-white mt-1"
                                                                          style="float: left; font-size: 20px;"></i></a>
        <h4 class="text-white text-center mb-0">Agenda</h4>
    </div>

    <div class="filter_box col-lg-3 col-md-6 mb-4">
        <form>
            <div class="multiselect">
                <div class="form-group selectBox mb-0" onclick="showCheckboxes()">
                    <select class="form-control">
                        <option>Filter</option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes" class="dropdown_checkbox py-1">

                    <?php
                    $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat");
                    $cat_sql->execute();
                    $x = 0;
                    while ($cat_row = $cat_sql->fetch(PDO::FETCH_ASSOC)) {
                        $x++;
                        ?>

                        <label for="one<?php echo $x; ?>" class="px-2 py-1">
                            <input type="checkbox" id="one<?php echo $x; ?>" name="agenda_cat[]"
                                   value="<?php echo $cat_row["agenda_cat_id"]; ?>"
                                   onclick="getAgendanew('<?php echo $cat_row["agenda_cat_id"]; ?>');"> <?php echo $cat_row["agenda_cat_name"]; ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>


    <div class="row mx-0">

        <div class="col-lg-3 col-md-6" id="AgendaListMobile">
            <?php

            $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat");
            $cat_sql->execute();

            while ($cat_row = $cat_sql->fetch(PDO::FETCH_ASSOC)) {

                $sql = $pdo->prepare("SELECT * FROM agenda WHERE `agenda_category` = ? OR `agenda_category_2` = ? OR `agenda_category_3` = ? ORDER BY agenda_category, schedule_start_time ASC");
                $sql->execute([
                    $cat_row["agenda_cat_id"],
                    $cat_row["agenda_cat_id"],
                    $cat_row["agenda_cat_id"]
                ]); ?>
                <h5 class="text-center"><?php echo $cat_row['agenda_cat_name'] ?></h5>
                <?php

                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                        <div class="card border-0 rounded-0 mb-3">

                            <?php if ($row["type"] == 'break') { ?>

                                <div class="break_box mb-3">
                                    <hr>
                                    <div class="break_text_box">
                                        <h6 class="break_time"><?php echo $row["schedule_start_time"]; ?>
                                            - <?php echo $row["schedule_end_time"]; ?></h6>
                                        <h6 class="break_title mb-0"><?php echo $row["agenda_name"]; ?></h6>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="card-header d-flex justify-content-between align-items-start">
                                    <span class="text-white small"><?php echo $row["schedule_start_time"]; ?> - <?php echo $row["schedule_end_time"]; ?></span>
                                    <span class="text-white small"><?php $schedule_date = $row["schedule_date"];
                                        echo $new_date = date('d-F ', strtotime($schedule_date)); ?></span>
                                </div>

                                <div class="card-body">
                                    <h6 class=""><?php echo $row["link_title"]; ?></h6>
                                    <span class="small"><?php echo $row["agenda_name"]; ?>
                                        <?php if (!empty($row["speaker_name"])) {
                                            echo $row["speaker_name"];
                                        } ?>
                                        <?php if (!empty($row["speaker_name2"])) {
                                            echo $row["speaker_name2"];
                                        } ?>
                                        <?php if (!empty($row["speaker_name3"])) {
                                            echo $row["speaker_name3"];
                                        } ?>
                                        <?php if (!empty($row["speaker_name4"])) {
                                            echo $row["speaker_name4"];
                                        } ?>
                                        <?php if (!empty($row["speaker_name5"])) {
                                            echo $row["speaker_name5"];
                                        } ?>
                                        <?php if (!empty($row["speaker_name6"])) {
                                            echo $row["speaker_name6"];
                                        } ?>

                                        <?php if (!empty($row["speaker_name7"])) {
                                            echo $row["speaker_name7"];
                                        } ?>

                                        <?php if (!empty($row["speaker_name8"])) {
                                            echo $row["speaker_name8"];
                                        } ?>

                                        <?php if (!empty($row["speaker_name9"])) {
                                            echo $row["speaker_name9"];
                                        } ?>
                  </span>

                                    <div class="btn_box">
                                        <?php if ($row["link_title"] != '') { ?>
                                            <a href="<?php echo $row["link_url"] ?>"
                                               class="btn customMeeting_btn btn-sm"><?php echo $row["link_title"]; ?></a>
                                        <?php } else { ?>
                                            <a href="<?php echo $row["link_url"] ?>"
                                               class="btn customMeeting_btn btn-sm">Go To Meeting</a>

                                        <?php } ?>

                                        <a href="#"
                                           class="btn customMeeting_btn btn-sm"><?php echo $cat_row['agenda_cat_name'] ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
            } ?>
        </div>
    </div>
</div>

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

    .pagination {
        /* display: inline-block; */
        /* bottom: 0; */
        /*top: 90vh;*/
        /*position: fixed;*/
    }

    .pagination a {
        /*font-weight:bold;   */
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
        border-radius: 2.3rem;
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
</style>

<div class="custom_popup">
    <div class="custom_popup_inner">
        <div class="popup_header d-flex justify-content-between align-items-center">
            <div class="popup_logo">
                <a href="https://prod1.digispace.site/"><img src="/admin/uploads/site_logo/1618332757logo.png"></a>
            </div>
            <div class="popup_close">
                <img src="assets/images/close.png">
            </div>
        </div>
        <div class="popup_body">
            <div class="popup_tabs_bar d-flex justify-content-between align-items-center">
                <ul class="d-flex p_tab_ul">
                    <li>
                        <a href="https://prod1.digispace.site/" class="d-block d-md-none w-100 h-100">
                            <img src="/admin/uploads/site_logo/1618332757logo.png" class="img-fluid mb-0"
                                 style="width: 100px; height: 100px; max-height: 100px; margin-left: 41px;">
                        </a>
                        <div class="popup_close d-none ml-auto mr-3">
                            <img src="assets/images/close.png">
                        </div>
                    </li>
                    <li class="active_tab view_map_li d-none d-md-block">
                        <a href="javascript:void(0)" data-id="view-map">
                            <span class="mob_txt_hide">VIEW THE MAP </span>

                        </a>
                    </li>
                    <li class="view_agenda_li d-none d-md-block">
                        <a href="javascript:void(0)" data-id="view-agenda">
                            <img class="mob_icon_img d-none" src="assets/images/agenda_icon.png">
                            <img class="mob_icon_active_img d-none" src="assets/images/agenda_icon_active.png">
                            <span class="mob_txt_hide">VIEW THE PROGRAM </span>
                        </a>
                    </li>
                </ul>

                <ul class="d-flex p_link_ul">

                    <li class="d-none d-md-block">
                        <a href="javascript:void(0)" data-id="speakers">
                            <span class="mob_txt_hide">SPEAKERS </span>

                        </a>
                    </li>
                    <li class="d-none d-md-block">
                        <a href="javascript:void(0)" data-id="resources">
                            <span class="mob_txt_hide">resourceS </span>
                        </a>
                    </li>

                    <li class="d-none d-md-block">
                        <a href="javascript:void(0)" data-id="meeting-replay">
                            <span class="mob_txt_hide">Replay </span>
                        </a>
                    </li>
                    <li class="logout_tab">
                        <form action="" method="POST">
                            <button type="submit" name="logout_btn" id="logout_btn" class="">
                                <img class="mob_icon_img d-none" src="assets/images/logout_icon.png">
                                Logout
                            </button>
                        </form>
                    </li>
                    <li class="d-none">
                        <div class="icon-help">
                            <a href="#"><img src="assets/images/icone_chatbot.png"></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="popup_content">
                <div class="view_map" id="view-map">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="view_map_grid">
                                <a href="https://prod1.digispace.site/lobby.php">
                                    <img src="assets/images/menu_lobby.jpg">
                                    <p>Lobby</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="view_map_grid">
                                <a href="https://prod1.digispace.site/pleniere.php">
                                    <img src="assets/images/menu_planery.jpg">
                                    <p>plénière</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="view-agenda" class="view_agenda ">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="filter_agenda">
                                <h2>Filter</h2>
                                <ul class="filter_ul">
                                    <li><a href="javascript:void(0);" class="" style="background: #2E59D9; ">
                                            <input type="checkbox" id="agenda_cat_1" name="agenda_cat[]" value="1"
                                                   onclick="getAgenda('1');">
                                            February 22</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-10">
                            <div class="agenda_slider" id="agendaList">

                                <div class="speaker_inner">
                                    <div class="agenda_list_grid">
                                        <h3>Ausblick und Closing</h3>
                                        <p>08:00 - 09:30</p>
                                        <ul class="d-flex">
                                            <li><a href="<?php echo $siteURL; ?> class=" bluebutton"></a></li>
                                            <li><a href="#"
                                                   style="background: #2E59D9!important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class="">February 22</a></li>
                                            <li><a href="#"
                                                   style="background: !important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class=""></a></li>
                                            <li><a href="#"
                                                   style="background: !important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class=""></a></li>
                                        </ul>
                                    </div>

                                    <div class="agenda_list_grid">
                                        <h3>ASCVD Unmet need" Launch Pad (Im Einklang mit dem Trainingsinhalt)</h3>
                                        <p>00:05 - 10:35</p>
                                        <ul class="d-flex">
                                            <li><a href="" class="bluebutton"></a></li>
                                            <li><a href="#"
                                                   style="background: #2E59D9!important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class="">February 22</a></li>
                                            <li><a href="#"
                                                   style="background: !important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class=""></a></li>
                                            <li><a href="#"
                                                   style="background: !important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;"
                                                   class=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="speakers" class="view_speakers hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="speaker_slider_12 row" id="speaker_append">
                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                <span>&lsaquo;&lsaquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class='page-item active'><a class='page-link'
                                                                        href='javascript:void(0)'>1 </a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                <span>&rsaquo;&rsaquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <div class="speakers_col d-flex col-lg-4 col-md-4">
                                    <div class="speaker_prof_img">
                                        <p style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                           data-target="#myModal"
                                           data-images='admin/uploads/speaker/1614334679Photo Manuela Buxo.jpg'
                                           data-description="description coming here"><img
                                                    src="admin/uploads/speaker/1614334679Photo Manuela Buxo.jpg"></p>
                                    </div>
                                    <div class="speaker_prof_bio">
                                        <h4 style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                            data-target="#myModal"
                                            data-images='admin/uploads/speaker/1614334679Photo Manuela Buxo.jpg'
                                            data-description="description coming here"> Photo Manuela Buxo</h4>
                                        <p>Doctor</p>
                                        <ul class="d-flex profile_social">
                                            <li><a target="_blank" href="-"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></li>
                                            <li><a target="_blank" href="mailto:-"><i class="fa fa-envelope"
                                                                                      aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="speakers_col d-flex col-lg-4 col-md-4">
                                    <div class="speaker_prof_img">
                                        <p style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                           data-target="#myModal"
                                           data-images='admin/uploads/speaker/1614334713Anita-Simmonds_1000x1000.png'
                                           data-description="description coming here"><img
                                                    src="admin/uploads/speaker/1614334713Anita-Simmonds_1000x1000.png">
                                        </p>
                                    </div>
                                    <div class="speaker_prof_bio">
                                        <h4 style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                            data-target="#myModal"
                                            data-images='admin/uploads/speaker/1614334713Anita-Simmonds_1000x1000.png'
                                            data-description="description coming here"> Anita Simonds</h4>
                                        <p>President of Novartis Oncology</p>
                                        <ul class="d-flex profile_social">
                                            <li><a target="_blank" href="-"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></li>
                                            <li><a target="_blank" href="mailto:-"><i class="fa fa-envelope"
                                                                                      aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="speakers_col d-flex col-lg-4 col-md-4">
                                    <div class="speaker_prof_img">
                                        <p style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                           data-target="#myModal"
                                           data-images='admin/uploads/speaker/1614334733Stephen Holgate_ 003.jpg'
                                           data-description="description coming here"><img
                                                    src="admin/uploads/speaker/1614334733Stephen Holgate_ 003.jpg"></p>
                                    </div>
                                    <div class="speaker_prof_bio">
                                        <h4 style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                            data-target="#myModal"
                                            data-images='admin/uploads/speaker/1614334733Stephen Holgate_ 003.jpg'
                                            data-description="description coming here"> Chris Brightling</h4>
                                        <p>-</p>
                                        <ul class="d-flex profile_social">
                                            <li><a target="_blank" href="-"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></li>
                                            <li><a target="_blank" href="mailto:-"><i class="fa fa-envelope"
                                                                                      aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="speakers_col d-flex col-lg-4 col-md-4">
                                    <div class="speaker_prof_img">
                                        <p style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                           data-target="#myModal"
                                           data-images='admin/uploads/speaker/1614334746Christopher Brightling.jpg'
                                           data-description="description coming here"><img
                                                    src="admin/uploads/speaker/1614334746Christopher Brightling.jpg">
                                        </p>
                                    </div>
                                    <div class="speaker_prof_bio">
                                        <h4 style="cursor: pointer;" href="#" class="" data-toggle="modal"
                                            data-target="#myModal"
                                            data-images='admin/uploads/speaker/1614334746Christopher Brightling.jpg'
                                            data-description="description coming here"> Menelas Pangalos</h4>
                                        <p>-</p>
                                        <ul class="d-flex profile_social">
                                            <li><a target="_blank" href="-"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></li>
                                            <li><a target="_blank" href="mailto:-"><i class="fa fa-envelope"
                                                                                      aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="resources" class="view_resources hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="resources_slider_12 row" id="resources_append">

                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                <span>&lsaquo;&lsaquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                <span>&rsaquo;&rsaquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="meeting-replay" class="view_meeting_replay hide_div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="meeting_slider_12 row" id="meeting_append">

                                <nav aria-label="Page navigation example" style="width: 100%">
                                    <ul class="pagination pagination-sm" style="float: right;">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                                                <span>&lsaquo;&lsaquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                                <span>&rsaquo;&rsaquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
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
                <div class="modalbioimage"><p style="text-align: center;" id="image-desc"></p></div>
                <p id="speaker-desc"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var expanded = false;

    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }

    function getAgendanew(agenda_category) {
        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });
        console.log(val);
        $.ajax({
            type: "POST",
            url: '<?php echo $siteURL; ?>/ajaxmobile.php',
            data: {action: 'call_agenda', agenda_category: val},
            success: function (data) {
                $('#AgendaListMobile').html('');
                $('#AgendaListMobile').html(data);

            }
        });
    }

</script>

<?php
include 'footer.php';
?>