function keyword_searched(e) {
    var keyword_str = document.getElementById("keyword_search_id").value;
    console.log("Keyword searched: ", keyword_str);
    $.ajax({
        type: "GET",
        url: "api/getImages.php",
        dataType: "json",
        data: {
            "searchKey": $("#keyword_search_id").val()
        },
        success: function(data, status) {
            data = data['hits'];
            console.log(data);

            var cardHTML = "";
            for (var idx in data) {
                console.log(idx);
                //create card --> <img id="item"+idx name="unclicked"
                if (idx == 0 || idx == 3 || idx==6) {
                    cardHTML += '<div class="row">';
                }
                cardHTML += ('<div class="col">' +
                    '<div class="card border-dark mb-3" style="max-width: 15rem;">' +
                    '<div class="card-header">Favorite</div>' +
                    '<img id="item' + idx + '" onclick="click_icon_function('+idx+')" name="unclicked" src="img/favorite.png" style="width: 40px;" />' +
                    '<div class="card-body">' +
                    '<img src="' + data[idx]['largeImageURL'] + '"id="img' + idx + '" style="width: 150px; height: 140px">' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                if (idx == 2 || idx == 5 || idx == 8) {
                    cardHTML += '</div>'
                }
            } //for loop

            $('#displayDiv').html(cardHTML);

        }
    }); //ajax call

}

function click_icon_function(idNum) {
    var itemID = "item"+idNum;
    var imgID = "#img"+idNum;
    if (document.getElementById(itemID).getAttribute("name") == "unclicked") {
        console.log(itemID);
        document.getElementById(itemID).setAttribute("src", "img/favorite-on.png");
        document.getElementById(itemID).setAttribute("name", "clicked");
        //update url link to db
        console.log("^@^");
        console.log($(imgID).attr('src'));
        console.log($("#keyword_search_id").val());
        $.ajax({
            type: "GET",
            url: "api/addImage.php",
            dataType: "json",
            data: {
                "imgUrl": $(imgID).attr('src'),
                "imgKeyword": $("#keyword_search_id").val()
            },
            success: function(data, status) {
                console.log("Added to favorites");
                console.log(data);

            }
        });// ajax
    }
    else {
        document.getElementById(itemID).setAttribute("src", "img/favorite.png");
        document.getElementById(itemID).setAttribute("name", "unclicked");
        //delte off of db
        $.ajax({
            type: "GET",
            url: "api/deleteImages.php",
            dataType: "json",
            data: {
                "imgUrl": $(imgID).attr('src'),
            },
            success: function(data, status) {
                console.log("Deleted from favorites");
                console.log(data);

            }
        });

    }

}
