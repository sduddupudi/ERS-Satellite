<?php
include 'db_connection.php';
session_start();
include 'admin/helpers/logOut.php';
include 'admin/helpers/checkAuth.php';

if (isset($_POST['logout_btn'])) {
    logOut();
    checkAuth();
}

$site_sql = $pdo->prepare("SELECT `site_logo`, `site_title` FROM lobby");
$site_sql->execute();
$row_site_logo_h = $site_sql->fetch();

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $row_site_logo_h['site_title']; ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="./assets/icons/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/icons/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/icons/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/icons/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="./assets/icons/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="./assets/icons/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/icons/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="./assets/icons/apple-touch-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/icons/apple-touch-icon-180x180.png"/>

    <link rel="icon" type="image/png" href="./assets/icons/favicon-160x160.png" sizes="160x160"/>
    <link rel="icon" type="image/png" href="./assets/icons/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="./assets/icons/favicon-48x48.png" sizes="48x48"/>
    <link rel="icon" type="image/png" href="./assets/icons/favicon-32x32.png" sizes="16x16 32x32"/>

    <link rel="stylesheet" href="./assets/pdfassets/css/styles.css"/>
    <link rel="stylesheet" href="./assets/pdfassets/css/mediaelement.min.css"/>
    <link rel="stylesheet" href="./assets/pdfassets/css/modulobox.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <noscript>
        <style>
            body,
            html {
                opacity: 1;
                visibility: visible;
            }
        </style>
    </noscript>

    <style>
        div.title_box {
            background: #006DDE;
            padding: 17px 12px;
            margin-bottom: 30px;
        }

        a.backBtn {
            text-decoration: none;
            color: #ffffff;
            margin-top: 7px;
        }

        a.backBtn i {
            float: left;
            font-size: 20px;
            margin-top: 7px;
        }

        h4.heading {
            color: #ffffff;
            font-size: 24px;
            text-align: center;
            margin: 0;
        }

        span.title_text {
            color: #212529;
            font-weight: 600;
            position: absolute;
            top: 16px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        button#logout_btn {
            background: #0000;
            color: #000;
            border: none;
            float: right;
            float: right;
            margin-top: -36px;
        }
    </style>
</head>

<body id="top" class="demos">
<!-- <noscript>
    <div>JavaScript is required to see ModuloBox demos!</div>
</noscript> -->

<header style="display: none;">
    <div class="nav-btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<main id="demos">
    <section id="iframe-html" class="feature-section">

        <div class="title_box mb-3">
            <a href="<?php echo $siteURL; ?>" class="backBtn"><i class="fa fa-reply-all"></i></a>

            <h4 class="heading">Resources</h4>
            <form action="" method="POST">
                <button type="submit" name="logout_btn" id="logout_btn" class="">
                    <img class="mob_icon_img d-none" src="assets/images/logout_icon.png">
                    Logout
                </button>
            </form>
        </div>

        <div class="container">
            <div class="gallery" itemscope itemtype="http://schema.org/ImageGallery">
                <?php
                $new = "pdf-format.jpg";
                $sql_resources = "SELECT * FROM resource where del=0";
                $result_resources = $conn->query($sql_resources);
                $num_rows_resources = mysqli_num_rows($result_resources);

                if ($num_rows_resources > 0) {
                    while ($row_resources = mysqli_fetch_assoc($result_resources)) {
                        if ($row_resources["resource_picture"] != "") {
                            $new = $row_resources["resource_picture"];
                        }
                        ?>

                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="admin/uploads/resource/<?php echo $row_resources["resource_pdf"]; ?>"
                               itemprop="contentUrl" data-width="960" data-height="1280" data-type="iframe"
                               data-rel="pdf" rel="nofollow"
                            >
                                <img width="334" height="334" src="admin/uploads/resource/<?php echo $new ?>"
                                     alt="<?php echo $row_resources["resource_name"]; ?>"/>
                            </a>
                            <figcaption itemprop="caption description">
                                <?php echo $row_resources["resource_name"]; ?>
                                <span itemprop="copyrightHolder"> Source: <a rel="nofollow" target="_blank"
                                                                             href="https://docs.google.com/a/bpsk12.org/file/d/0B3xoQi_oa7_hU2J5S1RQbFdqS3c/preview">Google Docs</a> </span>
                            </figcaption>
                            <span class="title_text"><?php echo $row_resources["resource_name"]; ?></span>
                        </figure>
                    <?php }
                } else { ?>
                    <div class="text-center">No data found</div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<div id="scrollTo-top"></div>

<script type="text/javascript" src="./assets/pdfassets/js/mediaelement.min.js"></script>
<script type="text/javascript" src="./assets/pdfassets/js/modulobox.js"></script>
<script type="text/javascript" src="./assets/pdfassets/js/main.min.js"></script>
<script type="text/javascript">

    var spinner = document.querySelectorAll(".spinner span"),
        radioBtn = document.querySelectorAll(".thumbnail-nav"),
        dynamic = document.getElementById("dynamic"),
        mediaEl = document.getElementById("mediaelement"),
        thumblw = document.getElementById("thumb-lw"),
        thumblh = document.getElementById("thumb-lh"),
        thumblg = document.getElementById("thumb-lg"),
        thumbmw = document.getElementById("thumb-mw"),
        thumbmh = document.getElementById("thumb-mh"),
        thumbmg = document.getElementById("thumb-mg"),
        thumbsw = document.getElementById("thumb-sw"),
        thumbsh = document.getElementById("thumb-sh"),
        thumbsg = document.getElementById("thumb-sg"),
        scrollToNav = document.getElementById("scrollToNav"),
        prevNextKey = document.getElementById("prevNextKey"),
        dragToClose = document.getElementById("dragToClose"),
        tapToClose = document.getElementById("tapToClose"),
        scrollToClose = document.getElementById("scrollToClose"),
        pinchToClose = document.getElementById("pinchToClose"),
        escapeToClose = document.getElementById("escapeToClose"),
        doubleTapToZoom = document.getElementById("doubleTapToZoom"),
        scrollToZoom = document.getElementById("scrollToZoom");

    // handle click on add/sub input number
    var spinnerClick = function (event) {
        var span = event.target,
            input = span.className === "add" ? span.previousSibling : span.nextSibling;

        input.value = Math.max(input.min, Math.min(input.max, Number(input.value) + (span.className === "add" ? 1 : -1)));
    };

    // add click events for add/sub buttons
    for (var i = 0; i < spinner.length; ++i) {
        spinner[i].addEventListener("click", spinnerClick);
    }

    // close method subscribe form
    var closeForm = function (event) {
        if (["subscribe-btn", "close-popup"].indexOf(event.target.className) > -1) {
            mobx.close();
        }
    };

    // ass close subscribe form click/touch event
    document.addEventListener("touchend", closeForm, false);
    document.addEventListener("click", closeForm, false);

    // add images in the dynamic example
    var addImages = function () {
        var frag = document.createDocumentFragment();
        var imgs = document.getElementById("gallery-example").getElementsByTagName("figure");
        var from = dynamic.getElementsByTagName("figure").length;

        if (from < 12) {
            for (var i = from - 4; i < from - 2; ++i) {
                var img = imgs[i].cloneNode(true);
                frag.appendChild(img);
            }

            dynamic.appendChild(frag);
            window.buildGrid();
            mobx.getGalleries();
        }
    };

    // delete images in the dynamic example
    var deletedImages = function () {
        var imgs = dynamic.getElementsByTagName("figure");

        if (imgs.length > 4) {
            for (var i = 0; i < 2; ++i) {
                dynamic.removeChild(dynamic.lastChild);
            }
        }

        window.buildGrid();
        mobx.getGalleries();
    };

    // set ModuloBox options
    var options = {
        mediaSelector: ".gallery figure > a, .hidden-gallery div",
        loop: 3,
        history: true,
        controls: ["zoom", "play", "fullScreen", "download", "share", "close"],
        shareButtons: ["facebook", "googleplus", "twitter", "pinterest", "linkedin", "reddit", "stumbleupon", "tumblr", "blogger", "buffer", "digg", "evernote"],
        videoMaxWidth: 1440,
        minZoom: 1,
        zoomTo: 1.8,
        prevNextKey: true,
        mouseWheel: false,
        contextMenu: false,
        doubleTapToZoom: true,
        scrollToZoom: true,
        captionSmallDevice: false,
        escapeToClose: true,
        scrollToClose: false,
        pinchToClose: true,
        dragToClose: true,
        tapToClose: true,
        scrollToNav: false,
        scrollBar: true,
        mediaelement: false,
        thumbnails: true,
        thumbnailsNav: "centered",
        thumbnailSizes: {
            1920: {
                width: 110,
                height: 80,
                gutter: 10,
            },
            1280: {
                width: 90,
                height: 65,
                gutter: 10,
            },
            480: {
                width: 60,
                height: 44,
                gutter: 5,
            },
        },
    };

    // create instance of ModuloBox
    var mobx = new ModuloBox(options);

    // before open event
    // options are dynamically changed before to open a gallery
    mobx.on("beforeOpen.modulobox", function (gallery, index) {
        // reset options (because changed from previously opened gallery)
        for (var prop in this.options) {
            if (this.options.hasOwnProperty(prop) && options.hasOwnProperty(prop)) {
                this.options[prop] = options[prop];
            }
        }

        // show fullscreen button
        if (this.buttons.fullScreen) {
            this.buttons.fullScreen.style.display = "";
        }

        // reset overlay background-color
        this.DOM.overlay.style.backgroundColor =
            // show share button
            this.buttons.share.style.display =
                // show top bar
                this.DOM.topBar.style.display = "";

        // if single images is opened
        if ([1, 2, 3, 4].indexOf(gallery) > -1) {
            this.options.thumbnails = false;
        }

        // if gallery example is opened
        if (gallery === "gallery-example") {
            this.options.thumbnails = false;
        }

        // if thumbnails gallery is opened
        if (gallery === "thumbnails") {
            // dynamically push thumbnails settings
            this.options.thumbnails = true;
            this.options.thumbnailsNav = radioBtn[0].querySelectorAll("input:checked")[0].value;
            this.options.thumbnailSizes = {
                1920: {
                    width: Math.max(0, Math.min(300, thumblw.value)),
                    height: Math.max(0, Math.min(300, thumblh.value)),
                    gutter: Math.max(0, Math.min(100, thumblg.value)),
                },
                1280: {
                    width: Math.max(0, Math.min(300, thumbmw.value)),
                    height: Math.max(0, Math.min(300, thumbmh.value)),
                    gutter: Math.max(0, Math.min(100, thumbmg.value)),
                },
                736: {
                    width: Math.max(0, Math.min(300, thumbsw.value)),
                    height: Math.max(0, Math.min(300, thumbsh.value)),
                    gutter: Math.max(0, Math.min(100, thumbsg.value)),
                },
            };
        }

        // if video gallery is opened
        if (gallery === "video-gallery") {
            var media = this.galleries[gallery][0];

            // remove video player (HTML5 or medialement player)
            media.video = "";
            if (media.dom && media.dom.firstChild) {
                media.dom.removeChild(media.dom.firstChild);
            }

            // set player type
            this.options.mediaelement = mediaEl.checked;
        }

        // if subscribe form is opened
        if (gallery === "newsletter") {
            this.DOM.overlay.style.backgroundColor = "rgba(0,0,0,0.9)";
            this.DOM.topBar.style.display = "none";
            this.options.scrollBar = false;
            this.options.dragToClose = false;
            this.options.tapToClose = false;
            this.options.mouseWheel = false;
        }

        // if HTML/iframe content galleries are opened
        if (["iframe", "game", "newsletter", "pdf", "website"].indexOf(gallery) > -1) {
            if (this.buttons.fullScreen) {
                this.buttons.fullScreen.style.display = "none";
            }

            this.buttons.share.style.display = "none";
        }

        // if dynamic gallery is opened
        if (gallery === "dynamic") {
            this.options.history = false;
        }

        // if dynamic gallery is opened
        if (gallery === "navigation-gallery") {
            this.options.scrollToNav = scrollToNav.checked;
            this.options.prevNextKey = prevNextKey.checked;
            this.options.dragToClose = dragToClose.checked;
            this.options.tapToClose = tapToClose.checked;
            this.options.scrollToClose = scrollToClose.checked;
            this.options.pinchToClose = pinchToClose.checked;
            this.options.escapeToClose = escapeToClose.checked;
            this.options.doubleTapToZoom = doubleTapToZoom.checked;
            this.options.scrollToZoom = scrollToZoom.checked;
        }
    });

    // init ModuloBox instance
    mobx.init();
</script>
</body>
</html>
