<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: auth/login.html");
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Event Picture Gallery</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    </head>

    <body>
        <div id="content" class="mx-auto" style="width: 80%;">
            <!-- Image and text -->
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#F5CECD;">
                <a class="navbar-brand" href="#">
                <img src="img/emoji_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span id="heading">Event Picture Gallery</span>
                <img src="img/emoji_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span id="navUserEmail" class="badge badge-info" ></span>
            </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Upload New Image <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-success" id="logoutBtn">Logout</button>
            </nav>

            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCaption">Caption</label>
                        <input type="text" class="form-control" id="inputCaption" placeholder="Enter Caption">
                    </div>
                </div>
                <div style="display:none;">
                    <input type="file" name="fileName" />
                </div>
                <div class="form-group col-md-6">
                    <button id="selectButton" type="button" class="btn btn-primary btn-xs">Pick File(s)</button>
                </div>
                <div id="filesList" class="form-group">
                </div>
                <div class="form-group col-md-6">
                    <button id="uploadButton" type="button" class="btn btn-primary btn-xs">Upload File(s)</button>
                </div>
            </form>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
            <div id="results" class="form-group col-md-6">

            </div>
        </div>
        <script src="js/function_upload.js" type="text/javascript"></script>
    </body>

    </html>
