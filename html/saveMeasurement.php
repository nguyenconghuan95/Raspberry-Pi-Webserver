<?php
	include ("deviceControl.php");

	$servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    //Create Connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$handler = new deviceControl();

    //Check Connection
    if (mysqli_connect_errno()) {
    	echo("Failed to connect to MySQL: ". mysqli_connect_error());
    }
	echo "Connect sucessfull!!!";

	//Compare to limit parameters
	switch($_GET["zone"]) {
		case 1:
			$handler -> handleLimit($conn, 1);
			break;
		case 2:
			$handler -> handleLimit($conn, 2);
			break;
	}

	
	//Update measurement table
	$sql = "SELECT ZONE FROM measurement";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	while ($count >= 16) {
		$sql = "DELETE FROM measurement WHERE ZONE LIMIT 1";
		mysqli_query($conn, $sql);
		$count--;
	}

	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$sql = "INSERT INTO measurement VALUES(". $_GET["zone"] .", '". date("h:i:sa") ."', ". $_GET["temp"] .", ". $_GET["humid"] .", ". $_GET["lux"] .")";
	mysqli_query($conn, $sql);
	mysqli_close($conn);

?>


