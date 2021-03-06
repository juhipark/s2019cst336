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
    
    
    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

</head>

<body>


    <div id="content" class="mx-auto text-center" style="width: 80%;">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Upload New Image</a>
                    </li>
                </ul>
            </div>
            <button class="btn btn-success" id="logoutBtn">Logout</button>
        </nav>

        <div class="container">
            <h1>Carousel view</h1>
            <!--Carousel View-->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol id="myCarouselIndic" class="carousel-indicators">
                    
                </ol>
                <div  id="myCarouselInner" class="carousel-inner">
                 
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            </br>
            <h1>Click each thumbnails to get larger image</h1>
            </br>
            
            <!--List View-->
            <div class="container" id="listViewDiv">
            
            </div>
            

        </div>
        <script src="js/function_index.js" type="text/javascript"></script>
</body>

</html>