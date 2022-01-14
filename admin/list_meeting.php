<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/generateToken.php';

if (isset($_POST['delete_meating_btn'])) {
    $id = $_POST['meetingId'];

    try {
        checkCsrf($id);
        $update_sql = "UPDATE meeting SET
            del=:del
        WHERE
            meetingId=:meeting_id";
        $params = [
            'del' => 1,
            'meeting_id' => $id
        ];

        $stmt = $pdo->prepare($update_sql);
        $stmt->execute($params);
        $msg = "Record deleted successfully";
        removeCsrf($id);
    } catch (PDOException $e) {
        $error = "Error deleting record";
    }
} ?>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All meating</h6>
                <a href="add_meeting.php" style="float:right;" class="btn btn-primary">Add</a>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Meating Name</th>
                            <th>Picture</th>
                            <th>Watch Link</th>
                            <th>Added Date</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Meating Name</th>
                            <th>Picture</th>
                            <th>Watch Link</th>
                            <th>Added Date</th>
                            <th>action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $del = 0;
                        $sql = $pdo->prepare("SELECT * FROM meeting WHERE `del` = ?");
                        $sql->execute([
                            $del
                        ]);

                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row["meeting_name"]; ?></td>
                                <td><img src="../admin/uploads/meeting/<?php echo $row["meeting_picture"]; ?>"
                                         height="50px;" width="60px;"></td>
                                <td><a href="<?php echo $row["watch_link"]; ?>"><?php echo $row["watch_link"]; ?></a>
                                </td>
                                <td><?php echo $row["date"]; ?></td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item" style="width: 30%">
                                            <button type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit" style="border: none;background: transparent;"><a
                                                        href="<?php echo $adminURL; ?>edit_meeting.php?meetingId=<?php echo urlencode(base64_encode($row["meetingId"])); ?>"><i
                                                            class="fa fa-edit"></i></a></button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form method="POST" action="">
                                                <?php csrfHtml($row["meetingId"]); ?>
                                                <input type="hidden" name="meetingId"
                                                       value="<?php echo $row["meetingId"]; ?>">
                                                <button type="submit" name="delete_meating_btn" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        style="border: none;background: transparent;"><i
                                                            class="fa fa-trash"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>