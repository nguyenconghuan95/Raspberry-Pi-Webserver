<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo("Failed to connect to MySQL: ".mysqli_connect_error());
    }

    if(($_POST["timeOn"] == NULL) || ($_POST["timeOff"] == NULL)) {
        header('Location: http://smartgarden.dynu.net:8245');
        exit;
    }
    else {
        if (isset($_POST["addSchedule"])) {
            $sql = "INSERT INTO schedule VALUES('".$_POST["dayOn"]."', '".$_POST["timeOn"]."', '".$_POST["dayOff"]."', '".$_POST["timeOff"]."', '".$_POST["device"]."')";
            if (mysqli_query($conn, $sql)) {
                header('Location: http://smartgarden.dynu.net:8245');
                exit;
            }
            else {
                echo("<script type='text/javascript> alert('Something wrong, can't add schedule!!!'); </script>");
            }
        }
    
        if (isset($_POST["deleteSchedule"])) {
            $sql = "DELETE FROM schedule WHERE DAY_ON='".$_POST["dayOn"]."' AND TIME_ON='".$_POST["timeOn"]."' AND DAY_OFF='".$_POST["dayOff"]."' AND TIME_OFF='".$_POST["timeOff"]."' AND DEVICE='".$_POST["device"]."'";
            if (mysqli_query($conn, $sql)) {
                header('Location: http://smartgarden.dynu.net:8245');
                exit;
            }
            else {
                echo("<script type='text/javascript> alert('Something wrong, can't delete schedule!!!'); </script>");
            }
        }
    
        if (isset($_POST["deleteScheduleAll"])) {
            $sql = "TRUNCATE TABLE schedule";
            if (mysqli_query($conn, $sql)) {
                header('Location: http://smartgarden.dynu.net:8245');
                exit;
            }
            else {
                echo("<script type='text/javascript> alert('Something wrong, can't delete schedule!!!'); </script>");
            }
        }
    }
    
?>
