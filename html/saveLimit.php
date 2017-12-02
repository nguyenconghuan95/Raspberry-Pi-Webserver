<?php
	$servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "UPDATE limitIndex SET " .$_POST['limPara']. "=" .$_POST['limValue']. " WHERE ZONE=" .$_POST['limZone'];
    mysqli_query($conn, $sql);
?>
