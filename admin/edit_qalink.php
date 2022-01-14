<?php
error_reporting(1);
include '../db_connection.php';
include 'header.php';

//session_start();
 ?>

<?php
if(isset($_POST['update_btn']))
{
    $questionanwId=$_GET['questionanwId'];
    $customer_id = $_SESSION["userID"];
    $qa_link = $_POST["qa_link"];
    $date=date('Y-m-d');
    $time=date('H:i:s');
    $datetime=date('Y-m-d H:i:s');
      $sql = "UPDATE qalinks SET `customer_id`=$customer_id,`qa_link`='$qa_link',`date`='$date',`datetime`='$datetime',`time`='$time' WHERE id='$questionanwId'"; 
    if ($conn->query($sql) === TRUE) {
        $msg = "QA Link Updated successfully";
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

       <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update QA Link</h6>
              <a href="qalink_list.php" style="float:right;" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body">
            <div class="control-group row">
                <label class="col-md-4 col-form-label text-md-right"  for="msg"></label>
                <div class="col-md-12">
                  <?php if(!empty($msg)){ echo "<div class='alert alert-success alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> $msg </div>";} ?> 
                  <?php if(!empty($error)){ echo "<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed!</strong> $error </div>"; } ?></span>
                </div>
              </div> 
<?php 
$questionanwId=$_GET['questionanwId'];
$qa_sql = "SELECT * FROM qalinks where id =$questionanwId and del=0";
$get_qa = $conn->query($qa_sql);
$row_qa= $get_qa->fetch_assoc();?>
              <form class="form-horizontal" action='' method="POST"  enctype="multipart/form-data">

                <fieldset>               

                   <div class="control-group row">
                    <label class="col-md-4 col-form-label text-md-right"  for="qa_link">QA Link</label>
                    <div class="col-md-6">
                      <input type="text" id="qa_link" name="qa_link" class="form-control" value="<?php if(isset($row_qa['qa_link'])){echo $row_qa['qa_link']; } ?>">
                    </div>
                  </div>  

                  <div class="col-md-6 offset-md-4">
                      <button type="submit" name="update_btn" class="btn btn-primary">Submit </button>
                  </div>
                </fieldset>

              </form>

            
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->



<?php include 'footer.php'; ?>
