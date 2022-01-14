<?php
error_reporting(1);
include '../db_connection.php';
include 'header.php';

if(isset($_POST['delete_questionanw_btn']))
{
	$id=$_POST['questionanwId'];
	$sql = "UPDATE questionanw SET `del`=1 WHERE questionanwId='$id'";
	if (mysqli_query($conn, $sql)) {
	  $msg = "Record deleted successfully";
	} else {
	  $error = "Error deleting record: " . mysqli_error($conn);
	}
}?>

<div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">QA Links</h6>
              <!-- <a href="add_questionanw.php" style="float:right;" class="btn btn-primary">Add</a> -->
            </div>
            <div class="card-body">
              <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right"  for="msg"></label>
                <div class="col-md-12">
                  <?php if(!empty($msg)){ echo "<div class='alert alert-success alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> $msg </div>";} ?> 
                  <?php if(!empty($error)){ echo "<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed!</strong> $error </div>"; } ?></span>
                </div>
              </div>              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>QA Link</th>
                      <th>Added Date</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>QA Link</th>
                      <th>Added Date</th>
                      <th>action</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php 
$i=1;
$cid=$_SESSION['userID'];
$sql = "SELECT * FROM qalinks where customer_id=$cid and del=0";
$result = $conn->query($sql); 
while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row["qa_link"];?></td>
                      <td><?php echo $row["date"];?></td>
                      <td>
                      	
                      	<ul class="list-inline m-0">                
                            <li class="list-inline-item" style="width: 30%">
                                <button  type="button" data-toggle="tooltip" data-placement="top" title="Edit" style="border: none;background: transparent;"><a href="<?php echo $adminURL;?>edit_qalink.php?questionanwId=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i></a></button>
                            </li>
                            <!-- <li class="list-inline-item">
                              <form method="POST" action="">
                                <input type="hidden" name="questionanwId" value="<?php //echo $row["questionanwId"]; ?>">
                                <button type="submit" name="delete_questionanw_btn"  data-toggle="tooltip" data-placement="top" title="Delete" style="border: none;background: transparent;"><i class="fa fa-trash"></i></button>
                              </form>
                                
                            </li> -->
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