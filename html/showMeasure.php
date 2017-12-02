<!DOCTYPE html>
<html>
<head>
	<title>Measurement</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
    	<h1>MEASUREMENT</h1>
	</header>
	<div style="padding: 5%; height: 100%;">
	<form style="margin: auto;" action="#" method="post">
		<input type="submit" name="Zone1" value="Zone 1">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="Zone2" value="Zone 2"><br><br>
	</form>
	<?php
		$servername = "localhost";
 		$username = "admin";
 		$password = "admin";
 		$dbname = "smartGarden";

		if (isset($_POST["Zone1"])) {
			//Create Connection
        	$conn = mysqli_connect($servername, $username, $password, $dbname);

        	//Check Connection
        	if (mysqli_connect_errno()) {
        	echo("Failed to connect to MySQL: ". mysqli_connect_error());
        	}

			$sql = "SELECT * FROM measurement WHERE ZONE=1";
			$records = mysqli_query($conn, $sql);
			if ($records) {
				echo("<table style='margin: auto;' width='600' border='1' cellpadding='1' cellspacing='1'>");
        		echo("<tr>");
            		echo("<th>TIME</th>");
            		echo("<th>TEMPERATURE</th>");
            		echo("<th>HUMIDITY (%)</th>");
            		echo("<th>LUMINOSITY (LUX)</th>");
        		echo("</tr>");
        		while ($data=mysqli_fetch_assoc($records)) {
            	echo("<tr>");
            		echo("<td>". $data['TIME'] ."</td>");
            		echo("<td>". $data['TEMPERATURE'] ."</td>");
            		echo("<td>". $data['HUMIDITY'] ."</td>");
            		echo("<td>". $data['LUMINOSITY'] ."</td>");
            	echo("</tr>");
 				}
        	}
        	else {
        		echo("Error reading schedule table from MySQL: ". mysqli_error($conn));
        	}
		}

		if (isset($_POST["Zone2"])) {
            //Create Connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            //Check Connection
            if (mysqli_connect_errno()) {
            echo("Failed to connect to MySQL: ". mysqli_connect_error());
            }

            $sql = "SELECT * FROM measurement WHERE ZONE=2";
            $records = mysqli_query($conn, $sql);
            if ($records) {
                echo("<table style='margin: auto;' width='600' border='1' cellpadding='1' cellspacing='1'>");
                echo("<tr>");
                    echo("<th>TIME</th>");
                    echo("<th>TEMPERATURE</th>");
                    echo("<th>HUMIDITY</th>");
                    echo("<th>LUMINOSITY</th>");
                echo("</tr>");
                while ($data=mysqli_fetch_assoc($records)) {
                echo("<tr>");
                    echo("<td>". $data['TIME'] ."</td>");
                    echo("<td>". $data['TEMPERATURE'] ."</td>");
                    echo("<td>". $data['HUMIDITY'] ."</td>");
                    echo("<td>". $data['LUMINOSITY'] ."</td>");
                echo("</tr>");
				}
            }
            else {
                echo("Error reading schedule table from MySQL: ". mysqli_error($conn));
            }
		}
	?>
	</div>
</body>
</html>

