<?php
include '../db_connection.php';
include 'header.php';
include 'helpers/checkField.php';
include 'helpers/generateToken.php';

if (isset($_POST['add_agenda_btn'])) {

    $customer_id = $_SESSION["userID"];

    try {
        checkCsrf();
        $agenda_name = checkField($_POST["agenda_name"], 'Agenda name', ['min' => 2, 'max' => 256]);
        $schedule_date = checkField($_POST["schedule_date"], 'Schedule date', ['min' => 10, 'max' => 10, 'regex' => '0-9\-']);
        $schedule_date_color = checkField($_POST["schedule_date_color"], 'Schedule date color code', ['min' => 7, 'max' => 7, 'regex' => 'a-fA-F0-9\#']);
        $schedule_start_time = checkField($_POST["schedule_start_time"], 'Schedule start time', ['min' => 5, 'max' => 5, 'regex' => '0-9:']);
        $schedule_end_time = checkField($_POST["schedule_end_time"], 'Schedule end time', ['min' => 5, 'max' => 5, 'regex' => '0-9:']);
        $link_title = checkField($_POST["link_title"], 'Meeting button title', ['min' => 2, 'max' => 256]);
        $link_url = checkField($_POST["link_url"], 'Meeting button url', ['min' => 2, 'max' => 256]);
        $link_color = checkField($_POST["link_color"], 'Meeting button color code', ['min' => 7, 'max' => 7, 'regex' => 'a-fA-F0-9\#']);
        $agenda_category = checkField($_POST['agenda_category'], 'Agenda category', ['required' => true]);
        $agenda_category_2 = $_POST['agenda_category_2'];
        $agenda_category_3 = $_POST['agenda_category_3'];
        $type = checkField($_POST['type'], 'Type', ['required' => true]);

        $isValid = true;
    } catch (Exception $e) {
        $isValid = false;
        $error = "Error: " . $e->getMessage();
    }

    if($isValid) {
        try {
            $query = "INSERT INTO `agenda` (
            `customerID`,
            `agenda_name`,
            `schedule_date`,
            `schedule_date_color`,
            `schedule_start_time`,
            `schedule_end_time`,
            `link_title`,
            `link_url`,
            `link_color`,
            `agenda_category`,
            `agenda_category_2`,
            `agenda_category_3`,
            `type`
        ) VALUES (
            :customerID,
            :agenda_name,
            :schedule_date,
            :schedule_date_color,
            :schedule_start_time,
            :schedule_end_time,
            :link_title,
            :link_url,
            :link_color,
            :agenda_category,
            :agenda_category_2,
            :agenda_category_3,
            :type
        )";
            $params = [
                ':customerID' => $customer_id,
                ':agenda_name' => $agenda_name,
                ':schedule_date' => $schedule_date,
                ':schedule_date_color' => $schedule_date_color,
                ':schedule_start_time' => $schedule_start_time,
                ':schedule_end_time' => $schedule_end_time,
                ':link_title' => $link_title,
                ':link_url' => $link_url,
                ':link_color' => $link_color,
                ':agenda_category' => $agenda_category,
                ':agenda_category_2' => $agenda_category_2,
                ':agenda_category_3' => $agenda_category_3,
                ':type' => $type
            ];

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $msg = "Agenda insert successfully";
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
            <h6 class="m-0 font-weight-bold text-primary">Add agenda</h6>
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
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_name">Agenda Name</label>
                        <div class="col-md-6">
                            <input type="text" id="agenda_name" name="agenda_name" class="form-control" value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="schedule_date"> Schedule Date</label>
                        <div class="col-md-6">
                            <input type="text" id="schedule_date" name="schedule_date" class="form-control" value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="schedule_date_color"> Schedule Date
                            Color Code</label>
                        <div class="col-md-6">
                            <input type="text" id="schedule_date_color" name="schedule_date_color" class="form-control"
                                   value="" placeholder="#FFFFFF">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="schedule_start_time"> Schedule Start
                            Time</label>
                        <div class="col-md-6">
                            <input type="text" id="schedule_start_time" name="schedule_start_time" class="form-control"
                                   value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="schedule_end_time"> Schedule End
                            Time</label>
                        <div class="col-md-6">
                            <input type="text" id="schedule_end_time" name="schedule_end_time" class="form-control"
                                   value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="link_title">Meeting Button
                            title </label>
                        <div class="col-md-6">
                            <input type="text" id="link_title" name="link_title" class="form-control" value=""
                                   placeholder="go to meeting">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="link_url"> Meeting Button url </label>
                        <div class="col-md-6">
                            <input type="text" id="link_url" name="link_url" class="form-control" value="">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="link_color"> Meeting Button Color
                            Code </label>
                        <div class="col-md-6">
                            <input type="text" id="link_color" name="link_color" class="form-control" value=""
                                   placeholder="#FFFFFF">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_category">agenda
                            Category </label>
                        <div class="col-md-6">
                            <select id="agenda_category" name="agenda_category" class="form-control">
                                <option value="">select agenda category</option>
                                <?php $sql = "SELECT * FROM agenda_cat  ";
                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["agenda_cat_id"] . '">' . $row["agenda_cat_name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_category_2">agenda Category
                            2 </label>
                        <div class="col-md-6">
                            <select id="agenda_category_2" name="agenda_category_2" class="form-control">
                                <option value="">select agenda category</option>
                                <?php $sql = "SELECT * FROM agenda_cat  ";
                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["agenda_cat_id"] . '">' . $row["agenda_cat_name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="agenda_category_3">agenda Category
                            3</label>
                        <div class="col-md-6">
                            <select id="agenda_category_3" name="agenda_category_3" class="form-control">
                                <option value="">select agenda category</option>
                                <?php $sql = "SELECT * FROM agenda_cat   ";
                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["agenda_cat_id"] . '">' . $row["agenda_cat_name"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="type">Type</label>
                        <div class="col-md-6">
                            <select id="type" name="type" class="form-control" required="">
                                <option value="">Type</option>
                                <option value="event">Event</option>
                                <option value="break">Break</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="add_agenda_btn" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $("#schedule_date").datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd",
        onSelect: function (date, datepicker) {
            let dependent = $(this).data('dependent');
            let thisDate = $(this).val();
            $(dependent).datepicker("option", "minDate", thisDate);
            $(dependent).datepicker('refresh');
        }
    });

    $('#schedule_start_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 5,
        use24hours: true,
        scrollbar: true,
    });

    $('#schedule_end_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 5,
        use24hours: true,
        scrollbar: true,
    });
</script>