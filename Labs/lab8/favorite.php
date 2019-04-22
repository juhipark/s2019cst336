<?php


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab8</title>

        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="bootstrap.min.css">
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <!--Contributes to ag-Grid Table-->
        <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css">
        <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-balham.css">
        
        <!--Custom CSS Style-->
        <style type="text/css">
    
        </style>
    </head>
    
    <body>
        <div id="content" class="mx-auto text-center" style="width: 50%; ">
            <h1>View Favorite Page</h1>
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Menu</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">View Favroites <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                </div>
            </nav>
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">URL Link</th>
                        <th scope="col">Keyword</th>
                    </tr>
                </thead>
                <tbody id="tableBodyId">
                </tbody>
            </table>
            
        </div> 

        <script>
            
            $(document).ready(function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getFavorites.php",
                        dataType: "json",
                        data:{
                        },
                        success: function(data, status){
                            console.log(data);
                            
                            // create lists of all data 
                            for (var idx in data) {
                            
                                console.log(data[idx]);
                                
                                // var 
                                
                                var rowElem = "<tr><th scope='row'>"+(data[idx]['img_favorites_id']) +
                                            "</th><td>"+data[idx]['img_favorites_url']+"</td>"+
                                            "<td>"+data[idx]['img_favorites_keyword']+"</td></tr>";
                                            
                                document.getElementById("tableBodyId").innerHTML += rowElem;
                                
                                
                            }
                            
                            
                        }
                    }); //ajax call
            });//on ready
            
        </script>
    
    </body>
</html>