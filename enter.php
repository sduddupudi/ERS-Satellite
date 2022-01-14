<?php
include 'header.php';

$lobby_sql = $pdo->prepare("SELECT * FROM lobby");
$lobby_sql->execute();
$row_lobby = $lobby_sql->fetch();
?>

<style type="text/css">
    div#enter {
        width: 100%;
    }
</style>

<div id="main-wrapper">
    <div id="enter" class="right_content" style="background-image: url(assets/images/Enter.png);">
        <div class="go-lobby">
            <span><img src="assets/images/icone_Entrer.png"></span>
            <div class="go-lobby-btn">
                <a href="<?php echo $siteURL; ?>lobby.php">
                    <img src="assets/images/icone_Entrer.png">
                    <p>Go to lobby</p>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="icon-help">
    <a href="<?php if (isset($row_lobby['help_link'])) {
        echo $row_lobby['help_link'];
    } ?>" target="_blank"><img src="assets/images/icone_chatbot.png"></a>
</div>

<?php include 'footer.php'; ?>

    
