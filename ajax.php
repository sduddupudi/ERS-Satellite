<?php
include 'db_connection.php';
session_start();
if($_POST['action'] == 'call_agenda') {
$agenda_category = $_POST["agenda_category"]; 
 $cat_id ='';
// if(!empty($agenda_category)){
foreach ($agenda_category as $value) {
    $cat_id .= "'".$value."',";
}
// }
// echo "<pre>"; print_r($cat_id);die;
$cat_id_f = rtrim($cat_id,",");
// $cat_id = implode(',', $agenda_category);
if(!empty($agenda_category)){
 $sql = "SELECT * FROM agenda where agenda_category IN ($cat_id_f) OR agenda_category_2 IN ($cat_id_f) OR agenda_category_3 IN ($cat_id_f) ORDER BY schedule_date ASC , schedule_start_time ASC"; 
}else {
    $sql = "SELECT * FROM agenda ORDER BY schedule_date ASC , schedule_start_time ASC";
}
$result = $conn->query($sql); 
$num_rows_agenda =  mysqli_num_rows($result);
$a_i = 1;
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

if($a_i == 1 || $a_i == $a_j){
    echo '<div class="speaker_inner">';
}
?>                                       
                                        <div class="agenda_list_grid">
                                            <h3><?php echo $row["agenda_name"];?></h3>
                                            <p><?php echo $row["time_schedule"];?></p>
                                            <ul class="d-flex">
                                                <li><a href="<?php echo $row["link_url"];?>" class="bluebutton"><?php echo $row["link_title"];?></a></li>
                                                <li><a href="#" style="background: <?php echo $row_agenda_cat["category_color_code"];?>!important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;" class=""><?php echo $row_agenda_cat["agenda_cat_name"];?></a></li>
<li><a href="#" style="background: <?php echo $row_agenda_cat2["category_color_code"];?>!important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;" class=""><?php echo $row_agenda_cat2["agenda_cat_name"];?></a></li>
<li><a href="#" style="background: <?php echo $row_agenda_cat3["category_color_code"];?>!important; border-bottom-right-radius: 8px; padding: 3px 10px; color: #fff; text-transform: uppercase; font-size: 13px; display: block;" class=""><?php echo $row_agenda_cat3["agenda_cat_name"];?></a></li>
                                            </ul>
                                        </div>
                                    
<?php

if ($a_i%3==0){
    $a_j = $a_i+1;
    echo '</div>';
}elseif ($a_i == $num_rows_agenda && $num_rows_agenda%3!=0) {
    echo '</div>';
}
$a_i++;
}//end of while
}


if($_POST['action'] == 'callSpeakerPagination') {

// $sql_speakers = "SELECT * FROM speakers where  del=0";
$per_page_record = 9;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_POST["page"])) {    
    $page  = $_POST["page"];    
}    
else {    
  $page=1;    
}    

$start_from = ($page-1) * $per_page_record;

$query = "SELECT COUNT(*) FROM speakers";     
$rs_result = mysqli_query($conn, $query);     
$row = mysqli_fetch_row($rs_result);     
$total_records = $row[0];     

// Number of pages required.   
$total_pages = ceil($total_records / $per_page_record);     
$pagLink = "";  

?>

<nav aria-label="Page navigation example" style="width: 100%">
<!-- pagination sm -->
  <ul class="pagination pagination-sm" style="float: right;">
  <!-- pagination sm -->
    <li class="page-item">
        <?php if($page>=2){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getSpeakerPagination(<?php echo $page-1; ?>);" aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
      <?php }else{?>
        <a class="page-link" href="javascript:void(0)"  aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
  <?php } ?>
    </li>


    <?php for ($i=1; $i<=$total_pages; $i++) {     
          if ($i == $page) {   
              $pagLink .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>".$i." </a></li>";   
          }               
          else  {   
              $pagLink .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getSpeakerPagination(".$i.");' >  ".$i." </a></li>";     
          }   
        };     
        echo $pagLink; ?>

    <li class="page-item">
        <?php if($page<$total_pages){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getSpeakerPagination(<?php echo $page+1; ?>);" aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php }else{?>
    <a class="page-link" href="javascript:void(0)"  aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php } ?>
    </li>

  </ul>
</nav>

<?php
$sql_speakers = "SELECT * FROM speakers where  del=0  
ORDER BY `speakers`.`customer_id` ASC LIMIT $start_from, $per_page_record";

$result_speakers = $conn->query($sql_speakers); 

$num_rows_speakes =  mysqli_num_rows($result_speakers);
$s_i = 1;

while ($row_speaker = mysqli_fetch_assoc($result_speakers)) {


/*if($s_i == 1 || $s_i == $s_j){
    echo '<div class="speaker_inner col-lg-4 col-md-4">';
}*/
?>

                                        <div class="speakers_col d-flex col-lg-4 col-md-4">
                                            <div class="speaker_prof_img">
                                                <img src="admin/uploads/speaker/<?php echo $row_speaker["profile"];?>">
                                                <!-- <img src="http://13.94.255.113/plesk-site-preview/octworkshop.ch/https/10.0.0.4/admin/uploads/speaker/Peter-Maloca.jpg"> -->
                                            </div>
                                            <div class="speaker_prof_bio">
                                                
                                                <h4><?php echo $row_speaker["speaker_name"];?> <strong><?php echo $row_speaker["speaker_name2"];?></strong></h4>
                                                <p><?php echo $row_speaker["designation"];?></p>
                                                <ul class="d-flex profile_social">
                                                <li><a target="_blank" href="<?php echo $row_speaker["linkdin"];?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                                <li><a target="_blank" href="mailto:<?php echo $row_speaker["email"];?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
 <?php
/*if($s_i == 3){*/
/*if ($s_i%3==0){
    $s_j = $s_i+1;
    echo '</div>';
}elseif ($s_i == $num_rows_speakes && $num_rows_speakes%3!=0) {
    echo '</div>';
}*/


  $s_i++; } ?>                                       
 

<?php
}

if($_POST['action'] == 'callMeetingPagination') {
$per_page_record_m = 9;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_POST["page_m"])) {    
    $page_m  = $_POST["page_m"];    
}    
else {    
  $page_m=1;    
}    

$start_from_m = ($page_m-1) * $per_page_record_m;

$query_m = "SELECT COUNT(*) FROM meeting where  del=0";     
$rs_result_m = mysqli_query($conn, $query_m);     
$row_m = mysqli_fetch_row($rs_result_m);     
$total_records_m = $row_m[0];      

// Number of pages required.   
$total_pages_m = ceil($total_records_m / $per_page_record_m);     
$pagLink_m = "";

?>

<nav aria-label="Page navigation example" style="width: 100%">
  <ul class="pagination pagination-sm" style="float: right;">
    <li class="page-item">
        <?php if($page_m>=2){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getMeetingPagination(<?php echo $page_m-1; ?>);" aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
      <?php }else{?>
        <a class="page-link" href="javascript:void(0)"  aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
  <?php } ?>
    </li>


    <?php for ($i=1; $i<=$total_pages_m; $i++) {   
          if ($i == $page_m) {   
              $pagLink_m .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>".$i." </a></li>";   
          }               
          else  {   
              $pagLink_m .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getMeetingPagination(".$i.");' >  ".$i." </a></li>";     
          }   
        };     
        echo $pagLink_m; ?>

    <li class="page-item">
        <?php if($page_m<$total_pages_m){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getMeetingPagination(<?php echo $page_m+1; ?>);" aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php }else{?>
    <a class="page-link" href="javascript:void(0)"  aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php } ?>
    </li>

  </ul>
</nav>



<?php
$sql_meeting = "SELECT * FROM meeting where  del=0 LIMIT $start_from_m, $per_page_record_m";
$result_meeting = $conn->query($sql_meeting); 

$num_rows_meeting =  mysqli_num_rows($result_meeting);
$m_i = 1;

while ($row_meeting = mysqli_fetch_assoc($result_meeting)) {

/*if($m_i == 1 || $m_i == $m_j){
    echo '<div class="speaker_inner col-lg-4 col-md-4">';
}*/
?>
                                    <div class="speakers_col d-flex col-lg-4 col-md-4">
                                        <div class="speaker_prof_img">
                                            <img src="admin/uploads/meeting/<?php echo $row_meeting["meeting_picture"];?>">
                                        </div>
                                        <div class="speaker_prof_bio">
                                            <h4><?php echo $row_meeting["meeting_name"];?></h4>
                                        <p><?php echo $row_meeting["date"];?></p>
                                            <a target="_blank" href="<?php echo $row_meeting["watch_link"];?>" class="prof_watch_link">Watch</a>
                                        </div>
                                    </div>
<?php
/*if ($m_i%3==0){
    $m_j = $m_i+1;
    echo '</div>';
}elseif ($m_i == $num_rows_meeting && $num_rows_meeting%3!=0) {
    echo '</div>';
}

$m_i++;*/

 } ?>


<?php
}



if($_POST['action'] == 'callResourcePagination') {

$per_page_record_r = 9;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_POST["page_r"])) {    
    $page_r  = $_POST["page_r"];    
}    
else {    
  $page_r=1;    
}    

$start_from_r = ($page_r-1) * $per_page_record_r;
?>
<?php  
        $query_r = "SELECT COUNT(*) FROM resource where  del=0";     
        $rs_result_r = mysqli_query($conn, $query_r);     
        $row_r = mysqli_fetch_row($rs_result_r);     
        $total_records_r = $row_r[0];     
   
        // Number of pages required.   
        $total_pages_r = ceil($total_records_r / $per_page_record_r);     
        $pagLink_r = ""; 

?>

<nav aria-label="Page navigation example" style="width: 100%">
  <ul class="pagination pagination-sm" style="float: right;">
    <li class="page-item">
        <?php if($page_r>=2){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getResourcePagination(<?php echo $page_r-1; ?>);" aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
      <?php }else{?>
        <a class="page-link" href="javascript:void(0)"  aria-label="Previous">
        <span >&lsaquo;&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
  <?php } ?>
    </li>


    <?php for ($i=1; $i<=$total_pages_r; $i++) {   
          if ($i == $page_r) {   
              $pagLink_r .= "<li class='page-item active'><a class = 'page-link' href='javascript:void(0)'>".$i." </a></li>";   
          }               
          else  {   
              $pagLink_r .= "<li class='page-item'><a class = 'page-link' href='javascript:void(0)'  onclick='getResourcePagination(".$i.");' >  ".$i." </a></li>";     
          }   
        };     
        echo $pagLink_r; ?>

    <li class="page-item">
        <?php if($page_r<$total_pages_r){ ?>
      <a class="page-link" href="javascript:void(0)" onclick="getResourcePagination(<?php echo $page_r+1; ?>);" aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php }else{?>
    <a class="page-link" href="javascript:void(0)"  aria-label="Next">
        <span >&rsaquo;&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
  <?php } ?>
    </li>

  </ul>
</nav>




<?php
$sql_resources = "SELECT * FROM resource where del=0 LIMIT $start_from_r, $per_page_record_r";
$result_resources = $conn->query($sql_resources); 

$num_rows_resources =  mysqli_num_rows($result_resources);
$r_i = 1;

while ($row_resources = mysqli_fetch_assoc($result_resources)) {

?>                 
                                   <div class="speakers_col d-flex col-lg-4 col-md-4">
                                        <div class="speaker_prof_img">
                                          <img src="admin/uploads/resource/<?php echo $row_resources["resource_picture"];?>">
                                        </div>
                                        <div class="speaker_prof_bio">
                                            <h4><?php echo $row_resources["resource_name"];?></h4>
                                            <a href="admin/uploads/resource/<?php echo $row_resources["resource_pdf"];?> " target="_blank" class="prof_download_link">Regardez</a>
                                        </div>
                                    </div>
                                    
                                
<?php } 

}

?>