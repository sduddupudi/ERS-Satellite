<?php include 'header.php'; ?>

    <div class="speakers_container">
        <div class="title_box mb-3">
            <a href="<?php echo $siteURL; ?>" class="text-decoration-none"><i class="fa fa-reply-all text-white mt-1"
                                                                              style="float: left; font-size: 20px;"></i></a>
            <h4 class="text-white text-center mb-0">Resources</h4>
        </div>
        <div class="row mx-0">
            <?php
            $new = "pdf-format.jpg";
            $del = 0;
            $sql_resources = $pdo->prepare("SELECT * FROM resource WHERE `del` = ?");
            $sql_resources->execute([
                $del
            ]);
            $count = $sql_resources->rowCount();

            if ($count > 0) {
                while ($row_resources = $sql_resources->fetch(PDO::FETCH_ASSOC)) {
                    if ($row_resources["resource_picture"] != "") {
                        $new = $row_resources["resource_picture"];
                    }
                    ?>

                    <div class="col-lg-3 col-md-6">
                        <div class="media mb-3">
                            <div class="img_box">
                                <img src="admin/uploads/resource/<?php echo $new ?>"
                                     alt="<?php echo $row_resources["resource_name"]; ?>"
                                     class="rounded-circle border"/>
                            </div>
                            <div class="media-body">
                                <h6><?php echo $row_resources["resource_name"]; ?></h6>
                                <?php $resource_picture = $row_resources["resource_picture"];
                                $resource_pdf = $row_resources["resource_pdf"]; ?>
                                <a href="admin/uploads/resource/<?php echo $row_resources["resource_pdf"]; ?>" download><span
                                            class="small"> Download Now</span> </a>
                            </div>
                        </div>
                    </div>

                <?php }
            } else { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="media mb-3">
                        <div class="media-body">
                            <h6>No resource Found</h6>
                            <span class="small"></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php include 'footer.php'; ?>