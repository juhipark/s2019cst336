$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);

    var url_id =  urlParams.get('id');
    
    $.ajax({
        type: "GET",
        url: "./api/getMediaType.php",
        data: {
            "media_id" : url_id
        },
        success: function(data, status) {
            
            if(data == "video"){
                $("#content").html('<video controls><source src="api/mediaDisplay.php?id='+url_id+'"></video>');
            }else if(data == "image"){
                $("#content").html('<img src="api/mediaDisplay.php?id='+url_id+'">');
            }else{
                $("#content").html('<img src="img/404.png>');
                console.log("Failed to get larger media view");
            }
            
        },
        error: function(data, status) {

        }
    }); //ajax
});