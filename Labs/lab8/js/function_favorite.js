$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "api/getFavorites.php",
        dataType: "json",
        data: {},
        success: function(data, status) {
            console.log(data);

            // create lists of all data 
            for (var idx in data) {

                console.log(data[idx]);

                var rowElem = "<tr><th scope='row'>" + (data[idx]['img_favorites_id']) +
                    "</th><td><span class='alert-link' onclick='click_url_function('" + data[idx]['img_favorites_url'] + "');'>" + data[idx]['img_favorites_url'] + "</a></td>" +
                    "<td>" + data[idx]['img_favorites_keyword'] + "</td></tr>";

                document.getElementById("tableBodyId").innerHTML += rowElem;

            }
        }
    }); //ajax call
    function click_url_function(url) {

        console.log("URL clicked");
    }
}); //on ready
