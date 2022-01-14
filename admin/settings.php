<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['submit_btn'])) {

    try {
        checkCsrf();
        $pleniere_de_btn_text = checkField($_POST["pleniere_de_btn_text"], 'Pleniere de button text', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $pleniere_de_iframe_full_width = $_POST['pleniere_de_iframe_full_width'] ?? '';
        $pleniere_fr_btn_text = checkField($_POST["pleniere_fr_btn_text"], 'Pleniere fr button text', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $pleniere_fr_iframe_full_width = $_POST['pleniere_fr_iframe_full_width'] ?? '';

        $plan_menu_text = checkField($_POST["plan_menu_text"], 'See the plan', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $program_menu_text = checkField($_POST["program_menu_text"], 'See the program', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $speaker_menu_text = checkField($_POST["speaker_menu_text"], 'Speaker menu', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $resource_menu_text = checkField($_POST["resource_menu_text"], 'Resource menu', ['regex' => 'a-zA-Z\s', 'empty' => true]);
        $meeting_reply_menu_text = checkField($_POST["meeting_reply_menu_text"], 'Replay', ['regex' => 'a-zA-Z\s', 'empty' => true]);

        $plan_menu = $_POST['plan_menu'] ?? '';
        $program_menu = $_POST['program_menu'] ?? '';
        $speaker_menu = $_POST['speaker_menu'] ?? '';
        $resource_menu = $_POST['resource_menu'] ?? '';
        $meeting_reply_menu = $_POST['meeting_reply_menu'] ?? '';

        $plan_menu_mobile_appears = $_POST['plan_menu_mobile_appears'] ?? '';
        $program_menu_mobile_appears = $_POST['program_menu_mobile_appears'] ?? '';
        $speaker_menu_mobile_appears = $_POST['speaker_menu_mobile_appears'] ?? '';
        $resource_menu_mobile_appears = $_POST['resource_menu_mobile_appears'] ?? '';
        $meeting_reply_menu_mobile_appears = $_POST['meeting_reply_menu_mobile_appears'] ?? '';

        $cr_gp1_btn_text = checkField($_POST["cr_gp1_btn_text"], 'Breakout 1 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_gp2_btn_text = checkField($_POST["cr_gp2_btn_text"], 'Breakout 2 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_respiratory_btn_text = checkField($_POST["cr_respiratory_btn_text"], 'Breakout 3 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_cardio_metabolic_btn_text = checkField($_POST["cr_cardio_metabolic_btn_text"], 'Breakout 4 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_ihd_cosentyx_pso_btn_text = checkField($_POST["cr_ihd_cosentyx_pso_btn_text"], 'Breakout 5 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);

        $cr_ihd_consentyx_spa_btn_text = checkField($_POST["cr_ihd_consentyx_spa_btn_text"], 'Breakout 6 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_optha_beovu_btn_text = checkField($_POST["cr_optha_beovu_btn_text"], 'Breakout 7 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_optha_lucentis_btn_text = checkField($_POST["cr_optha_lucentis_btn_text"], 'Breakout 8 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);
        $cr_neuroscience_ms_btn_text = checkField($_POST["cr_neuroscience_ms_btn_text"], 'Breakout 9 button text', ['regex' => 'a-zA-Z0-9\s', 'empty' => true]);

        $breakout_1_appears = $_POST['breakout_1_appears'] ?? '';
        $breakout_2_appears = $_POST['breakout_2_appears'] ?? '';
        $breakout_3_appears = $_POST['breakout_3_appears'] ?? '';
        $breakout_4_appears = $_POST['breakout_4_appears'] ?? '';
        $breakout_5_appears = $_POST['breakout_5_appears'] ?? '';
        $breakout_6_appears = $_POST['breakout_6_appears'] ?? '';
        $breakout_7_appears = $_POST['breakout_7_appears'] ?? '';
        $breakout_8_appears = $_POST['breakout_8_appears'] ?? '';
        $breakout_9_appears = $_POST['breakout_9_appears'] ?? '';

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        $id = 1;

        $get_sql = $pdo->prepare("SELECT `customerID` FROM settings");
        $get_sql->execute();
        $row = $get_sql->fetch();

        if (empty($row)) {
            try {
                $query = "INSERT INTO `settings` (
                `pleniere_de_btn_text`,
                `pleniere_de_iframe_full_width`,
                `pleniere_fr_btn_text`,
                `pleniere_fr_iframe_full_width`,
                `plan_menu_text`,
                `program_menu_text`,
                `speaker_menu_text`,
                `resource_menu_text`,
                `meeting_reply_menu_text`,
                `plan_menu`,
                `program_menu`,
                `speaker_menu`,
                `resource_menu`,
                `meeting_reply_menu`,
                `plan_menu_mobile_appears`,
                `program_menu_mobile_appears`,
                `speaker_menu_mobile_appears`,
                `resource_menu_mobile_appears`,            
                `meeting_reply_menu_mobile_appears`,            
                `cr_gp1_btn_text`,            
                `cr_gp2_btn_text`,            
                `cr_respiratory_btn_text`,            
                `cr_cardio_metabolic_btn_text`,            
                `cr_ihd_cosentyx_pso_btn_text`,            
                `cr_ihd_consentyx_spa_btn_text`,            
                `cr_optha_beovu_btn_text`,            
                `cr_optha_lucentis_btn_text`,            
                `cr_neuroscience_ms_btn_text`,            
                `breakout_1_appears`,            
                `breakout_2_appears`,            
                `breakout_3_appears`,
                `breakout_4_appears`,
                `breakout_5_appears`,
                `breakout_6_appears`,
                `breakout_7_appears`,
                `breakout_8_appears`,
                `breakout_9_appears`
            ) VALUES (
                :pleniere_de_btn_text,
                :pleniere_de_iframe_full_width,
                :pleniere_fr_btn_text,
                :pleniere_fr_iframe_full_width,
                :plan_menu_text,
                :program_menu_text,
                :speaker_menu_text,
                :resource_menu_text,
                :meeting_reply_menu_text,
                :plan_menu,
                :program_menu,
                :speaker_menu,
                :resource_menu,
                :meeting_reply_menu,
                :plan_menu_mobile_appears,
                :program_menu_mobile_appears,
                :speaker_menu_mobile_appears,
                :resource_menu_mobile_appears,
                :meeting_reply_menu_mobile_appears,
                :cr_gp1_btn_text,
                :cr_gp2_btn_text,
                :cr_respiratory_btn_text,
                :cr_cardio_metabolic_btn_text,
                :cr_ihd_cosentyx_pso_btn_text,
                :cr_ihd_consentyx_spa_btn_text,
                :cr_optha_beovu_btn_text,
                :cr_optha_lucentis_btn_text,
                :cr_neuroscience_ms_btn_text,
                :breakout_1_appears,
                :breakout_2_appears,
                :breakout_3_appears,
                :breakout_4_appears,
                :breakout_5_appears,
                :breakout_6_appears,
                :breakout_7_appears,
                :breakout_8_appears,
                :breakout_9_appears
            )";
                $params = [
                    ':pleniere_de_btn_text' => $pleniere_de_btn_text,
                    ':pleniere_de_iframe_full_width' => $pleniere_de_iframe_full_width,
                    ':pleniere_fr_btn_text' => $pleniere_fr_btn_text,
                    ':pleniere_fr_iframe_full_width' => $pleniere_fr_iframe_full_width,
                    ':plan_menu_text' => $plan_menu_text,
                    ':program_menu_text' => $program_menu_text,
                    ':speaker_menu_text' => $speaker_menu_text,
                    ':resource_menu_text' => $resource_menu_text,
                    ':meeting_reply_menu_text' => $meeting_reply_menu_text,
                    ':plan_menu' => $plan_menu,
                    ':program_menu' => $program_menu,
                    ':speaker_menu' => $speaker_menu,
                    ':resource_menu' => $resource_menu,
                    ':meeting_reply_menu' => $meeting_reply_menu,
                    ':plan_menu_mobile_appears' => $plan_menu_mobile_appears,
                    ':program_menu_mobile_appears' => $program_menu_mobile_appears,
                    ':speaker_menu_mobile_appears' => $speaker_menu_mobile_appears,
                    ':resource_menu_mobile_appears' => $resource_menu_mobile_appears,
                    ':meeting_reply_menu_mobile_appears' => $meeting_reply_menu_mobile_appears,
                    ':cr_gp1_btn_text' => $cr_gp1_btn_text,
                    ':cr_gp2_btn_text' => $cr_gp2_btn_text,
                    ':cr_respiratory_btn_text' => $cr_respiratory_btn_text,
                    ':cr_cardio_metabolic_btn_text' => $cr_cardio_metabolic_btn_text,
                    ':cr_ihd_cosentyx_pso_btn_text' => $cr_ihd_cosentyx_pso_btn_text,
                    ':cr_ihd_consentyx_spa_btn_text' => $cr_ihd_consentyx_spa_btn_text,
                    ':cr_optha_beovu_btn_text' => $cr_optha_beovu_btn_text,
                    ':cr_optha_lucentis_btn_text' => $cr_optha_lucentis_btn_text,
                    ':cr_neuroscience_ms_btn_text' => $cr_neuroscience_ms_btn_text,
                    ':breakout_1_appears' => $breakout_1_appears,
                    ':breakout_2_appears' => $breakout_2_appears,
                    ':breakout_3_appears' => $breakout_3_appears,
                    ':breakout_4_appears' => $breakout_4_appears,
                    ':breakout_5_appears' => $breakout_5_appears,
                    ':breakout_6_appears' => $breakout_6_appears,
                    ':breakout_7_appears' => $breakout_7_appears,
                    ':breakout_8_appears' => $breakout_8_appears,
                    ':breakout_9_appears' => $breakout_9_appears
                ];

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $msg = "Record insert successfully";
            } catch (PDOException $e) {
                $error = "Error: Failed!";
            }
        } else {
            try {
                $params = [
                    'pleniere_de_btn_text' => $pleniere_de_btn_text,
                    'pleniere_de_iframe_full_width' => $pleniere_de_iframe_full_width,
                    'pleniere_fr_btn_text' => $pleniere_fr_btn_text,
                    'pleniere_fr_iframe_full_width' => $pleniere_fr_iframe_full_width,
                    'plan_menu_text' => $plan_menu_text,
                    'program_menu_text' => $program_menu_text,
                    'speaker_menu_text' => $speaker_menu_text,
                    'resource_menu_text' => $resource_menu_text,
                    'meeting_reply_menu_text' => $meeting_reply_menu_text,
                    'plan_menu' => $plan_menu,
                    'program_menu' => $program_menu,
                    'speaker_menu' => $speaker_menu,
                    'resource_menu' => $resource_menu,
                    'meeting_reply_menu' => $meeting_reply_menu,
                    'plan_menu_mobile_appears' => $plan_menu_mobile_appears,
                    'program_menu_mobile_appears' => $program_menu_mobile_appears,
                    'speaker_menu_mobile_appears' => $speaker_menu_mobile_appears,
                    'resource_menu_mobile_appears' => $resource_menu_mobile_appears,
                    'meeting_reply_menu_mobile_appears' => $meeting_reply_menu_mobile_appears,
                    'cr_gp1_btn_text' => $cr_gp1_btn_text,
                    'cr_gp2_btn_text' => $cr_gp2_btn_text,
                    'cr_respiratory_btn_text' => $cr_respiratory_btn_text,
                    'cr_cardio_metabolic_btn_text' => $cr_cardio_metabolic_btn_text,
                    'cr_ihd_cosentyx_pso_btn_text' => $cr_ihd_cosentyx_pso_btn_text,
                    'cr_ihd_consentyx_spa_btn_text' => $cr_ihd_consentyx_spa_btn_text,
                    'cr_optha_beovu_btn_text' => $cr_optha_beovu_btn_text,
                    'cr_optha_lucentis_btn_text' => $cr_optha_lucentis_btn_text,
                    'cr_neuroscience_ms_btn_text' => $cr_neuroscience_ms_btn_text,
                    'breakout_1_appears' => $breakout_1_appears,
                    'breakout_2_appears' => $breakout_2_appears,
                    'breakout_3_appears' => $breakout_3_appears,
                    'breakout_4_appears' => $breakout_4_appears,
                    'breakout_5_appears' => $breakout_5_appears,
                    'breakout_6_appears' => $breakout_6_appears,
                    'breakout_7_appears' => $breakout_7_appears,
                    'breakout_8_appears' => $breakout_8_appears,
                    'breakout_9_appears' => $breakout_9_appears,
                    'id' => $id
                ];
                $update_sql = "UPDATE settings SET 
            pleniere_de_btn_text=:pleniere_de_btn_text,
            pleniere_de_iframe_full_width=:pleniere_de_iframe_full_width,
            pleniere_fr_btn_text=:pleniere_fr_btn_text,
            pleniere_fr_iframe_full_width=:pleniere_fr_iframe_full_width,
            plan_menu_text=:plan_menu_text,
            program_menu_text=:program_menu_text,
            speaker_menu_text=:speaker_menu_text,
            resource_menu_text=:resource_menu_text,
            meeting_reply_menu_text=:meeting_reply_menu_text,
            plan_menu=:plan_menu,
            program_menu=:program_menu,
            speaker_menu=:speaker_menu,
            resource_menu=:resource_menu,
            meeting_reply_menu=:meeting_reply_menu,
            plan_menu_mobile_appears=:plan_menu_mobile_appears,
            program_menu_mobile_appears=:program_menu_mobile_appears,
            speaker_menu_mobile_appears=:speaker_menu_mobile_appears,
            resource_menu_mobile_appears=:resource_menu_mobile_appears,
            meeting_reply_menu_mobile_appears=:meeting_reply_menu_mobile_appears,
            cr_gp1_btn_text=:cr_gp1_btn_text,
            cr_gp2_btn_text=:cr_gp2_btn_text,
            cr_respiratory_btn_text=:cr_respiratory_btn_text,
            cr_cardio_metabolic_btn_text=:cr_cardio_metabolic_btn_text,
            cr_ihd_cosentyx_pso_btn_text=:cr_ihd_cosentyx_pso_btn_text,
            cr_ihd_consentyx_spa_btn_text=:cr_ihd_consentyx_spa_btn_text,
            cr_optha_beovu_btn_text=:cr_optha_beovu_btn_text,
            cr_optha_lucentis_btn_text=:cr_optha_lucentis_btn_text,
            cr_neuroscience_ms_btn_text=:cr_neuroscience_ms_btn_text,
            breakout_1_appears=:breakout_1_appears,
            breakout_2_appears=:breakout_2_appears,
            breakout_3_appears=:breakout_3_appears,
            breakout_4_appears=:breakout_4_appears,
            breakout_5_appears=:breakout_5_appears,
            breakout_6_appears=:breakout_6_appears,
            breakout_7_appears=:breakout_7_appears,
            breakout_8_appears=:breakout_8_appears,
            breakout_9_appears=:breakout_9_appears
        WHERE 
            ID=:id";

                $stmt = $pdo->prepare($update_sql);
                $stmt->execute($params);
                $msg = "Record updated successfully";
            } catch (PDOException $e) {
                $error = "Error updating record";
                print_r($stmt->errorInfo());
            }
        }
    }
}

$setting_sql = $pdo->prepare("SELECT * FROM settings");
$setting_sql->execute();
$row_setting = $setting_sql->fetch();

?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Setting</h6>
        </div>
        <div class="card-body">
            <span style="color: green;"><?php if (!empty($msg)) {
                    echo $msg;
                } ?></span>
            <?php if (!empty($error)) {
                echo "<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed!</strong> $error </div>";
            } ?></span>
            <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
                <?php csrfHtml(); ?>
                <fieldset>
                    <div style="font-weight: bold;">PLENARY</div>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleniere_de_btn_text">pleniere de
                            button text</label>
                        <div class="col-md-6">
                            <input type="text" id="pleniere_de_btn_text" name="pleniere_de_btn_text"
                                   class="form-control" value="<?php if (isset($row_setting['pleniere_de_btn_text'])) {
                                echo $row_setting['pleniere_de_btn_text'];
                            } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleniere_de_iframe_full_width">pleniere
                            de full width iframe</label>
                        <div class="col-md-6">
                            <input type="checkbox" class="form-check-input" id="pleniere_de_iframe_full_width"
                                   name="pleniere_de_iframe_full_width"
                                   value="yes" <?php if ($row_setting['pleniere_de_iframe_full_width'] == 'yes') {
                                echo 'checked';
                            } ?> >
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleniere_fr_btn_text">pleniere fr
                            button text</label>
                        <div class="col-md-6">
                            <input type="text" id="pleniere_fr_btn_text" name="pleniere_fr_btn_text"
                                   class="form-control" value="<?php if (isset($row_setting['pleniere_fr_btn_text'])) {
                                echo $row_setting['pleniere_fr_btn_text'];
                            } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="pleniere_fr_iframe_full_width">pleniere
                            fr full width iframe</label>
                        <div class="col-md-6">
                            <input type="checkbox" class="form-check-input" id="pleniere_fr_iframe_full_width"
                                   name="pleniere_fr_iframe_full_width"
                                   value="yes" <?php if ($row_setting['pleniere_fr_iframe_full_width'] == 'yes') {
                                echo 'checked';
                            } ?> >
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <div style="font-weight: bold;">Menu Setting</div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="plan_menu_text">See the plan </label>
                        <div class="col-md-4">
                            <input type="text" id="plan_menu_text" name="plan_menu_text" class="form-control"
                                   value="<?php if (isset($row_setting['plan_menu_text'])) {
                                       echo $row_setting['plan_menu_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="plan_menu" name="plan_menu"
                                       value="yes" <?php if ($row_setting['plan_menu'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="plan_menu">Pleasse Check if need to appears</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="plan_menu_mobile_appears"
                                       name="plan_menu_mobile_appears"
                                       value="yes" <?php if ($row_setting['plan_menu_mobile_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="plan_menu_mobile_appears">Pleasse Check if need to
                                    appears on mobile</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="program_menu_text">See the
                            program </label>
                        <div class="col-md-4">
                            <input type="text" id="program_menu_text" name="program_menu_text" class="form-control"
                                   value="<?php if (isset($row_setting['program_menu_text'])) {
                                       echo $row_setting['program_menu_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="program_menu" name="program_menu"
                                       value="yes" <?php if ($row_setting['program_menu'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="program_menu">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="program_menu_mobile_appears"
                                       name="program_menu_mobile_appears"
                                       value="yes" <?php if ($row_setting['program_menu_mobile_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="program_menu_mobile_appears">Pleasse Check if need
                                    to appears on mobile</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="speaker_menu_text">speaker
                            menu </label>
                        <div class="col-md-4">
                            <input type="text" id="speaker_menu_text" name="speaker_menu_text" class="form-control"
                                   value="<?php if (isset($row_setting['speaker_menu_text'])) {
                                       echo $row_setting['speaker_menu_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="speaker_menu" name="speaker_menu"
                                       value="yes" <?php if ($row_setting['speaker_menu'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="speaker_menu">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="speaker_menu_mobile_appears"
                                       name="speaker_menu_mobile_appears"
                                       value="yes" <?php if ($row_setting['speaker_menu_mobile_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="speaker_menu_mobile_appears">Pleasse Check if need
                                    to appears on mobile</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resource_menu_text">resource
                            menu </label>
                        <div class="col-md-4">
                            <input type="text" id="resource_menu_text" name="resource_menu_text" class="form-control"
                                   value="<?php if (isset($row_setting['resource_menu_text'])) {
                                       echo $row_setting['resource_menu_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="resource_menu" name="resource_menu"
                                       value="yes" <?php if ($row_setting['resource_menu'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="resource_menu">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="resource_menu_mobile_appears"
                                       name="resource_menu_mobile_appears"
                                       value="yes" <?php if ($row_setting['resource_menu_mobile_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="resource_menu_mobile_appears">Pleasse Check if need
                                    to appears on mobile</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="meeting_reply_menu_text">meeting reply
                            menu </label>
                        <div class="col-md-4">
                            <input type="text" id="meeting_reply_menu_text" name="meeting_reply_menu_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['meeting_reply_menu_text'])) {
                                       echo $row_setting['meeting_reply_menu_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="meeting_reply_menu"
                                       name="meeting_reply_menu"
                                       value="yes" <?php if ($row_setting['meeting_reply_menu'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="meeting_reply_menu">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="meeting_reply_menu_mobile_appears"
                                       name="meeting_reply_menu_mobile_appears"
                                       value="yes" <?php if ($row_setting['meeting_reply_menu_mobile_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="meeting_reply_menu_mobile_appears">Pleasse Check if
                                    need to appears on mobile</label>
                            </div>
                        </div>
                    </div>

                    <hr class="sidebar-divider">
                    <div style="font-weight: bold;">corridor 1</div>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_gp1_btn_text">Breakout 1 button
                            text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_gp1_btn_text" name="cr_gp1_btn_text" class="form-control"
                                   value="<?php if (isset($row_setting['cr_gp1_btn_text'])) {
                                       echo $row_setting['cr_gp1_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_1_appears"
                                       name="breakout_1_appears"
                                       value="yes" <?php if ($row_setting['breakout_1_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_1_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_gp2_btn_text">Breakout 2 button
                            text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_gp2_btn_text" name="cr_gp2_btn_text" class="form-control"
                                   value="<?php if (isset($row_setting['cr_gp2_btn_text'])) {
                                       echo $row_setting['cr_gp2_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_2_appears"
                                       name="breakout_2_appears"
                                       value="yes" <?php if ($row_setting['breakout_2_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_2_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_respiratory_btn_text">Breakout 3
                            button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_respiratory_btn_text" name="cr_respiratory_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_respiratory_btn_text'])) {
                                       echo $row_setting['cr_respiratory_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_3_appears"
                                       name="breakout_3_appears"
                                       value="yes" <?php if ($row_setting['breakout_3_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_3_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_cardio_metabolic_btn_text">Breakout
                            4 button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_cardio_metabolic_btn_text" name="cr_cardio_metabolic_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_cardio_metabolic_btn_text'])) {
                                       echo $row_setting['cr_cardio_metabolic_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_4_appears"
                                       name="breakout_4_appears"
                                       value="yes" <?php if ($row_setting['breakout_4_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_4_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_ihd_cosentyx_pso_btn_text">Breakout
                            5 button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_ihd_cosentyx_pso_btn_text" name="cr_ihd_cosentyx_pso_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_ihd_cosentyx_pso_btn_text'])) {
                                       echo $row_setting['cr_ihd_cosentyx_pso_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_5_appears"
                                       name="breakout_5_appears"
                                       value="yes" <?php if ($row_setting['breakout_5_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_5_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <div style="font-weight: bold;">corridor 2</div>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_ihd_consentyx_spa_btn_text">Breakout
                            6 button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_ihd_consentyx_spa_btn_text" name="cr_ihd_consentyx_spa_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_ihd_consentyx_spa_btn_text'])) {
                                       echo $row_setting['cr_ihd_consentyx_spa_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_6_appears"
                                       name="breakout_6_appears"
                                       value="yes" <?php if ($row_setting['breakout_6_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_6_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_optha_beovu_btn_text">Breakout 7
                            button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_optha_beovu_btn_text" name="cr_optha_beovu_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_optha_beovu_btn_text'])) {
                                       echo $row_setting['cr_optha_beovu_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_7_appears"
                                       name="breakout_7_appears"
                                       value="yes" <?php if ($row_setting['breakout_7_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_7_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_optha_lucentis_btn_text">Breakout 8
                            button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_optha_lucentis_btn_text" name="cr_optha_lucentis_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_optha_lucentis_btn_text'])) {
                                       echo $row_setting['cr_optha_lucentis_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_8_appears"
                                       name="breakout_8_appears"
                                       value="yes" <?php if ($row_setting['breakout_8_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_8_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="cr_neuroscience_ms_btn_text">Breakout
                            9 button text</label>
                        <div class="col-md-6">
                            <input type="text" id="cr_neuroscience_ms_btn_text" name="cr_neuroscience_ms_btn_text"
                                   class="form-control"
                                   value="<?php if (isset($row_setting['cr_neuroscience_ms_btn_text'])) {
                                       echo $row_setting['cr_neuroscience_ms_btn_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="breakout_9_appears"
                                       name="breakout_9_appears"
                                       value="yes" <?php if ($row_setting['breakout_9_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="breakout_9_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="submit_btn" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
