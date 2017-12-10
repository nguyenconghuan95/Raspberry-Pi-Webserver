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
	echo $_GET["device"];
    echo("Connect Successful!!!<br>");
	$sql = "UPDATE led SET STATUS='". $_POST["action"] ."' WHERE LED='". $_POST["device"] ."'";
	$sql1 = "UPDATE led SET CHANGED=1 WHERE LED='". $_POST["device"] . "'";
	$conn->query($sql);
	$conn->query($sql1);
    $conn->close();
?>
