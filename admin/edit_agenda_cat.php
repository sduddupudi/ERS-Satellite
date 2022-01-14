<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';

if (isset($_POST['add_agenda_cat_btn'])) {

    $customer_id = $_SESSION["userID"];
    try {
        $agenda_cat_name = checkField($_POST["agenda_cat_name"], 'Category name', ['min' => 2, 'max' => 30]);
        $agenda_cat_color = checkField($_POST["agenda_cat_color"], 'Category color', ['min' => 7, 'max' => 7, 'regex' => 'a-fA-F0-9\#']);
        $id = base64_decode(urldecode($_GET["agenda_cat_id"]));

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $params = [
                'agenda_cat_name' => $agenda_cat_name,
                'category_color_code' => $agenda_cat_color,
                'agenda_cat_id' => $id
            ];

            $update_sql = "UPDATE agenda_cat SET 
            agenda_cat_name=:agenda_cat_name,
            category_color_code=:category_color_code
        WHERE 
            agenda_cat_id=:agenda_cat_id";

            $stmt = $pdo->prepare($update_sql);
            $stmt->execute($params);
            $msg = "Record updated successfully";
        } catch (PDOException $e) {
            $error = "Error updating record";
        }
    }
}

$agenda_cat_sql = $pdo->prepare("SELECT * FROM agenda_cat WHERE `agenda_cat_id` = ?");
$agenda_cat_sql->execute([
    base64_decode(urldecode($_GET["agenda_cat_id"]))
]);
$row_agenda_cat = $agenda_cat_sql->fetch();

?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit agenda category</h6>
        </div>
        <div class="card-body">

            <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right" for="msg"></label>
                <div class="col-md-6">
                    <span id="msg" style="color: green;"><?php if (!empty($msg)) {
                            echo $msg;
                        } ?></span>
                    <span id="error" style="color: red;"><?php if (!empty($error)) {
                            echo $error;
                        } ?></span>
                </div>
            </div>

            <form class="form-horizontal" action='' method="POST">
                <fieldset>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_cat_name">category Name</label>
                        <div class="col-md-6">
                            <input type="text" id="agenda_cat_name" name="agenda_cat_name" class="form-control"
                                   value="<?php if (isset($row_agenda_cat['agenda_cat_name'])) {
                                       echo $row_agenda_cat['agenda_cat_name'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_cat_color">category
                            color</label>
                        <div class="col-md-6">
                            <input type="text" id="agenda_cat_color" name="agenda_cat_color" class="form-control"
                                   value="<?php if (isset($row_agenda_cat['category_color_code'])) {
                                       echo $row_agenda_cat['category_color_code'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_agenda_cat_btn" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
