<?php
error_reporting(1);
include '../db_connection.php';
include 'header.php';
if(isset($_POST['delete_agenda_btn']))
{
	$id=$_POST['agendaID'];
	$sql = "DELETE FROM webex WHERE agendaID=$id";
if (mysqli_query($conn, $sql)) {
  $msg = "Record deleted successfully";
} else {
  $error = "Error deleting record: " . mysqli_error($conn);
}

}


?>

<div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">all Webex Links</h6>
            </div>
            <div class="card-body">
              <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right"  for="msg"></label>
                <div class="col-md-6">
                  <span id="msg" style="color: green;"><?php if(!empty($msg)){echo $msg; } ?></span>
                  <span id="error" style="color: red;"><?php if(!empty($error)){echo $error; } ?></span> 
                </div>
              </div>              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Agenda Name</th>
                      <th>Time schedule</th>
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
                      <th>Time schedule</th>
                      <th>Link title</th>
                      <th>link url</th>
                      <th>agenda Category 1</th>
					  <th>agenda Category 2</th>
					  <th>agenda Category 3</th>
                      <th>action</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php $sql = "SELECT * FROM agenda where customerID ='".$_SESSION["userID"]."' ";
$result = $conn->query($sql); 
while ($row = mysqli_fetch_assoc($result)) {

$agenda_cat_sql = "SELECT * FROM agenda_cat where agenda_cat_id ='".$row["agenda_category"]."' ";
$get_agenda_cat = $conn->query($agenda_cat_sql);
$row_agenda_cat = $get_agenda_cat->fetch_assoc();
	
$agenda_cat_sql2 = "SELECT * FROM agenda_cat where agenda_cat_id ='".$row["agenda_category_2"]."' ";
$get_agenda_cat2 = $conn->query($agenda_cat_sql2);
$row_agenda_cat2 = $get_agenda_cat2->fetch_assoc();
	
$agenda_cat_sql3 = "SELECT * FROM agenda_cat where agenda_cat_id ='".$row["agenda_category_3"]."' ";
$get_agenda_cat3 = $conn->query($agenda_cat_sql3);
$row_agenda_cat3 = $get_agenda_cat3->fetch_assoc(); 
?>
                    <tr>
                      <td><?php echo $row["agenda_name"];?></td>
                      <td><?php echo $row["time_schedule"];?></td>
                      <td><?php echo $row["link_title"];?></td>
                      <td><?php echo $row["link_url"];?></td>
                      <td><?php echo $row_agenda_cat["agenda_cat_name"];?></td>
					  <td><?php echo $row_agenda_cat2["agenda_cat_name"];?></td>
					  <td><?php echo $row_agenda_cat3["agenda_cat_name"];?></td>
                      <td>
                      	
                      	<ul class="list-inline m-0">                
                            <li class="list-inline-item" style="width: 30%">
                                <button  type="button" data-toggle="tooltip" data-placement="top" title="Edit" style="border: none;background: transparent;"><a href="<?php echo $adminURL;?>edit_agenda.php?agendaID=<?php echo $row["agendaID"]; ?>"><i class="fa fa-edit"></i></a></button>
                            </li>
                            <li class="list-inline-item">
                              <form method="POST" action="">
                                <input type="hidden" name="agendaID" value="<?php echo $row["agendaID"]; ?>">
                                <button type="submit" name="delete_agenda_btn"  data-toggle="tooltip" data-placement="top" title="Delete" style="border: none;background: transparent;"><i class="fa fa-trash"></i></button>
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