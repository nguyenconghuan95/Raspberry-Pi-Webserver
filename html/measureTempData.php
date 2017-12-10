<?php
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo("Failed to connect to MySQL: ". mysqli_connect_error());
    }

    $sql = "SELECT ZONE, TIME, TEMPERATURE FROM measurement";
    $result = mysqli_query($conn, $sql);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    mysqli_close($conn);

    print json_encode($data);
?>

