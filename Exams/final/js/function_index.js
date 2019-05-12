/**** Global js variable : currentUser***/
// var currentUser = '<?php echo $session_value;?>'; 
var userId;

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "./api/getAllAppointments.php",
        dataType: 'json',
        data: {
            'userName': currentUser
        },
        success: function(data, status) {
            console.log(data);
            var tempDate;
            var startTime;
            var duration;
            var booked = "Not Booked";
            var id;

            for (var idx in data) {
                console.log(data[idx]);
                id = data[idx]['scheduler_appointment_id'];
                tempDate = data[idx]['scheduler_appointment_start_date'];
                startTime = data[idx]['scheduler_appointment_start_time'];
                duration = data[idx]['scheduler_appointment_duration'];
                if (data[idx]['scheduler_appointment_reserved'] != "0") {
                    booked = "Some Person";
                }
                var newRow = `<tr><th scope="row">${tempDate}</th>
                            <td> ${startTime} </td>
                            <td> ${duration} </td>
                            <td> ${booked} </td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#detailModal" onclick="detailModalDisplay(${data[idx]['scheduler_appointment_id']})">Details</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteModalDisplay(${data[idx]['scheduler_appointment_id']})">Delete</button></td>
                            </tr>`;

                $("tbody").append(newRow);
            }
        },
        error: function(data, status) {
            console.log("Error:Can't get all appointments");
        }
    }); //ajax call for all appointments


    $("#logoutBtn").on('click', function() {
        console.log("Redirect to logout page");
        window.location = "auth/logout.php";

    }); //Logout Button Click Event

}); // on ready

$('#addMultipleTime').on("click", function() {
    console.log("Add multiple-times clicked");
    $.ajax({
        type: "GET",
        url: "./api/getUserId.php",
        dataType: 'json',
        data: {
            'userName': currentUser
        },
        success: function(data, status) {
            userId = data[0]['scheduler_user_id'];
        },
        error: function(data, status) {
            console.log("Error:Can't get a user's id");
        }
    }); //ajax call for getting user's id


    $("#addTimeSlotButton").on("click", function() {
        // Grab information about adding time slots

        var startDate = $("#startDateInputId").val();
        var endDate = $("#endDateInputId").val();
        var startTime = $("#startTimeInputId").val();
        var numAppt = $("#numOfAppointmentInputId").val();

        var duration = $("#lengthOfAppointmentInputId").val();
        var date = new Date(null);
        date.setMinutes(duration);
        var timeString = date.toISOString().substr(11, 8);
        var slotsInfo = new Array();

        var newStartDateTime = new Date(Date.parse(startDate + " " + startTime + ":00:00"));
        var newEndDateTime = new Date(newStartDateTime.getTime() + duration * 60000);

        for (var eachAppt = 0; eachAppt < numAppt; eachAppt++) {
            //each slot includes 
            //('2019-05-18 19:00', '2019-05-19 19:30', '00:30', FALSE, 2);

            slotsInfo[eachAppt] = new Array(getFormattedDate(newStartDateTime),
                getFormattedDate(newEndDateTime), timeString, 0, userId);

            //calculate next day
            newStartDateTime.setTime(newStartDateTime.getTime() + 86400000);
            newEndDateTime.setTime(newStartDateTime.getTime() + duration * 60000);

        }

        console.log(JSON.stringify({ 'slotsInfo': slotsInfo }));
        $.ajax({
            type: "GET",
            url: "./api/addAppointment.php",
            data: {
                'slotsInfo': slotsInfo
            },
            success: function(data, status) {
                console.log("Add the appointments successfully");
                location.reload();
            },
            error: function(data, status) {
                console.log("Error:Can't delete the appointment");
            }

        }); // ajax


    }); // onclick

}); // onclick

function detailModalDisplay(appointmentID) {
    console.log("Detail button clicked");
    $.ajax({
        type: "GET",
        url: "./api/getDetail.php",
        dataType: 'json',
        data: {
            'id': appointmentID
        },
        success: function(data, status) {
            var isResered = "Not Yet Reserved";

            if (data[0]['scheduler_appointment_reserved'] != "0") {
                isResered = "Already Been Reserved";
            }

            var detailInfo = `<div>
                <strong>Time Start: </strong>${data[0]['scheduler_appointment_start_date']}<br>
                <strong>Time End: </strong>${data[0]['scheduler_appointment_end_time_date']}<br>
                <strong>Time Duration: </strong>${data[0]['scheduler_appointment_duration']} (hh:mm)<hr/>
                <strong>Appointment Username: </strong>${data[0]['scheduler_user_name']}<br>
                <strong>Reserved: </strong>${isResered}<br>
                </div>`;

            $("#detailModalBody").html(detailInfo);

        },
        error: function(data, status) {
            console.log("Error:Can't get all appointments");
        }

    });
}

function deleteModalDisplay(appointmentID) {
    console.log("Delete button clicked");
    $.ajax({
        type: "GET",
        url: "./api/getDetail.php",
        dataType: 'json',
        data: {
            'id': appointmentID
        },
        success: function(data, status) {

            var deleteInfo = `<div>
                <strong>Time Start: </strong>${data[0]['scheduler_appointment_start_date']}<br>
                <strong>Time End: </strong>${data[0]['scheduler_appointment_end_time_date']}<br><br>
                Are you sure you want to remove the time slot? This cannot be undone
                </div>`;

            $("#deleteModalBody").html(deleteInfo);

        },
        error: function(data, status) {
            console.log("Error:Can't get all appointments");
        }

    });

    $("#deleteModalBody").html();

    $("#deleteButton").on("click", function() {
        $.ajax({
            type: "GET",
            url: "./api/deleteAppointment.php",
            data: {
                'id': appointmentID
            },
            success: function(data, status) {
                console.log("Delete the appointment successfully");
                location.reload();
            },
            error: function(data, status) {
                console.log("Error:Can't delete the appointment");
            }

        }); // ajax

    }); // on click
}

function getFormattedDate(date) {
    // '2019-05-18 19:00'
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;

    var timeString = date.toString().substr(16, 8);

    return year + '-' + month + '-' + day + ' ' + timeString;

}
