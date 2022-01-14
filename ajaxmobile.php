<?php
include 'db_connection.php';
session_start();

if($_POST['action'] == 'call_agenda') {
if(isset($_POST["agenda_category"])){
  $agenda_category = $_POST["agenda_category"]; 
}
 $cat_id ='';
if(!empty($agenda_category)){
foreach ($agenda_category as $value) {
    $cat_id .= "'".$value."',";
}
}
  $cat_id_f = rtrim($cat_id,","); 


if(!empty($agenda_category)){
  $cat_sql = "SELECT * FROM agenda_cat where agenda_cat_id IN ($cat_id_f) ORDER BY sort ASC";
}else{
     $cat_sql = "SELECT * FROM agenda_cat ORDER BY sort ASC";
}

 $cat_result = $conn->query($cat_sql); 
 while ($cat_row = mysqli_fetch_assoc($cat_result)){ 

$sql = "SELECT * FROM agenda where agenda_category ='".$cat_row["agenda_cat_id"]."'
    OR agenda_category_2 ='".$cat_row["agenda_cat_id"]."' OR agenda_category_3 ='".$cat_row["agenda_cat_id"]."' ORDER BY agenda_category, schedule_start_time ASC";
    // echo $sql;
    $get_row3 = $conn->query($sql); ?>
    <h5 class="text-center"><?php echo $cat_row['agenda_cat_name'] ?></h5>
 <?php  
  if ($get_row3) {
    while ($row = mysqli_fetch_assoc($get_row3)) { 
// echo"<pre>"; print_r($row);
?>
        
<div class="card border-0 rounded-0 mb-3">

             <?php if($row["type"]=='break'){  ?>

                <div class="break_box mb-3">
                <hr>
                    <div class="break_text_box">
                        <h6 class="break_time"><?php echo $row["schedule_start_time"];?> - <?php echo $row["schedule_end_time"];?></h6>
                        <h6 class="break_title mb-0"><?php echo $row["agenda_name"];?></h6>
                    </div>
                </div>

<?php }else{ ?>

          <div class="card-header d-flex justify-content-between align-items-start">
                    <span class="text-white small"><?php echo  $row["schedule_start_time"]; ?> - <?php echo  $row["schedule_end_time"]; ?></span>
                    <span class="text-white small"><?php $schedule_date = $row["schedule_date"]; echo $new_date = date('d-F ', strtotime($schedule_date));  ?></span>
           </div>
                
                <div class="card-body">
                    <h6 class=""><?php echo  $row["link_title"]; ?></h6>
                    <span class="small"><?php echo  $row["agenda_name"]; ?>
                    <?php if(!empty($row["speaker_name"])){ 
                        echo  $row["speaker_name"]; 
                     } ?>
                    <?php if(!empty($row["speaker_name2"])){ 
                        echo  $row["speaker_name2"]; 
                     } ?>
                    <?php if(!empty($row["speaker_name3"])){ 
                     echo  $row["speaker_name3"]; 
                    } ?>
                    <?php if(!empty($row["speaker_name4"])){ 
                        echo  $row["speaker_name4"]; 
                     } ?>
                    <?php if(!empty($row["speaker_name5"])){ 
                        echo  $row["speaker_name5"]; 
                    } ?>
                    <?php if(!empty($row["speaker_name6"])){ 
                        echo  $row["speaker_name6"]; 
                    } ?>

                    <?php if(!empty($row["speaker_name7"])){ 
                        echo  $row["speaker_name7"]; 
                    } ?>

                    <?php if(!empty($row["speaker_name8"])){ 
                        echo  $row["speaker_name8"]; 
                    } ?>

                    <?php if(!empty($row["speaker_name9"])){ 
                        echo  $row["speaker_name9"]; 
                    } ?>
                  </span>

                     <div class="btn_box">
                            <?php if($row["link_title"]!=''){ ?>
                               <a href="<?php echo $row["link_url"] ?>" class="btn customMeeting_btn btn-sm"><?php echo $row["link_title"]; ?></a> 
                            <?php  }else{ ?>
                            <a href="<?php echo $row["link_url"] ?>" class="btn customMeeting_btn btn-sm">Go To Meeting</a>

                               <?php } ?>
                            
                            <a href="#" class="btn customMeeting_btn btn-sm"><?php echo $cat_row['agenda_cat_name'] ?></a>
                        </div>
                </div>


        <?php } ?>


            </div>

            <?php }  } else{ ?>

 <div class="col-lg-3 col-md-6">
            <div class="card border-0 rounded-0 mb-3">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <span class="text-white small"></span>
                    <span class="text-white small"></span>
                </div>
                <div class="card-body">
                    <h6 class="">No Agenda Found</h6>
                    <!-- <span class="small">Katherine, Johnson</span> -->
                </div>
            </div>
        </div>

  <?php  } } ?>

        </div>

 <?php } ?>

                      
