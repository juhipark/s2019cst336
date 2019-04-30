/*global $*/

$(document).ready(function() {
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
        // ONLY SENDING ONE FILE WITH PUT, SO IF YOU WANT MULTIPLE,
        // EXECUTE MULTIPLE AJAX CALLS, ONE FOR EACH FILE 
        // (separate progress bars for each file, etc, etc)

        // Get the JavaScript version of the input, 
        // then the first element of the files array (only sending one)
        var file = $("form input[type='file']")[0].files[0]

        var reader = new FileReader();

        reader.onload = function(e) {
            var fileBinary = reader.result;
            var fileMimeType = file.type;
            makeAjaxCall(fileBinary, fileMimeType)
        }

        reader.readAsArrayBuffer(file);
    });

    function makeAjaxCall(blob, mimeType) {
        setProgress(0);

        $.ajax({
                url: "./api/uploadFile.php",
                type: "PUT",
                data: blob,
                processData: false,
                contentType: false,
                mimeType: mimeType,
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
    }

    function setProgress(percent) {
        $(".progress-bar").css("width", +percent + "%");
        $(".progress-bar").text(percent + "%");
    }

}); //Document ready Event
