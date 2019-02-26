<!DOCTYPE html>
<html>

<head>
    <title>Intro to PHP</title>
</head>

<body>
    <h1>Number EVEN and ODD</h1>
<?php
    $sum = 0;
    for($i=0; $i<9; $i++){
        $rand = mt_rand(10,1000);
        echo "<br>" . $rand;
        if($rand % 2 == 0){
            echo "  even";
        }else {
            echo "  odd";
        }
        // ($rand % 2 == 0)?echo("even");:echo("odd");
      
        $sum += $rand;
    }
    echo "<br><br>Total sum is: " . $sum . "<br>";
    $sum = $sum / 9;
    echo "Average: " . $sum;
?>

</body>

</html>
