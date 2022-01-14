<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['add_speaker_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        checkCsrf();
        $speaker_name = checkField($_POST["speaker_name"], 'Speaker name', ['min' => 2, 'max' => 64]);
        $designation = checkField($_POST["designation"], 'Designation', ['min' => 2, 'max' => 256]);
        $description = checkField($_POST["speakers_description"], 'Description');
        $linkdin = checkField($_POST["linkdin"], 'LinkdIn', ['min' => 2, 'max' => 64]);
        $email = checkField($_POST["email"], 'Email', ['min' => 2, 'max' => 64, 'checkEmail' => true]);
        $profile = uploadFile(null, 'profile_picture', 'speaker', ['type' => 'image']);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $datetime = date('Y-m-d H:i:s');
        $speakers_order = checkField($_POST["speakers_order"], 'Speaker Order', ['min' => 1, 'max' => 3, 'regex' => '0-9']);
        $file_name = '';
        $del = 0;

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $query = "INSERT INTO `speakers` (
                `customer_id`,
                `speaker_name`,
                `designation`,
                `description`,
                `linkdin`,
                `email`,
                `profile`,
                `date`,
                `datetime`,
                `time`,
                `updated_date`,
                `updated_datetime`,
                `updated_time`,
                `speakers_order`,
                `del`           
            ) VALUES (
                :customer_id,
                :speaker_name,
                :designation,
                :description,
                :linkdin,
                :email,
                :profile,
                :date,
                :datetime,
                :time,
                :updated_date,
                :updated_datetime,
                :updated_time,
                :speakers_order,
                :del
            )";
            $params = [
                ':customer_id' => $customer_id,
                ':speaker_name' => $speaker_name,
                ':designation' => $designation,
                ':description' => $description,
                ':linkdin' => $linkdin,
                ':email' => $email,
                ':profile' => $profile,
                ':date' => $date,
                ':datetime' => $datetime,
                ':time' => $time,
                ':updated_date' => $date,
                ':updated_datetime' => $datetime,
                ':updated_time' => $time,
                ':speakers_order' => $speakers_order,
                ':del' => $del
            ];

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $msg = "Speaker insert successfully";
        } catch (PDOException $e) {
            $error = "Error: Failed!";
        }
    }
}
?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Speaker</h6>
            <a href="list_speakers.php" style="float:right;" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">

            <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right" for="msg"></label>
                <div class="col-md-6">
                    <?php if (!empty($msg)) {
                        echo "<div class='alert alert-success alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> $msg </div>";
                    } ?>
                    <?php if (!empty($error)) {
                        echo "<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed!</strong> $error </div>";
                    } ?></span>
                </div>
            </div>

            <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
                <?php csrfHtml(); ?>
                <fieldset>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="speaker_name">Speaker Name</label>
                        <div class="col-md-6">
                            <input type="text" id="speaker_name" name="speaker_name" class="form-control" value=""
                                   required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="designation">Designation</label>
                        <div class="col-md-6">
                            <input type="text" id="designation" name="designation" class="form-control" value=""
                                   required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="linkdin">LinkdIn</label>
                        <div class="col-md-6">
                            <input type="text" id="linkdin" name="linkdin" class="form-control" value="" required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="email">Email </label>
                        <div class="col-md-6">
                            <input type="text" id="email" name="email" class="form-control" value="" required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="speakers_order">Speaker Order(The
                            value must be numeric) </label>
                        <div class="col-md-6">
                            <input type="text" id="speakers_order" name="speakers_order" class="form-control" value=""
                                   required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="speakers_order">Description</label>
                        <div class="col-md-6">
                            <textarea id="speakers_description" class="form-control" name="speakers_description"
                                      rows="4" cols="50" value="" required=""></textarea>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="profile_picture">Profile
                            Picture </label>
                        <div class="col-md-6">
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control" value=""
                                   required="">
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_speaker_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
