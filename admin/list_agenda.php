<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/generateToken.php';

if (isset($_POST['delete_agenda_btn'])) {
    $id = base64_decode(urldecode($_POST['agendaID']));

    try {
        checkCsrf($id);

        $sql = "DELETE FROM agenda WHERE agendaID = :agendaID";
        $params = [
            'agendaID' => $id,
        ];

        $stmt= $pdo->prepare($sql);
        $stmt->execute($params);
        $msg = "Record deleted successfully";
        removeCsrf($id);
    } catch (PDOException $e) {
        $error = "Error deleting record";
    }
}
?>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Agenda</h6>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Agenda Name</th>
                            <th>Schedule Date</th>
                            <th>schedule Time</th>
                            <th>Link title</th>
                            <th>link url</th>
                            <th>agenda Category 1</th>
                            <th>agenda Category 2</th>
                            <th>agenda Category 3</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Agenda Name</th>
                            <th>Schedule Date</th>
                            <th>Schedule Time</th>
                            <th>Link title</th>
                            <th>link url</th>
                            <th>agenda Category 1</th>
                            <th>agenda Category 2</th>
                            <th>agenda Category 3</th>
                            <th>action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $sql = $pdo->prepare("SELECT * FROM agenda");
                        $sql->execute();

                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            if(isset($row["agenda_category"])) {
                                $agenda_cat_sql = $pdo->prepare("SELECT * FROM agenda_cat WHERE `agenda_cat_id` = ?");
                                $agenda_cat_sql->execute([
                                    $row["agenda_category"]
                                ]);
                                $row_agenda_cat = $agenda_cat_sql->fetch();
                            }

                            if(!empty($row["agenda_category_2"])) {
                                $agenda_cat_sql2 = $pdo->prepare("SELECT * FROM agenda_cat WHERE `agenda_cat_id` = ?");
                                $agenda_cat_sql2->execute([
                                    $row["agenda_category_2"]
                                ]);
                                $row_agenda_cat2 = $agenda_cat_sql2->fetch();
                            }

                            if(!empty($row["agenda_category_3"])) {
                                $agenda_cat_sql3 = $pdo->prepare("SELECT * FROM agenda_cat WHERE `agenda_cat_id` = ?");
                                $agenda_cat_sql3->execute([
                                    $row["agenda_category_3"]
                                ]);
                                $row_agenda_cat3 = $agenda_cat_sql3->fetch();
                            }
                            ?>
                            <tr>
                                <td><?php echo $row["agenda_name"]; ?></td>
                                <td><?php echo $row["schedule_date"]; ?></td>
                                <td><?php echo $row["schedule_start_time"] . ' - ' . $row["schedule_end_time"]; ?></td>
                                <td><?php echo $row["link_title"]; ?></td>
                                <td><?php echo $row["link_url"]; ?></td>
                                <td><?php echo $row_agenda_cat["agenda_cat_name"] ?? null; ?></td>
                                <td><?php echo $row_agenda_cat2["agenda_cat_name"] ?? null; ?></td>
                                <td><?php echo $row_agenda_cat3["agenda_cat_name"] ?? null; ?></td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item" style="width: 30%">
                                            <button type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit" style="border: none;background: transparent;"><a
                                                        href="<?php echo $adminURL; ?>edit_agenda.php?agendaID=<?php echo urlencode(base64_encode($row["agendaID"])); ?>"><i
                                                            class="fa fa-edit"></i></a></button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form method="POST" action="">
                                                <?php csrfHtml($row["agendaID"]); ?>
                                                <input type="hidden" name="agendaID"
                                                       value="<?php echo urlencode(base64_encode($row["agendaID"])); ?>">
                                                <button type="submit" name="delete_agenda_btn" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        style="border: none;background: transparent;"><i
                                                            class="fa fa-trash"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>