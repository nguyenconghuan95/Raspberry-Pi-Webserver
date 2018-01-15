 <?php
    require_once "DB_mysql.php";
    require_once "config.inc.php";

	$db = new DB_mysql();

    $conn = $db -> db_connect();

    if ($_POST["time"] == NULL) {
        header("Location: index.php");
        exit;
    }
    else {
        $sql1 = "UPDATE dateSetup SET DAY='".$_POST["day"]."' WHERE ID=1";
	    $sql2 = "UPDATE dateSetup SET DATE='".$_POST["date"]."' WHERE ID=1";
	    $sql3 = "UPDATE dateSetup SET TIME='".$_POST["time"]."' WHERE ID=1";
        $sql4 = "UPDATE dateSetup SET CHANGED=".$_GET["change"]." WHERE ID=1";
        
        if ($db -> db_query($sql1) === TRUE) {
            echo("New record updated sucessfully!!!");
        }
        else {
            echo("Error: " . $sql1 . "<br>". $conn->error);
        }
	    if ($db -> db_query($sql2) === TRUE) {
            echo("New record updated sucessfully!!!");
        }
        else {
                echo("Error: " . $sql2 . "<br>". $conn->error);
        }
	    if ($db -> db_query($sql3) === TRUE) {
            echo("New record updated sucessfully!!!");
        }
        else {
            echo("Error: " . $sql3 . "<br>". $conn->error);
        }
	    if ($db -> db_query($sql4) === TRUE) {
            echo("New record updated sucessfully!!!");
			header("Location: index.php");
			exit;
        }
        else {
            echo("Error: " . $sql4 . "<br>". $conn->error);
        }
    }
    $db -> db_close();
?>
