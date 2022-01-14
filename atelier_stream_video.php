<?php
include 'header.php';

$lobby_sql = "SELECT * FROM lobby  ";
$get_lobby = $conn->query($lobby_sql);
$row_lobby = $get_lobby->fetch_assoc();

$setting_sql = "SELECT * FROM settings  ";
$get_setting = $conn->query($setting_sql);
$row_setting = $get_setting->fetch_assoc();
?>

<div class="fullscreen_video">
	<div style="position:absolute;top:0;left:0;width:<?php if($row_setting['pleniere_de_iframe_full_width'] == 'yes'){echo '100%'; }else{echo '80%'; } ?>;height:100%;">
		<iframe src="<?php if(isset($row_lobby['atelier_stream_video'])){echo $row_lobby['atelier_stream_video']; } ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen 
				style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
		
		<div class="back-icon-webinar back_icon_video_plenary">
			<span><img src="assets/images/icone_Retour.png"></span>

			<div class="back-icon-webinar-btn">
				<a href="<?php echo $siteURL; ?>atelier.php">
					<img src="assets/images/icone_Retour.png">
					<p>Go Back</p>
				</a>
			</div>
		</div>
	</div>
	<div style="float:right; width:20%; height:100%; overflow-y:scroll;" class="pubble-app PQAQ_section" data-app-id="78355" data-app-identifier="78355"></div>
</div>

<script type="text/javascript" src="https://cdn.pubble.io/javascript/loader.js" defer></script>

<?php
include 'footer.php';
?>
