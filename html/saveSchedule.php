<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    //Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check Connection
    if ($conn->connect_error) {
 	die("Connection failed: ".$conn->connect_error);
    }
    echo("Connect Successful!!!<br>");

    //Add time to MySQL
    if (isset($_POST["submitAdd"])) {
	for ($i = 1; $i <= $_GET["count"]; $i++) {
	    $dayOn = "dayOn".$i;
	    $timeOn = "timeOn".$i;
	    $dayOff = "dayOff".$i;
	    $timeOff = "timeOff".$i;
	    $device = "device".$i;
	    $sql = "INSERT INTO schedule VALUES('".$_POST[$dayOn]."', '".$_POST[$timeOn]."', '".$_POST[$dayOff]."', '".$_POST[$timeOff]."', '".$_POST[$device]."')";
	    if ($conn->query($sql) === TRUE) {
		echo($i.". New record updated sucessfully!!!<br>");
	    }
	    else {
		echo($i.". Error: " . $sql . "<br>". $conn->error);
	    }
	}
    }

    //Delete time in MySQL
    if (isset($_POST["submitDelete"])) {
	for ($i = 1; $i <= $_GET["count"]; $i++) {
	    $dayOn = "dayOn".$i;
            $timeOn = "timeOn".$i;
	    $dayOff = "dayOff".$i;
            $timeOff = "timeOff".$i;
            $device = "device".$i;
	    $sql = "DELETE FROM schedule WHERE DAY_ON='".$_POST[$dayOn]."' AND TIME_ON='".$_POST[$timeOn]."' AND DAY_OFF='".$_POST[$dayOff]."' AND TIME_OFF='".$_POST[$timeOff]."' AND DEVICE='".$_POST[$device]."'";
	    if ($conn->query($sql) === TRUE) {
                echo($i.". New record updated sucessfully!!!<br>");
            }
            else {
                echo($i.". Wrong information!!!");
            }
	}
    }

    $conn->close();
?>
