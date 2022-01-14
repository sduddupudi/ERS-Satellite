<?php include 'header.php'; ?>

<div class="fullscreen_video">
	<video width="100%" height="500" controls autoplay controlsList="nodownload">
	  <source src="<?php echo $_GET['vid'] ?>" type="video/mp4">
	</video>
</div>

<div class="back-icon-webinar back_icon_video_plenary">
    <span><img src="assets/images/icone_Retour.png"></span>

    <div class="back-icon-webinar-btn">
        <a href="<?php echo $siteURL; ?>lobby.php">
            <img src="assets/images/icone_Retour.png">
            <p>Go Back</p>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>