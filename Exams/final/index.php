<?php
    session_start();

    if (!isset($_SESSION['username'])){
      header("Location: auth/login.html");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Juhi's Final Scheduler</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!--Awesome Font-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">


    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

</head>

<body>
    <div id="content" class="mx-auto text-center" style="width: 80%;">
        <nav class="nav navbar navbar-light" style="background-color:#F5CECD;">
            <a class="navbar-brand" href="#">
            <span id="heading">Juhi's Final Scheduler</span>
            <span id="navUserEmail" class="badge badge-info" ></span>
        </a>
        <a class="nav-link" href="rubric.html"><button type="button" class="btn btn-info">Rubric HTML Included Here</button></a>
            <button class="btn btn-success pull-right" id="logoutBtn">Logout</button>
        </nav>

        <!-- Custom Banner -->

        <div class="container">
            <!--Table-->
            
            <!--<form class="form-inline">-->
            <form>

                <label for="invitationLinkInput">Invitation Link </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="invitationLinkInput" placeholder="">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" id="invitationLinkButton"><i class="fas fa-paste"></i></button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Booked By</th>
                        <th scope="col"><a id="addMultipleTime" href="#" data-toggle="modal" data-target="#addTimeSlotModal">Add Multiple Time Slots <i class="far fa-plus-square"></i></a></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <!--Add Time Slot Modal-->
        <div class="modal fade" id="addTimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="addTimeSlotModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTimeSlotModalLabel">Add Time Slots</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body" id="addTimeSlotModalBody">
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="addTimeSlotLabel1">Start Date</label>
                                <input id="startDateInputId" type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="addTimeSlotLabel1">End Date</label>
                                <input id="endDateInputId" type="date" name="bday" min="1000-01-01" max="3000-12-31" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="addTimeSlotLabel1">Start Time (00-23)</label>
                                <input id="startTimeInputId" type="number" value="9" min="0" max="23" step="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="addTimeSlotLabel1">Number of Appointments</label>
                                <input id="numOfAppointmentInputId" type="number" value="1" min="0" max="100" step="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="addTimeSlotLabel1">Length of Appointments (Minutes)</label>
                                <input id="lengthOfAppointmentInputId" type="number" value="30" min="0" max="180" step="10" class="form-control">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="addTimeSlotButton">Add Times</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Detail Modal-->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Schedule Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body" id="detailModalBody">
                        This is the schedule details
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Remove Time Slot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body" id="deleteModalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="deleteButton">Yes, Remove It!</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        var currentUser = "<?php echo $_SESSION['username'];?>";

        console.log("Currently Logged in user: ", currentUser);
        // populate the link
        $("#invitationLinkInput").val("https://s2019cst336-juhipark.c9users.io/Exams/final/invite.html?user=" + currentUser);
        
        $( document ).ready(function() {
            $("#invitationLinkButton").on("click", function() {
                var strToCopy = $("#invitationLinkInput").val();
                copyTextToClipboard(strToCopy);
            });
        });

        //Copy to clipboard
        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            }
            catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }

            document.body.removeChild(textArea);
        }

        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                console.log('Async: Copying to clipboard was successful!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>

    <script src="js/function_index.js" type="text/javascript"></script>
</body>

</html>
