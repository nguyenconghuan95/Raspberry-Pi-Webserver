<?php
	$servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

	if (mysqli_connect_errno()) {
        echo("Failed to connect to MySQL: ". mysqli_connect_error());
    }

    if (isset($_GET["first"])) {
        $sql = "SELECT LED, STATUS FROM led";
        $result = mysqli_query($conn, $sql);
        
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
    
        $sql = "UPDATE led SET CHANGED=0 WHERE CHANGED=1";
        mysqli_query($conn, $sql);
    
        mysqli_close($conn);
    
        print json_encode($data);
    }
    else {
        $sql = "SELECT LED, STATUS FROM led WHERE CHANGED=1";
        $result = mysqli_query($conn, $sql);
        
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
    
        $sql = "UPDATE led SET CHANGED=0 WHERE CHANGED=1";
        mysqli_query($conn, $sql);
    
        mysqli_close($conn);
    
        print json_encode($data);
    }

    
?>
