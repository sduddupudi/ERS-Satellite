<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['submit_btn'])) {

    try {
        checkCsrf();
        $index_page_settings_id = $_POST['index_page_settings_id'];

        $get_sql = $pdo->prepare("SELECT * FROM index_page_settings WHERE `index_page_settings_id` = ?");
        $get_sql->execute([
            $index_page_settings_id
        ]);
        $row = $get_sql->fetch();

        $sign_in_form_heading = checkField($_POST["sign_in_form_heading"], 'Sign In Form Heading', ['max' => 256, 'regex' => 'a-zA-Z\s', 'empty' => true]);
        $sign_up_form_heading = checkField($_POST["sign_up_form_heading"], 'Sign Up Form Heading', ['max' => 256, 'regex' => 'a-zA-Z\s', 'empty' => true]);
        $sign_in_button_text = checkField($_POST["sign_in_button_text"], 'Sign In Button Text', ['max' => 256, 'regex' => 'a-zA-Z\s', 'empty' => true]);
        $sign_up_button_text = checkField($_POST["sign_up_button_text"], 'Sign Up Button Text', ['max' => 256, 'regex' => 'a-zA-Z\s', 'empty' => true]);
        $privacy_policy_text = checkField($_POST["privacy_policy_text"], 'Privacy Policy Text', ['max' => 1024, 'empty' => true]);
        $privacy_policy_text_appears = $_POST['privacy_policy_text_appears'];
        $privacy_policy_checkbox_text = checkField($_POST["privacy_policy_checkbox_text"], 'Privacy Policy checkbox Text', ['max' => 1024, 'empty' => true]);
        $privacy_policy_checkbox_text_appears = $_POST['privacy_policy_checkbox_text_appears'];
        $sign_up_appears = $_POST['sign_up_appears'];
        $index_page_image = uploadFile($row, 'index_page_image', 'image', ['type' => 'image']);

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        if (empty($row)) {
            try {
                $query = "INSERT INTO `index_page_settings` (
                `sign_in_form_heading`,
                `sign_up_form_heading`,
                `sign_in_button_text`,
                `sign_up_button_text`,
                `privacy_policy_text`,
                `privacy_policy_text_appears`,
                `privacy_policy_checkbox_text`,
                `privacy_policy_checkbox_text_appears`,
                `index_page_image`,
                `sign_up_appears`           
            ) VALUES (
                :sign_in_form_heading,
                :sign_up_form_heading,
                :sign_in_button_text,
                :sign_up_button_text,
                :privacy_policy_text,
                :privacy_policy_text_appears,
                :privacy_policy_checkbox_text,
                :privacy_policy_checkbox_text_appears,
                :index_page_image,
                :sign_up_appears
            )";
                $params = [
                    ':sign_in_form_heading' => $sign_in_form_heading,
                    ':sign_up_form_heading' => $sign_up_form_heading,
                    ':sign_in_button_text' => $sign_in_button_text,
                    ':sign_up_button_text' => $sign_up_button_text,
                    ':privacy_policy_text' => $privacy_policy_text,
                    ':privacy_policy_text_appears' => $privacy_policy_text_appears,
                    ':privacy_policy_checkbox_text' => $privacy_policy_checkbox_text,
                    ':privacy_policy_checkbox_text_appears' => $privacy_policy_checkbox_text_appears,
                    ':index_page_image' => $index_page_image,
                    ':sign_up_appears' => $sign_up_appears
                ];

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $msg = "Record insert successfully";
            } catch (PDOException $e) {
                $error = "Error: Failed!";
            }
        } else {
            try {
                $update_sql = "UPDATE index_page_settings SET 
            sign_in_form_heading=:sign_in_form_heading,
            sign_up_form_heading=:sign_up_form_heading,
            sign_in_button_text=:sign_in_button_text,
            sign_up_button_text=:sign_up_button_text,
            privacy_policy_text=:privacy_policy_text,
            privacy_policy_text_appears=:privacy_policy_text_appears,
            privacy_policy_checkbox_text=:privacy_policy_checkbox_text,
            privacy_policy_checkbox_text_appears=:privacy_policy_checkbox_text_appears,
            index_page_image=:index_page_image,
            sign_up_appears=:sign_up_appears
        WHERE
            index_page_settings_id=:index_page_settings_id";
                $params = [
                    'sign_in_form_heading' => $sign_in_form_heading,
                    'sign_up_form_heading' => $sign_up_form_heading,
                    'sign_in_button_text' => $sign_in_button_text,
                    'sign_up_button_text' => $sign_up_button_text,
                    'privacy_policy_text' => $privacy_policy_text,
                    'privacy_policy_text_appears' => $privacy_policy_text_appears,
                    'privacy_policy_checkbox_text' => $privacy_policy_checkbox_text,
                    'privacy_policy_checkbox_text_appears' => $privacy_policy_checkbox_text_appears,
                    'index_page_image' => $index_page_image,
                    'sign_up_appears' => $sign_up_appears,
                    'index_page_settings_id' => $index_page_settings_id
                ];

                $stmt = $pdo->prepare($update_sql);
                $stmt->execute($params);
                $msg = "Record updated successfully";
            } catch (PDOException $e) {
                $error = "Error updating record";
            }
        }
    }
}

$ips_sql = $pdo->prepare("SELECT * FROM index_page_settings");
$ips_sql->execute();
$row_ips = $ips_sql->fetch();
?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Index Page Setting</h6>
        </div>
        <div class="card-body">
            <span style="color: green;"><?php if (!empty($msg)) {
                    echo $msg;
                } ?></span>
            <span style="color: red;"><?php if (!empty($error)) {
                    echo $error;
                } ?></span>
            <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
                <?php csrfHtml(); ?>
                <input type="hidden" name="index_page_settings_id" class="form-control"
                       value="<?php if (isset($row_ips['index_page_settings_id'])) {
                           echo $row_ips['index_page_settings_id'];
                       } ?>">
                <fieldset>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="sign_in_form_heading">Sign In Form
                            Heading</label>
                        <div class="col-md-6">
                            <input type="text" id="sign_in_form_heading" name="sign_in_form_heading"
                                   class="form-control" value="<?php if (isset($row_ips['sign_in_form_heading'])) {
                                echo $row_ips['sign_in_form_heading'];
                            } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="sign_up_form_heading">Sign Up Form
                            Heading</label>
                        <div class="col-md-6">
                            <input type="text" id="sign_up_form_heading" name="sign_up_form_heading"
                                   class="form-control" value="<?php if (isset($row_ips['sign_up_form_heading'])) {
                                echo $row_ips['sign_up_form_heading'];
                            } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="sign_in_button_text">Sign In Button
                            Text</label>
                        <div class="col-md-6">
                            <input type="text" id="sign_in_button_text" name="sign_in_button_text" class="form-control"
                                   value="<?php if (isset($row_ips['sign_in_button_text'])) {
                                       echo $row_ips['sign_in_button_text'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="sign_up_button_text">Sign Up Button
                            Text</label>
                        <div class="col-md-6">
                            <input type="text" id="sign_up_button_text" name="sign_up_button_text" class="form-control"
                                   value="<?php if (isset($row_ips['sign_up_button_text'])) {
                                       echo $row_ips['sign_up_button_text'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="privacy_policy_text">Privacy Policy
                            Text</label>
                        <div class="col-md-6">
                            <textarea id="privacy_policy_text" name="privacy_policy_text" rows="4"
                                      cols="60"><?php if (isset($row_ips['privacy_policy_text'])) {
                                    echo $row_ips['privacy_policy_text'];
                                } ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="privacy_policy_text_appears"
                                       name="privacy_policy_text_appears"
                                       value="yes" <?php if ($row_ips['privacy_policy_text_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="privacy_policy_text_appears">Pleasse Check if need
                                    to appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="privacy_policy_checkbox_text">Privacy
                            Policy checkbox Text</label>
                        <div class="col-md-6">
                            <input type="text" id="privacy_policy_checkbox_text" name="privacy_policy_checkbox_text"
                                   class="form-control"
                                   value="<?php if (isset($row_ips['privacy_policy_checkbox_text'])) {
                                       echo $row_ips['privacy_policy_checkbox_text'];
                                   } ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                       id="privacy_policy_checkbox_text_appears"
                                       name="privacy_policy_checkbox_text_appears"
                                       value="yes" <?php if ($row_ips['privacy_policy_checkbox_text_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="privacy_policy_checkbox_text_appears">Pleasse Check
                                    if need to appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="sign_up_appears_div">Create new
                            user </label>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="sign_up_appears"
                                       name="sign_up_appears"
                                       value="yes" <?php if ($row_ips['sign_up_appears'] == 'yes') {
                                    echo 'checked';
                                } ?> >
                                <label class="form-check-label" for="sign_up_appears">Pleasse Check if need to
                                    appears</label>
                            </div>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="index_page_image">Index Page
                            Image </label>
                        <div class="col-md-3">
                            <input type="file" id="index_page_image" name="index_page_image" class="form-control"
                                   value="">
                        </div>
                        <div class="col-md-3">
                            <?php if ($row_ips["index_page_image"]) { ?>
                                <img src="/<?php echo $row_ips["index_page_image"]; ?>" width="100" height="30">
                            <?php } ?>
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
