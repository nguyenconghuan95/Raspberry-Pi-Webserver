<?php
	require_once "deviceControl.php";
	require_once "config.inc.php";
	require_once "DB_mysql.php";

	$db = new DB_mysql();
	$handler = new deviceControl();

    $conn = $db -> db_connect();
	
    //Check Connection
    if (mysqli_connect_errno()) {
    	echo("Failed to connect to MySQL: ". mysqli_connect_error());
    }
	echo "Connect sucessfull!!!";

	$sql = "SELECT ManualControlFlag FROM $tbl_limit WHERE Zone=".$_GET["zone"];
	$result = $db -> db_select_fetch_array($conn, $sql);
	$manualControlFlag = $result[0];

	if ($manualControlFlag == 0) {
		//Compare to limit parameters
		switch($_GET["zone"]) {
			case 1:
				$handler -> handleLimit($conn, 1);
				break;
			case 2:
				$handler -> handleLimit($conn, 2);
				break;
		}
	}
	
	//Update measurement table
	$sql = "SELECT ZONE FROM $tbl_measurement";
	$result = $db -> db_query($conn, $sql);
	$count = mysqli_num_rows($result);

	while ($count >= 16) {
		$sql = "DELETE FROM $tbl_measurement WHERE ZONE LIMIT 1";
		$db -> db_query($conn, $sql);
		$count--;
	}

	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$sql = "INSERT INTO $tbl_measurement VALUES(". $_GET["zone"] .", '". date("h:i:sa") ."', ". $_GET["temp"] .", ". $_GET["humid"] .", ". $_GET["lux"] .")";
	$db -> db_query($conn, $sql);
	$db -> db_close($conn);

?>


