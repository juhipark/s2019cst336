$(document).ready(function() {
    console.log("Ready!", invitationUser);
    $.ajax({
        type: "GET",
        url: "./api/getAllAppointments.php",
        dataType: 'json',
        data: {
            userName: invitationUser
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
                var newRow = `<tr><th scope="row">${tempDate} ${startTime}</th>
                            <td> ${duration} </td>
                            <td> ${booked} </td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#bookModal">Book</button></td>
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
});
