<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

function selectData($pdo, $resource_id)
{
    $del = 0;
    $sql = $pdo->prepare("SELECT * FROM resource WHERE `resourceID` = ? AND del = ?");
    $sql->execute([
        $resource_id,
        $del
    ]);
    return $sql->fetch();
}

$resource_id = base64_decode(urldecode($_GET['resourceId']));
$row_resources = selectData($pdo, $resource_id);

if (isset($_POST['add_resource_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        checkCsrf();
        $resource_name = checkField($_POST["resource_name"], 'Resource name', ['min' => 2, 'max' => 256]);
        $resource_picture = uploadFile($row_resources, 'resource_picture', 'resource', ['type' => 'image']);
        $resource_pdf = uploadFile($row_resources, 'resource_pdf', 'resource', ['type' => 'pdf']);
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
            $update_sql = "UPDATE resource SET 
            customer_id=:customer_id,
            resource_name=:resource_name,
            resource_picture=:resource_picture,
            resource_pdf=:resource_pdf,
            updated_date=:updated_date,
            updated_datetime=:updated_datetime,
            updated_time=:updated_time
        WHERE
            resourceId=:resource_id";
            $params = [
                'customer_id' => $customer_id,
                'resource_name' => $resource_name,
                'resource_picture' => $resource_picture,
                'resource_pdf' => $resource_pdf,
                'updated_date' => $date,
                'updated_datetime' => $datetime,
                'updated_time' => $time,
                'resource_id' => $resource_id
            ];

            $stmt = $pdo->prepare($update_sql);
            $stmt->execute($params);
            $msg = "Record updated successfully";
        } catch (PDOException $e) {
            $error = "Error updating record";
            print_r($stmt->errorInfo());
        }
    }

    $row_resources = selectData($pdo, $resource_id);
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
            <h6 class="m-0 font-weight-bold text-primary">Update resource</h6>
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
                            <input type="text" id="resource_name" name="resource_name" class="form-control"
                                   value="<?php if (isset($row_resources['resource_name'])) {
                                       echo $row_resources['resource_name'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resource_picture">Resource
                            Picture </label>
                        <div class="col-md-3">
                            <input type="file" id="resource_picture" name="resource_picture" class="form-control"
                                   value="">
                        </div>
                        <div class="col-md-3">
                            <img src="/<?php echo $row_resources["resource_picture"]; ?>"
                                 height="50px;" width="60px;"></img>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="resource_pdf">Resource </label>
                        <div class="col-md-3">
                            <input type="file" id="resource_pdf" name="resource_pdf" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <a href="/<?php echo $row_resources["resource_pdf"]; ?>"
                               download><img src="/admin/img/icon_pdf.png" height="50px;" width="60px;"></img></a>
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
