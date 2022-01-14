<?php
//error_reporting(1);
include '../db_connection.php';
include 'header.php';

if(isset($_POST['submit_btn']))
{
    
    $rg_menu_1_appears = $_POST['rg_menu_1_appears'];
    $rg_menu_2_appears = $_POST['rg_menu_2_appears'];
    $rg_menu_3_appears = $_POST['rg_menu_3_appears'];
    $rg_menu_4_appears = $_POST['rg_menu_4_appears'];
    $rg_menu_5_appears = $_POST['rg_menu_5_appears'];

    $get_sql = "SELECT ID FROM rg_menu_setting ";
    $result = $conn->query($get_sql);
    $row = $result->fetch_assoc();

    if(empty($row)){
    
    $sql = "INSERT INTO rg_menu_setting ( rg_menu_1_appears,rg_menu_2_appears,rg_menu_3_appears,rg_menu_4_appears,rg_menu_5_appears)
    VALUES ('".$rg_menu_1_appears."' ,'".$rg_menu_2_appears."','".$rg_menu_3_appears."','".$rg_menu_4_appears."','".$rg_menu_5_appears."' )";
    
    if ($conn->query($sql) === TRUE) {
          $msg = "Record insert successfully";
    } else {
          $error = $sign_up_error = "Error: Failed!";
    }
    
    }else{
        $update_sql = "UPDATE rg_menu_setting SET 
       
        rg_menu_1_appears = '".$rg_menu_1_appears."',
        rg_menu_2_appears = '".$rg_menu_2_appears."',
        rg_menu_3_appears = '".$rg_menu_3_appears."',
        rg_menu_4_appears = '".$rg_menu_4_appears."',
        rg_menu_5_appears = '".$rg_menu_5_appears."'
        WHERE ID='1'  ";

        if ($conn->query($update_sql) === TRUE) {
              $msg = "Record updated successfully";
        } else {
              $error = "Error updating record: " . $conn->error;
        }  
    }

}

    $rg_menu_setting_sql = "SELECT * FROM rg_menu_setting  ";
    $get_rg_menu_setting = $conn->query($rg_menu_setting_sql);
    $row_rg_menu_setting = $get_rg_menu_setting->fetch_assoc();
    //print_r($row_rg_menu_setting);

?>

<style type="text/css">
  .control-group.row {
    margin-bottom: 1rem;
}
input[type=checkbox] {
    /*margin: 13px 0px 0px 0px;*/
}
</style>

       <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registration Menu options</h6>
            </div>
            <div class="card-body">
              <span style="color: green;"><?php if(!empty($msg)){echo $msg; } ?></span>
              <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">

                <fieldset>

          <div style="font-weight: bold;">Choose between options:</div>
          <hr class="sidebar-divider"> 
                <div class="control-group row">
                    <label class="col-md-8 col-form-label"  >Single password without login</label>              
                    <div class="col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rg_menu_1_appears" name="rg_menu_1_appears" value="yes" <?php if($row_rg_menu_setting['rg_menu_1_appears'] == 'yes'){echo 'checked'; } ?> >
                      <label class="form-check-label" for="rg_menu_1_appears">Pleasse Check if need to appears</label>
                    </div>
                    </div>
                </div>

                <div class="control-group row">
                    <label class="col-md-8 col-form-label"  >Email open signup</label>              
                    <div class="col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rg_menu_2_appears" name="rg_menu_2_appears" value="yes" <?php if($row_rg_menu_setting['rg_menu_2_appears'] == 'yes'){echo 'checked'; } ?> >
                      <label class="form-check-label" for="rg_menu_2_appears">Pleasse Check if need to appears</label>
                    </div>
                    </div>
                </div>

                <div class="control-group row">
                    <label class="col-md-8 col-form-label"  >Email based on attendees email list with single password for all </label>              
                    <div class="col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rg_menu_3_appears" name="rg_menu_3_appears" value="yes" <?php if($row_rg_menu_setting['rg_menu_3_appears'] == 'yes'){echo 'checked'; } ?> >
                      <label class="form-check-label" for="rg_menu_3_appears">Pleasse Check if need to appears</label>
                    </div>
                    </div>
                </div>

                <div class="control-group row">
                    <label class="col-md-8 col-form-label"  > Email based on attendees email list with personalised password </label>              
                    <div class="col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rg_menu_4_appears" name="rg_menu_4_appears" value="yes" <?php if($row_rg_menu_setting['rg_menu_4_appears'] == 'yes'){echo 'checked'; } ?> >
                      <label class="form-check-label" for="rg_menu_4_appears">Pleasse Check if need to appears</label>
                    </div>
                    </div>
                </div>


                <div class="control-group row">
                    <label class="col-md-8 col-form-label"  > Cvent API </label>              
                    <div class="col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="rg_menu_5_appears" name="rg_menu_5_appears" value="yes" <?php if($row_rg_menu_setting['rg_menu_5_appears'] == 'yes'){echo 'checked'; } ?> >
                      <label class="form-check-label" for="rg_menu_5_appears">Pleasse Check if need to appears</label>
                    </div>
                    </div>
                </div>

                  <div class="col-md-6 offset-md-4">
                            <button type="submit" name="submit_btn" class="btn btn-primary">
                            Submit
                            </button>
                        </div>
                </fieldset>
              </form>

            
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

<?php include 'footer.php'; ?>
