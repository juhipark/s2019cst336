<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: auth/login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Admin </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <!--ag-grid-->
        <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css">
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-balham.css">
        
        <!--sweet alert message-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        
    </head>
    <body>
        
        <div id="content" class="mx-auto text-center" style="width: 80%;" >
        <!-- Image and text -->
        <nav class="navbar navbar-light" style="background-color:#F5CECD;">
            <a class="navbar-brand" href="#">
                <img src="img/csumb_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span id="heading">OtterMart Admin</span>
            </a>
            <a href="add.php"><button type="button" class="btn btn-warning" onClick="addNewProduct()">Add New Product</button></a>
            <button class="btn btn-success" id="logoutBtn">Logout</button>
        </nav>
        
       <div id="myGrid" style="height: 600px; width:100%;" class="ag-theme-balham"></div>
            
        <br>
        <hr>
        <button class="btn btn-info" id="infoBtn">Information</button>
        <button class="btn btn-danger" id="deleteBtn">Delete</button>
        <br />
        <br />
        <br />
        
        </div>
        
        <div class="modal" id="purchaseHistoryModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="history"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    <script src="js/function_index.js" type="text/javascript"></script>
    </body>
    
</html>