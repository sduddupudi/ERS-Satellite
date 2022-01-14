<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

function selectData($pdo, $meeting_id)
{
    $del = 0;
    $sql = $pdo->prepare("SELECT * FROM meeting WHERE `meetingID` = ? AND del = ?");
    $sql->execute([
        $meeting_id,
        $del
    ]);
    return $sql->fetch();
}

$meeting_id = base64_decode(urldecode($_GET['meetingId']));
$row_meetings = selectData($pdo, $meeting_id);

if (isset($_POST['add_meeting_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        checkCsrf();
        $meeting_name = checkField($_POST["meeting_name"], 'Meeting name', ['min' => 2, 'max' => 256]);
        $watch_link = checkField($_POST["watch_link"], 'Watch Link', ['min' => 2, 'max' => 256]);
        $meeting_picture = uploadFile(null, 'meeting_picture', 'meeting', ['type' => 'image']);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $datetime = date('Y-m-d H:i:s');

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $update_sql = "UPDATE meeting SET 
            customer_id=:customer_id,
            meeting_name=:meeting_name,
            watch_link=:watch_link,
            meeting_picture=:meeting_picture,
            updated_date=:updated_date,
            updated_datetime=:updated_datetime,
            updated_time=:updated_time
        WHERE
            meetingId=:meeting_id";
            $params = [
                'customer_id' => $customer_id,
                'meeting_name' => $meeting_name,
                'watch_link' => $watch_link,
                'meeting_picture' => $meeting_picture,
                'updated_date' => $date,
                'updated_datetime' => $datetime,
                'updated_time' => $time,
                'meeting_id' => $meeting_id
            ];

            $stmt = $pdo->prepare($update_sql);
            $stmt->execute($params);
            $msg = "Record updated successfully";
        } catch (PDOException $e) {
            $error = "Error updating record";
        }
    }

    $row_meetings = selectData($pdo, $meeting_id);
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
            <h6 class="m-0 font-weight-bold text-primary">Update Meeting</h6>
            <a href="list_meeting.php" style="float:right;" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right" for="msg"></label>
                <div class="col-md-12">
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
                        <label class="col-md-4 col-form-label text-md-right" for="meeting_name">Meeting Name</label>
                        <div class="col-md-6">
                            <input type="text" id="meeting_name" name="meeting_name" class="form-control"
                                   value="<?php if (isset($row_meetings['meeting_name'])) {
                                       echo $row_meetings['meeting_name'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="meeting_picture">Meeting
                            Picture </label>
                        <div class="col-md-3">
                            <input type="file" id="meeting_picture" name="meeting_picture" class="form-control"
                                   value="">
                        </div>
                        <div class="col-md-3">
                            <img src="/<?php echo $row_meetings["meeting_picture"]; ?>"
                                 height="50px;" width="60px;">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="watch_link">Watch Link</label>
                        <div class="col-md-6">
                            <input type="text" id="watch_link" name="watch_link" class="form-control"
                                   value="<?php if (isset($row_meetings['watch_link'])) {
                                       echo $row_meetings['watch_link'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_meeting_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
