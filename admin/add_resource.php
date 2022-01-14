<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['add_resource_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        checkCsrf();
        $resource_name = checkField($_POST["resource_name"], 'Resource name', ['min' => 2, 'max' => 256]);
        $resource_picture = uploadFile(null, 'resource_picture', 'resource', ['type' => 'image']);
        $resource_pdf = uploadFile(null, 'resource_pdf', 'resource', ['type' => 'pdf']);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $datetime = date('Y-m-d H:i:s');
        $del = 0;

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $query = "INSERT INTO `resource` (
                `customer_id`,
                `resource_name`,
                `resource_picture`,
                `resource_pdf`,
                `date`,
                `datetime`,
                `time`,
                `updated_date`,
                `updated_datetime`,
                `updated_time`,
                `del`           
            ) VALUES (
                :customer_id,
                :resource_name,
                :resource_picture,
                :resource_pdf,
                :date,
                :datetime,
                :time,
                :updated_date,
                :updated_datetime,
                :updated_time,
                :del
            )";
            $params = [
                ':customer_id' => $customer_id,
                ':resource_name' => $resource_name,
                ':resource_picture' => $resource_picture,
                ':resource_pdf' => $resource_pdf,
                ':date' => $date,
                ':datetime' => $datetime,
                ':time' => $time,
                ':updated_date' => $date,
                ':updated_datetime' => $datetime,
                ':updated_time' => $time,
                ':del' => $del
            ];

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $msg = "Resource insert successfully";
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
            <h6 class="m-0 font-weight-bold text-primary">Add Resource</h6>
            <a href="list_resource.php" style="float:right;" class="btn btn-primary">Back</a>
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
                        <label class="col-md-4 col-form-label text-md-right" for="resource_name">Resource Name</label>
                        <div class="col-md-6">
                            <input type="text" id="resource_name" name="resource_name" class="form-control" value=""
                                   required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resource_picture">Resource
                            Picture </label>
                        <div class="col-md-6">
                            <input type="file" id="resource_picture" name="resource_picture" class="form-control"
                                   value="" required="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resource_pdf">Resource </label>
                        <div class="col-md-6">
                            <input type="file" id="resource_pdf" name="resource_pdf" class="form-control" value=""
                                   required="">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_resource_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
