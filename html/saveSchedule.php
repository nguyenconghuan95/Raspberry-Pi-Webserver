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
	    $day = "day".$i;
	    $time = "time".$i;
	    $type = "type".$i;
	    $sql = "INSERT INTO schedule VALUES('".$_POST[$day]."', '".$_POST[$time]."', '".$_POST[$type]."')";
	    if ($conn->query($sql) === TRUE) {
		echo("New record updated sucessfully!!!");
	    }
	    else {
		echo("Error: " . $sql . "<br>". $conn->error);
	    }
	}
    }

    $conn->close();
?>
