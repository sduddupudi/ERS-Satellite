<?php include 'header.php'; ?>

    <style>
        body {
            border-top: 10px solid #bda869 !important;
        }

        .logonew {
            position: absolute;
            display: flex;
            bottom: 7%;
            cursor: pointer;
            width: 10%;
            left: 2%;
        }

        img#logolive {
            width: 97%;
            height: auto;
        }

        html {
            overflow: hidden
        }

        .logonew {
            position: absolute;
            display: flex;
            top: 3%;
            cursor: pointer;

            left: 1%;
            height: auto;
        }

        .back-icon-webinar.back_icon_video_plenary {
            position: absolute !important;
            top: -1%;
            right: 15px;
            z-index: 1;
            display: none;
        }

        .help-text {
            color: #bda869;
            font-size: 15px;
            position: absolute;
            top: 22px;
            left: 67.5%;
            z-index: 1;
        }

        @media screen and (min-width: 1120px) {
            div.video_frame {
                width: 75%;
                height: 100%;
                position: fixed;
                top: 0;
                left: 0;
                background: url(https://staging.alconnothingevent.com/images/stream.jpg) no-repeat center center;
                border-top: 10px solid #bda869 !important;
                border-right: 1px solid #bda869 !important;
                background-size: cover;
            }

            div.video_frame iframe {
                width: 98%;
                height: 80%;
                position: absolute;
                top: 10%;
                bottom: 10%;
                left: 10px;
                right: 10px;
            }

            div.iframe_side_content {
                width: 25%;
                min-height: 560px;
                float: right;
                overflow-y: hidden;
            }

            div.iframe_side_content iframe {
                width: 100%;
            }
        }

        @media screen and (max-width: 1119px) {
            div.video_frame {
                width: calc(100% - 280px);
                height: 100%;
                position: fixed;
                top: 0;
                left: 0;
                background: url(https://staging.alconnothingevent.com/images/stream.jpg) no-repeat center center;
                border-top: 10px solid #bda869 !important;
                border-right: 1px solid #bda869 !important;
                background-size: cover;
            }

            div.video_frame iframe {
                width: 98%;
                height: 80%;
                position: absolute;
                top: 10%;
                bottom: 10%;
                left: 5px;
                right: 5px;
            }

            div.iframe_side_content {
                width: 280px;
                min-height: 560px;
                float: right;
                overflow-y: hidden;
            }

            div.iframe_side_content iframe {
                width: 100%;
            }

            .help-text {
                position: absolute;
                top: 22px;
                left: calc(100% - 378px);
            }
        }

        @media screen and (max-width: 600px) {
            div.video_frame {
                width: 100%;
                height: 30%;
            }

            div.video_frame iframe {
                width: calc(100% + 1px);
                height: 100%;
                position: absolute;
                top: -10px;
                bottom: 0;
                left: 0;
                right: 0;
            }

            div.iframe_side_content {
                position: absolute;
                top: 28%;
                width: 100%;
                height: 72%;
                min-height: 0;
                float: none;
                overflow-y: scroll;
            }

            div.iframe_side_content iframe {
                width: 100%;
                height: 100%;
            }

            .back-icon-webinar.back_icon_video_plenary {
                position: absolute !important;
                top: -1%;
                right: 5px;
                z-index: 1;
                display: block;
            }

            .logonew {
                display: none;
            }

            .help-text {
                position: absolute;
                top: 1%;
                left: 15px;
            }
        }
    </style>

    <div class="fullscreen_video">
        <div class="back-icon-webinar back_icon_video_plenary">
            <span><img src="assets/images/Icone_exit.png"></span>
            <div class="back-icon-webinar-btn">
                <a href="https://staging.alconnothingevent.com/lobby.php">
                    <img src="assets/images/Icone_exit.png">
                    <p>Back</p>
                </a>
            </div>
        </div>

        <div id="myBtn" class="video_frame">
            <div class="embed-container">
                <iframe src="https://vimeo.com/event/932847/embed" frameborder="0" allow="autoplay"
                        allowfullscreen></iframe>
            </div>
            <div id="Alcon_Logo" class="logonew">
                <div>
                    <img id="logolive" src="assets/images/Alcon_logo.png">
                </div>
            </div>
        </div>

        <div class="iframe_side_content">
            <iframe src="https://pigeonhole.at/NOTHING" frameBorder="0" class=""></iframe>
        </div>

        <h4 class="text-center help-text d-sm-flex justify-content-sm-center align-items-sm-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                <g id="Group_2801" data-name="Group 2801" transform="translate(-645 -3316)">
                    <g id="Group_2800" data-name="Group 2800">
                        <g id="Ellipse_56" data-name="Ellipse 56" transform="translate(645 3316)" fill="none"
                           stroke="#bda869" stroke-width="2">
                            <circle cx="20" cy="20" r="20" stroke="none"/>
                            <circle cx="20" cy="20" r="19" fill="none"/>
                        </g>
                        <path id="ellipsis-v-solid"
                              d="M26.553,14.24A2.553,2.553,0,1,1,24,16.793,2.551,2.551,0,0,1,26.553,14.24ZM24,10.553A2.553,2.553,0,1,0,26.553,8,2.551,2.551,0,0,0,24,10.553Zm0,12.481a2.553,2.553,0,1,0,2.553-2.553A2.551,2.551,0,0,0,24,23.033Z"
                              transform="translate(681.812 3309.466) rotate(90)" fill="#bda869"/>
                    </g>
                </g>
            </svg>
            <span class="ml-sm-2 d-sm-block d-none">HELP</span>
        </h4>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<?php include 'footer.php'; ?>