<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script>
            /*global $*/
            $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    url: "api/getCategories.php",
                    dataType: "json",
                    data:{
                    },
                    success: function(data, status){
                        // console.log(data);
                        data.forEach(function(key){
                            $("[name=category]").append("<option value="+key["catId"]+">"+key["catName"]+"</option>");
                        });
                    }
                }); //
            
                $("#searchForm").on("click",function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getSearchResults.php",
                        dataType: "json",
                        data:{
                            "product" : $("[name=product]").val(),
                            "category" : $("[name=category]").val(),
                            "priceFrom" : $("[name=priceFrom]").val(),
                            "priceTo" : $("[name=priceTo]").val(),
                            "orderBy" : $("[name=orderBy]:checked").val()
                        },
                    success: function(data, status){
                        // console.log(data);
                        $("#results").html("<h3> products Found: </h3>");
                        data.forEach(function(key) {
                            $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>History</a> "); //Create the link to open modal
                            $("#results").append(key['productName'] + " " + key['productDescription'] + "$" + key['price'] + "<br>"); //Show appened results
                    
                        });
                    }
                }); //Search Ajax
                }); //Search Event

                 $(document).on('click', '.historyLink', function() {
                     $("#purchaseHistoryModal").modal("show");
                     $.ajax({
                         type: "GET",
                         url: "api/getPurchaseHistory.php",
                         dataType: "json",
                         data: {
                             "productId" : $(this).attr("id")
                         },
                         success: function(data, status){
                            console.log(data);
                            if(data.length != 0){
                                $("#history").html("");
                                $("#history").append(data[0]['productName'] + "<br />");
                                $("#history").append("<img src='" + data[0]['productImage'] + "' width='200' /> <br />");
                                data.forEach(function(key){
                                    $("#history").append("Purchase Data: " + key['purchaseDate'] + "<br />");
                                    $("#history").append("Unit Price: " + key['unitPrice'] + "<br />");
                                    $("#history").append("Quantity: " + key['quantity'] + "<br />");
                                });
                            } else {
                                $("#history").html("No purchase history for this item.");
                            } 
                        }
                     });
                 }); //Display Bootstrap Modal Event

            }); //Document ready Event
            
        </script>
    </head>
    <body>
        <div class="searchField">
            <h1> OtterMart Product Search </h1>
            
            <form>
                Product: <input type="text" name="product" />
                <br>
                Category: <select name="category">
                    <option value="">Select One</option>
                </select>
                <br>
                Price: From <input type="text" name="priceFrom" size="7"/> To <input type="text" name="priceTo" size="7"/>
                <br>
                Order result by:
                <br>
                <input type="radio" name="orderBy" value="price"> Price<br>
                <input type="radio" name="orderBy" value="name"> Name<br>
    
            </form>
            <br>
            <button id="searchForm">Search</button>
            <br />
        
        </div>
        <br>
        <hr>
        <div id="results"></div>
        
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
        
    </body>
    
</html>