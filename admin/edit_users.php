<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

$user_id = base64_decode(urldecode($_GET['userID']));

if (isset($_POST['add_user_btn'])) {

    try {
        checkCsrf();
        $username = checkField($_POST["user_name"], 'Username', ['min' => 2, 'max' => 64, 'checkEmail' => true]);
        $encript_password = md5(checkField($_POST["password"], 'Password', ['min' => 8, 'max' => 32]));
        $user_type = checkField($_POST["userType"], 'Type', ['min' => 2, 'max' => 16, 'regex' => 'a-zA-Z']);
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
            $update_sql = "UPDATE user SET 
            userName=:username,
            Password=:password,
            userType=:user_type
        WHERE
            userId=:user_id";
            $params = [
                'username' => $username,
                'password' => $password,
                'user_type' => $user_type,
                'user_id' => $user_id
            ];

            $stmt = $pdo->prepare($update_sql);
            $stmt->execute($params);
            $msg = "Record updated successfully";
        } catch (PDOException $e) {
            $error = "Error updating record";
        }
    }
}

$del = 0;
$user_sql = $pdo->prepare("SELECT * FROM user WHERE `userID` = ? AND del = ?");
$user_sql->execute([
    $user_id,
    $del
]);
$row_user = $user_sql->fetch();
?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Users</h6>
            <a href="list_users.php" style="float:right;" class="btn btn-primary">Back</a>
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
                        <label class="col-md-4 col-form-label text-md-right" for="speaker_name">User Name</label>
                        <div class="col-md-6">
                            <input type="text" id="speaker_name" name="user_name" class="form-control"
                                   value="<?php if (isset($row_user['userName'])) {
                                       echo $row_user['userName'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="designation">Password</label>
                        <div class="col-md-6">
                            <input type="password" id="password" name="password" class="form-control"
                                   value="<?php if (isset($row_user['password'])) {
                                       echo $row_user['password'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="linkdin">Type</label>
                        <div class="col-md-6">
                            <input type="text" id="userType" name="userType" class="form-control"
                                   value="<?php if (isset($row_user['userType'])) {
                                       echo $row_user['userType'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_user_btn" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
