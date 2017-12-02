<!DOCTYPE HTML>
<html>
<head>
    <title>Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <header>
        <h1>WATER SCHEDULE</h1>
    </header>
    <div style="padding: 5%; height: 100%;">
    <strong>Choose (1-10) number of settings you want to set or delete:<strong><br>
    <form action="#" method="post">
	<input style="width: 50px;"  type="number" name="number" min="0" max="10">&nbsp;&nbsp;&nbsp;&nbsp;
	<input style="border-radius: 10px;"  type="submit" name="Add" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
	<input style="border-radius: 10px;" type="submit" name="Delete" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
	<input style="border-radius: 10px;" type="submit" name="schedule" value="Water Schedule"><br><br>
    </form>
    <?php
        if (isset($_POST["Add"])) {
            echo("<form action='saveSchedule.php?count=".$_POST["number"]."' method='post'>");
	    for ($i = 1; $i <= $_POST["number"]; $i++) {
		$dayOn="dayOn".$i;
		$timeOn="timeOn".$i;
		$dayOff="dayOff".$i;
		$timeOff="timeOff".$i;
		$type="type".$i;
		$device="device".$i;
		echo $i.".&nbsp;";
	        echo("Day-On:<select name='$dayOn'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
                echo("</select>&nbsp;&nbsp;&nbsp;&nbsp");
                echo("Time-On:<input type='time' name='$timeOn'>&nbsp;&nbsp;&nbsp;&nbsp;"); 
			echo("Day-Off:<select name='$dayOff'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
		echo("</select>&nbsp;&nbsp;&nbsp;&nbsp;");
		echo("Time-Off:<input type='time' name='$timeOff'>&nbsp;&nbsp;&nbsp;&nbsp;");
		echo("Device:<select name='$device'>");
		    echo("<option value='Led1'>Led 1</option>");
		    echo("<option value='Led2'>Led 2</option>");
		echo("</select><br><br>");
	    }
	    echo("<input style='border-radius: 10px;'  type='submit' name='submitAdd' value='Add'>");
            echo("</form>");
        }

	if (isset($_POST["Delete"])) {
            echo("<form action='saveSchedule.php?count=".$_POST["number"]."' method='post'>");
            for ($i = 1; $i <= $_POST["number"]; $i++) {
		$dayOn = "dayOn".$i;
		$timeOn = "timeOn".$i;
		$dayOff="dayOff".$i;
		$timeOff = "timeOff".$i;
		$device = "device".$i;
                echo("Day-On:<select name='$dayOn'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
                echo("</select>&nbsp;&nbsp;&nbsp;&nbsp");
                echo("Time-On:<input type='time' name='$timeOn'>&nbsp;&nbsp;&nbsp;&nbsp;");
		echo("Day-Off:<select name='$dayOff'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
                echo("</select>&nbsp;&nbsp;&nbsp;&nbsp");
		echo("Time-Off:<input type='time' name='$timeOff'>&nbsp;&nbsp;&nbsp;&nbsp;");
                echo("Device:<select name='$device'>");
                    echo("<option value='Led1'>Led 1</option>");
		    		echo("<option value='Led2'>Led 2</option>");
                echo("</select><br><br>");
	    }
            echo("<input style='border-radius: 10px;' type='submit' name='submitDelete' value='Delete'>");
            echo("</form>");
	}

	if (isset($_POST["schedule"])) {
	    $servername = "localhost";
	    $username = "admin";
	    $password = "admin";
	    $dbname = "smartGarden";

	    //Create Connection
	    $conn = mysqli_connect($servername, $username, $password, $dbname);

	    //Check Connection
	    if (mysqli_connect_errno()) {
		echo("Failed to connect to MySQL: ". mysqli_connect_error());
	    }

	    $sql = "SELECT * FROM schedule";
	    $records = mysqli_query($conn, $sql);
	    if ($records) {
		echo("<table style='margin: auto;' width='600' border='1' cellpadding='1' cellspacing='1'>");
		echo("<tr>");
		    echo("<th>DAY_ON</th>");
		    echo("<th>TIME_ON</th>");
			echo("<th>DAY_OFF</th>");
		    echo("<th>TIME_OFF</th>");
		    echo("<th>DEVICE</th>");
		echo("<tr>");
		while ($data=mysqli_fetch_assoc($records)) {
		    echo("<tr>");
			echo("<td>". $data['DAY_ON'] ."</td>");
			echo("<td>". $data['TIME_ON'] ."</td>");
			echo("<td>". $data['DAY_OFF'] ."</td>");
			echo("<td>". $data['TIME_OFF'] ."</td>");
			echo("<td>". $data['DEVICE'] ."</td>");
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
