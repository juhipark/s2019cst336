/*global $*/

function formSubmit() {
    var catVal = $("#categoryInput").find("option:selected").val();
    var values = $("input[type=text]").map(function() {
        return this.value;
    }).get();
    console.log(typeof values[0]);



    //call ajax with form data
    $.ajax({
        type: "GET",
        url: "api/addProducts.php",
        dataType: "",
        data: {
            "pName": values[0],
            "pDescription": values[1],
            "pImg": values[2],
            "pPrice": values[3],
            "pCategory": catVal
        },
        success: function(data, status) {
            console.log(data);
            //redirect back to index.php
            console.log("Redirect to logout page");
            window.location = "index.php";


        }
    }); //ajax call

} //function form submit
$("#logoutBtn").on('click', function() {
    console.log("Redirect to logout page");
    window.location = "auth/logout.php";

}); //Logout Button Click Event
