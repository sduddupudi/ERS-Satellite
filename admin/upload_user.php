<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/uploadFile.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['add_btn'])) {
    if (!empty($_FILES['user_file']['name'])) {

        try {
            checkCsrf();
            $file_url = uploadFile(null, 'user_file', 'user', ['type' => 'csv']);

            $isValid = true;
        } catch (Exception $e) {
            $isValid = false;
            $error = "Error: " . $e->getMessage();
        }

        if ($isValid && $file_url) {
            $csvFile = fopen('../'.$file_url, 'r');
            fgetcsv($csvFile);
            $total_insert_user = 0;
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                $email = $line[0];
                $password = md5($line[1]);
                $type = 'subscriber';
                $datetime = date('Y-m-d H:i:s');

                $get_sql = $pdo->prepare("SELECT * FROM user WHERE `userName` = ?");
                $get_sql->execute([
                    $email
                ]);
                $row_lobby = $get_sql->fetch();
                $verify_status = 1;
                $del = 0;

                try {
                    $query = "INSERT INTO `user` (
                        `name`,
                        `surname`,
                        `userName`,
                        `Password`,
                        `userType`,
                        `createAT`,
                        `verifyStatus`,
                        `del`
                    ) VALUES (
                        :name,
                        :surname,
                        :user_name,
                        :password,
                        :user_type,
                        :create_at,
                        :verify_status,
                        :del
                    )";
                    $params = [
                        ':name' => '',
                        ':surname' => '',
                        ':user_name' => $email,
                        ':password' => $password,
                        ':user_type' => $type,
                        ':create_at' => $datetime,
                        ':verify_status' => $verify_status,
                        ':del' => $del
                    ];

                    $stmt = $pdo->prepare($query);
                    $stmt->execute($params);
                    $total_insert_user++;
                } catch (PDOException $e) {
                    $error = "Error: Failed!";
                }
            }
            fclose($csvFile);
            $msg = $total_insert_user . " User Upload successfully";
        }
    } else {
        $error = "Error: Failed!";
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
            <h6 class="m-0 font-weight-bold text-primary">Upload User</h6>
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
                        <label class="col-md-4 col-form-label text-md-right" for="user_file">Upload User</label>
                        <div class="col-md-4">
                            <input type="file" id="user_file" name="user_file" class="form-control" value="" required=""
                                   accept=".csv">
                        </div>
                        <div class="col-md-4">
                            <a href="/assets/upload_format.csv" download>SAMPLE CSV</a>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
