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

        $sql1 = "UPDATE dateSetup SET DAY='".$_POST["day"]."' WHERE ID=1";
	    $sql2 = "UPDATE dateSetup SET DATE='".$_POST["date"]."' WHERE ID=1";
	    $sql3 = "UPDATE dateSetup SET TIME='".$_POST["time"]."' WHERE ID=1";
	    $sql4 = "UPDATE dateSetup SET CHANGED=".$_GET["change"]." WHERE ID=1";
            if ($conn->query($sql1) === TRUE) {
                echo("New record updated sucessfully!!!");
            }
            else {
                echo("Error: " . $sql . "<br>". $conn->error);
            }
	    if ($conn->query($sql2) === TRUE) {
                echo("New record updated sucessfully!!!");
            }
            else {
                echo("Error: " . $sql . "<br>". $conn->error);
            }
	    if ($conn->query($sql3) === TRUE) {
                echo("New record updated sucessfully!!!");
            }
            else {
                echo("Error: " . $sql . "<br>". $conn->error);
            }
	    if ($conn->query($sql4) === TRUE) {
                echo("New record updated sucessfully!!!");
            }
            else {
                echo("Error: " . $sql . "<br>". $conn->error);
            }

    $conn->close();
?>
