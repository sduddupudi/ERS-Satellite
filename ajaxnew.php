<?php
include 'db_connection.php';
session_start();
if ($_POST['action'] == 'call_agenda') {
    if (isset($_POST["agenda_category"])) {
        $agenda_category = $_POST["agenda_category"];
    }
    $cat_id = '';
    if (!empty($agenda_category)) {
        foreach ($agenda_category as $value) {
            $cat_id .= "'" . $value . "',";
        }
    }
    $cat_id_f = rtrim($cat_id, ",");

    if (!empty($agenda_category)) {
        $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat where agenda_cat_id IN ($cat_id_f)");
        $cat_sql->execute();
    } else {
        $cat_sql = $pdo->prepare("SELECT * FROM agenda_cat");
        $cat_sql->execute();
    }

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
                                    <a href="<?php echo $new["link_url"] ?>" class="btn customMeeting_btn btn-sm">Go To
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
    <?php }
} ?>

                      
