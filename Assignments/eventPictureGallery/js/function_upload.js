$(document).ready(function() {
    console.log("Upload page is ready");

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


    $("#logoutBtn").on('click', function() {
        console.log("Redirect to logout page");
        window.location = "auth/logout.php";

    }); //Logout Button Click Event
    
    
    // 1. Get rid of file input button
    //$("form button:nth-of-type(1)").click(function() {
    $("#selectButton").click(function() {
        console.log("clicked")
        $("form input[type='file']").trigger("click")
    })

    // 2. Use ajax to submit files
    $("form input[type='file']").change(function(e) {
        $('#filesList').empty();
        $.map(this.files, function(val) {
            $('#filesList')
                .append($('<div>')
                    .html(val.name)
                );
        });
    })

    // 3. Send files with ajax
    $('#uploadButton').click(function(e) {
        setProgress(0);
        console.log($('form')[0]);
        var formData = new FormData($('form')[0]);
        $.ajax({
                url: "api/uploadFile.php",
                type: "POST",
                data : formData,
                // data: {formData, 'caption' : "Pretty Image" },
                processData: false,
                contentType: false,
                mimeType: "multipart/form-data",
                cache: false,
                // This part gives up chunk progress of the file upload
                xhr: function() {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            setProgress(percent);
                        }, true);
                    }
                    return xhr;
                }
            })
            .done(function(data, status, xhr) {
                console.log('upload done');
                //window.location.href = "<?php echo BASE_PATH?>/assets/<?php echo $controller->group ?>";
                console.log(xhr);
                $("#results").html(xhr.responseText)
            })
            .fail(function(xhr) {
                console.log('upload failed');
                console.log(xhr);
            })
            .always(function() {
                //console.log('done processing upload');
            });
    });

    function setProgress(percent) {
        $(".progress-bar").css("width", +percent + "%");
        $(".progress-bar").text(percent + "%");
    }

}); //Document ready Event
