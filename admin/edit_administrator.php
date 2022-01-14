<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

$id = base64_decode(urldecode($_GET['Id']));

if (isset($_POST['add_btn'])) {

    try {
        checkCsrf();
        $name = checkField($_POST["name"], 'Name', ['min' => 2, 'max' => 64, 'regex' => 'a-zA-Z\s']);
        $surname = checkField($_POST["surname"], 'Surname', ['min' => 2, 'max' => 64, 'regex' => 'a-zA-Z\s']);
        $username = checkField($_POST["username"], 'Username', ['min' => 2, 'max' => 64, 'checkEmail' => true]);
        $password = md5(checkField($_POST["password"], 'Password', ['min' => 8, 'max' => 32]));
        $datetime = date('Y-m-d H:i:s');
        $user_type = 'customer';

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $update_sql = "UPDATE user SET 
            name=:name,
            surname=:surname,
            userName=:username,
            Password=:password,
            createAT=:create_at,
            userType=:user_type
        WHERE
            userID=:user_id";
            $params = [
                'name' => $name,
                'surname' => $surname,
                'username' => $username,
                'password' => $password,
                'create_at' => $datetime,
                'user_type' => $user_type,
                'user_id' => $id
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
$speaker_sql = $pdo->prepare("SELECT * FROM user WHERE `userID` = ? AND `del` = ?");
$speaker_sql->execute([
    $id,
    $del
]);
$row_data = $speaker_sql->fetch();
?>

<style type="text/css">
    .control-group.row {
        margin-bottom: 1rem;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Administrator</h6>
            <a href="administration.php" style="float:right;" class="btn btn-primary">Back</a>
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
                <input type="hidden" name="Id" value="<?php echo $id; ?>">
                <fieldset>
                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="speaker_name"> Name</label>
                        <div class="col-md-6">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?php if (isset($row_data['name'])) {
                                       echo $row_data['name'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="designation">SurName</label>
                        <div class="col-md-6">
                            <input type="text" id="surname" name="surname" class="form-control"
                                   value="<?php if (isset($row_data['surname'])) {
                                       echo $row_data['surname'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="linkdin">UserName</label>
                        <div class="col-md-6">
                            <input type="email" id="username" name="username" class="form-control"
                                   value="<?php if (isset($row_data['userName'])) {
                                       echo $row_data['userName'];
                                   } ?>">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="email">Password </label>
                        <div class="col-md-6">
                            <input type="password" id="password" name="password" class="form-control" value="">
                            <span>If you need to change password Please enter here</span>
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
