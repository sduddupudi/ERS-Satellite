<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

$_SESSION["userID"];

if (isset($_POST['add_agenda_cat_btn'])) {
    $customer_id = $_SESSION["userID"];

    try {
        checkCsrf();
        $agenda_cat_name = checkField($_POST["agenda_cat_name"], 'Category name', ['min' => 2, 'max' => 30]);
        $agenda_cat_color = checkField($_POST["agenda_cat_color"], 'Category color', ['min' => 7, 'max' => 7, 'regex' => 'a-fA-F0-9\#']);

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $query = "INSERT INTO `agenda_cat` (
                `customer_id`,
                `agenda_cat_name`,
                `category_color_code`           
            ) VALUES (
                :customer_id,
                :agenda_cat_name,
                :category_color_code
            )";
            $params = [
                ':customer_id' => $customer_id,
                ':agenda_cat_name' => $agenda_cat_name,
                ':category_color_code' => $agenda_cat_color
            ];

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $msg = "Agenda category insert successfully";
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
            <h6 class="m-0 font-weight-bold text-primary">Add agenda category</h6>
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
                <?php csrfHtml(); ?>
                <fieldset>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_cat_name">category Name</label>
                        <div class="col-md-6">
                            <input type="text" id="agenda_cat_name" name="agenda_cat_name" class="form-control"
                                   value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_cat_color">category
                            color</label>
                        <div class="col-md-6">
                            <input type="text" id="agenda_cat_color" name="agenda_cat_color" class="form-control"
                                   value="">
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
