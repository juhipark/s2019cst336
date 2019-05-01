/*global $*/

$(document).ready(function() {
    console.log("Index page is ready");

    $.ajax({
        type: "GET",
        url: "./api/getEmail.php",
        data: {},
        success: function(data, status) {
            console.log(data);

            $("#navUserEmail").html(data);
        },
        error: function(data, status) {
            console.log("Error:Can't get user email");
        }
    }); //ajax call for user email

    $.ajax({
        type: "GET",
        url: "./api/getFile.php",
        dataType: "json",
        data: {},
        success: function(data, status) {
            // console.log(data);
            var cardHTML = "";


            //carousel view
            for (var idx in data) {
                console.log(data[idx][0]);

                //carousel view
                var carouselIndic = "";
                var carouselInner = "";

                if (idx == 0) {
                    //Active Element
                    if (data[idx][0] == "video") {
                        //video
                        carouselIndic = '<li data-target="#video-carousel-example" data-slide-to="0" class="active"></li>';
                    }
                    else {
                        //image
                        carouselIndic = '<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>';
                    }
                    carouselInner = '<div class="carousel-item active">' +
                        data[idx][1] + '</div>';
                }
                else {
                    //Non Active Element
                    if (data[idx][0] == "video") {
                        //video
                        carouselIndic = '<li data-target="#video-carousel-example" data-slide-to="' + idx + '"></li>';
                    }
                    else {
                        //image
                        carouselIndic = '<li data-target="#carousel-example-2" data-slide-to="' + idx + '"></li>';
                    }
                    carouselInner = '<div class="carousel-item">' +
                        data[idx][1] + '</div>';
                }

                $("#myCarouselIndic").append(carouselIndic);
                $("#myCarouselInner").append(carouselInner);

                //list view

                if (idx == 0 || idx == 3 || idx == 6) {
                    cardHTML += '<div class="row">';
                }
                cardHTML += ('<div class="col">' +
                    '<div class="card border-dark mb-3" style="max-width: 15rem;">' +
                    '<div class="card-header">List View</div>' +
                    '<div class="card-body">' +
                    data[idx][1] +
                    '</div>' +
                    '</div>' +
                    '</div>');
                if (idx == 2 || idx == 5 || idx == 8) {
                    cardHTML += '</div>'
                }

            } // for loop
            $('#listViewDiv').html(cardHTML);


        },
        error: function(data, status) {
            console.log("Error:Can't get files data");
        }
    }); //ajax call for user email

    $("#logoutBtn").on('click', function() {
        console.log("Redirect to logout page");
        window.location = "auth/logout.php";

    }); //Logout Button Click Event

}); //Document ready Event
