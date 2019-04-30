function click_url_function(idNum) {
    var url = $("#"+idNum).text();
    
    console.log(idNum);
    console.log("URL clicked");
    console.log(url);
    Swal.fire({
        title: 'Sweet!',
        text: 'Modal with a custom image.',
        imageUrl: url,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        animation: false
    });
}
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
                    "</th><td><span id=" + (data[idx]['img_favorites_id'])+ " class='alert-link' onclick='click_url_function("+data[idx]['img_favorites_id']+")'>" + data[idx]['img_favorites_url'] + "</span></td>" +
                    "<td><span class='badge badge-pill badge-primary'>" + data[idx]['img_favorites_keyword'] + "</span></td></tr>";

                document.getElementById("tableBodyId").innerHTML += rowElem;
            }
        }
    }); //ajax call



}); //on ready
