<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

function selectData($pdo)
{
    $info_icon_sql = $pdo->prepare("SELECT * FROM info_icon");
    $info_icon_sql->execute();
    return $info_icon_sql->fetch();
}

$row_info_icon = selectData($pdo);

if (isset($_POST['info_icon_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        checkCsrf();
        $info_icon = uploadFile($row_info_icon, 'info_icon', 'info_icon', ['type' => 'image']);

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        if (empty($row_info_icon)) {
            try {
                $query = "INSERT INTO `info_icon` (
                `customer_id`,
                `info_icon`           
            ) VALUES (
                :customer_id,
                :info_icon
            )";
                $params = [
                    ':customer_id' => $customer_id,
                    ':info_icon' => $info_icon
                ];

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $msg = "Info icon insert successfully";
            } catch (PDOException $e) {
                $error = "Error: Failed!";
            }
        } else {
            try {
                $update_sql = "UPDATE info_icon SET 
            info_icon=:info_icon
        WHERE
            info_icon_ID=:info_icon_id";
                $params = [
                    'info_icon' => $info_icon,
                    'info_icon_id' => $row_info_icon["info_icon_ID"]
                ];

                $stmt = $pdo->prepare($update_sql);
                $stmt->execute($params);
                $msg = "Record updated successfully";
            } catch (PDOException $e) {
                $error = "Error updating record";
            }
        }
    }

    $row_info_icon = selectData($pdo);
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
            <h6 class="m-0 font-weight-bold text-primary">Add Info Icon</h6>
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
                        <label class="col-md-4 col-form-label text-md-right" for="info_icon">info icon </label>
                        <div class="col-md-3">
                            <input type="file" id="info_icon" name="info_icon" class="form-control" value=""
                                   required="">
                        </div>
                        <div class="col-md-3">
                            <img src="/<?php echo $row_info_icon["info_icon"]; ?>"
                                 height="50px;" width="60px;">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="info_icon_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
