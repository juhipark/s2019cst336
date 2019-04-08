<!DOCTYPE html>
<html>
    <head>
        <title> Winter Vacation Planner! </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script>
            /*global $*/
            $(document).ready(function(){

                $("#create").on("click", function(){
                    var monthValid = false;
                    var locationValid = false;
                    //display error message if month
                    if($("[name=moths]").val() == ""){
                         $("#errorMsgMonth").text("You must select a Month!");
                    }else{
                         $("#errorMsgMonth").text("");
                         monthValid = true;
                    }
                    //display error message if number
                    if($("[name=location]:checked").val()){
                        $("#errorMsgLocation").text("");
                        locationValid = true;
                    }else {
                        $("#errorMsgLocation").text("You must specify the number of locations!");
                    }
                    //if both are valid
                    if(monthValid && locationValid){
                        console.log("Both are valid-->" +($("[name=countries]").val()));
                        $("#resultDivId").append("<hr>");
                        $("#resultDivId").append(`<h2>${$("[name=moths]").val()} Itinerary</h2>`);
                        $("#resultDivId").append(`<h3>Visiting ${$("[name=location]:checked").val()} places in ${$("[name=countries]").val()}</h3>`);
                        $("#resultDivId").append("<table id='calendarTableId'></table>");
     
                        
                        $("#resultDivId").append("<hr>");
                        
                        
                    }
                });
            }); //Document ready Event
            
        </script>
    </head>
    <body class="text-center">
    <h1>Winter Vacation Planner !</h1>
    <br>
    Select Month: <select name="moths">
        <option value="">Select</option>
        <option value="November">November</option>
        <option value="December">December</option>
        <option value="January">January</option>
        <option value="February">February</option>
    </select>
    <br>
    Number of locations: <input type="radio" name="location" value="3"> Three
    <input type="radio" name="location" value="4"> Four
    <input type="radio" name="location" value="5"> Five
    <br>
    Select Country: <select name="countries">
        <option value="USA">USA</option>
        <option value="Mexico">Mexico</option>
        <option value="France">France</option>
    </select>
    <br>
    Visit locations in alphabetical order: 
    <input type="radio" name="order" value="ASC"> A-Z
    <input type="radio" name="order" value="DESC"> Z-A
    
    <br><br>
    <button id="create">Create Itinerary</button>
    
    
    <div id="errorMsgId">
        <p id="errorMsgMonth" style="color:red"></p>
        <p id="errorMsgLocation" style="color:red"></p>
    </div>
    
    <br /><br />
    
    <div id="resultDivId">
    </div>
    
    <div id="rubricId" class="align-text-bottom">
        <table border="1" width="600">
        <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
        <tr style="background-color:#FFC0C0">
          <td>1</td>
          <td>The page includes the form elements as the Program Sample: dropdown menu, radio buttons, etc.</td>
          <td width="20" align="center">5</td>
        </tr>
        <tr style="background-color:#FFC0C0">
          <td>2</td>
          <td>Errors are displayed if month or number of locations are not submitted.</td>
          <td width="20" align="center">5</td>
        </tr> 
        <tr style="background-color:#FFC0C0">
          <td>3</td>
          <td>Header and Subheader are displayed with info submitted. </td>
          <td align="center">5</td>
        </tr>    
        <tr style="background-color:#FFC0C0">
          <td>4</td>
          <td>A table with days and weeks is displayed when submitting the form</td>
          <td align="center">5</td>
        </tr> 
        <tr style="background-color:#FFC0C0">
          <td>5</td>
          <td>The number of days in the table correspond to the month selected</td>
          <td align="center">10</td>
        </tr>
        <tr style="background-color:#FFC0C0">
          <td>6</td>
          <td>Random images are displayed in random days</td>
          <td align="center">5</td>
        </tr>       
        <tr style="background-color:#FFC0C0">
          <td>7</td>
          <td>The number of random images correspond to the number of locations and country submitted</td>
          <td align="center">10</td>
        </tr>  
        <tr style="background-color:#FFC0C0">
          <td>8</td>
          <td>The proper name of the location is displayed below the image 
          		(e.g. "New York", "Las Vegas")</td>
          <td align="center">10</td>
        </tr>  
        <tr style="background-color:#FFC0C0">
          <td>9</td>
          <td>The list of months submitted along with the country and number of locations is displayed below the table (using Sessions)</td>
          <td align="center">15</td>
        </tr>    
        <tr style="background-color:#FFC0C0">
          <td>10</td>
          <td>Random locations should be ordered alphabetically, if user checks corresponding radio button (A-Z or Z-A). </td>
          <td align="center">15</td>
        </tr>        
        <tr style="background-color:#FFC0C0">
          <td>11</td>
          <td>The web page uses Bootstrap and has a nice look. </td>
          <td align="center">5</td>
        </tr>        
        <!--   <tr style="background-color:#99E999">
          <td>12</td>
          <td>This rubric is properly included AND UPDATED (BONUS)</td>
          <td width="20" align="center">2</td>
        </tr>   -->  
         <tr>
          <td></td>
          <td>T O T A L </td>
          <td width="20" align="center"><b></b></td>
        </tr> 
        </tbody></table>
    </div>
    </body>
    
</html>