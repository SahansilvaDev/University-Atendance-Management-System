<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        .merge_card {
            margin-left: -30px;
        }

        .img_fluid {
            width: 100%;
            height: 100%;
            border: 1px solid black;
            border-radius: 50%;

            cursor: pointer;
        }


        @media only screen and (max-width:600px) {
            .merge_card {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid ">

        <div class="row  ">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body" style="overflow-y: auto; max-height: 200px;">

                        <!-- First alert -->
                        <div class="alert alert-primary py-1 px-1" type="button" role="alert">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="002.webp" class="img-fluid img_fluid">
                                </div>
                                <div class="col-sm-9 py-2 px-0">abcdssk</div>
                            </div>
                        </div>

                        <!-- Second alert -->
                        <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-sm-3">1</div>
                                <div class="col-sm-9">1</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="col-sm-9 merge_card ">
                <div class="card  ">
                    <div class="card-body">
                    <div class="chat_container">
                    <div class="chat-box" id="chat-box">
                        <!-- Chat messages will be displayed here -->
                    </div>
                    <input type="text" id="message-input" placeholder="Type your message...">
                    <button onclick="sendMessage()">Send</button>
                </div>

                    </div>
                </div>
            </div>

        </div>

    </div>