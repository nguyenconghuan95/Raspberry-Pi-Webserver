<!DOCTYPE html>
<?php
	$servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "smartGarden";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "SELECT STATUS FROM led";
	$result = mysqli_query($conn, $sql);
	$i = 0;
	while ($status = mysqli_fetch_array($result)) {
		$state[$i] = $status[0];
		$i = $i + 1;
	}


	$sql = "SELECT * FROM limitIndex WHERE ZONE=1";
	$result = mysqli_query($conn, $sql);
	$a = mysqli_fetch_array($result);
	$temp1 = $a[1];
	$humid1 = $a[2];
    $lux1High = $a[3];
    $lux1Low = $a[4];

	$sql = "SELECT * FROM limitIndex WHERE ZONE=2";
    $result = mysqli_query($conn, $sql);
    $a = mysqli_fetch_array($result);
    $temp2 = $a[1];
    $humid2 = $a[2];
    $lux2High = $a[3];
    $lux2Low = $a[4];

?>

<html>
<head>
	<title>Test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/demo_index.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap2-toggle.min.css">
</head>
<body>
	<header class="project-name">
		<a href="#"><img class="logo" src="image/logo.png"/></a>
	</header>
	<div id="content" class="container">
		<div id="graph">
			<div class="chart-container">
        		<canvas id="humidGraph"></canvas>
				<canvas id="tempGraph" style="display: none;"></canvas>
				<canvas id="luxGraph" style="display: none;"></canvas>
    		</div>
			<button onclick="showHumidGraph()">Humidity</button>
			<button onclick="showTempGraph()">Temperature</button>
			<button onclick="showLuxGraph()">Luminosity</button>

			<script type="text/javascript" src="js/showGraph.js"></script>
    		<script type="text/javascript" src="js/jquery.min.js"></script>
    		<script type="text/javascript" src="js/Chart.min.js"></script>
    		<script type="text/javascript" src="js/linegraphHumid.js"></script>
			<script type="text/javascript" src="js/linegraphLux.js"></script>
			<script type="text/javascript" src="js/linegraphTemp.js"></script>
		</div>
		<div id="info">
			<table class="t01">
				<tr>
					<th rowspan="2">ZONE 1</th>
					<td><strong>Light</strong><br>
						<label class="switch">
						<?php
							if ($state[0] == 'On') {
								echo("<input type='checkbox' id='light1' checked>");
								echo("<span class='slider'></span>");
							}
							else {
								echo("<input type='checkbox' id='light1'>");
                                echo("<span class='slider'></span>");
							}
						?>
					</td>
					<td><strong>Hose</strong><br>
                        <label class="switch">
                        <?php
                            if ($state[2] == 'On') {
                                echo("<input type='checkbox' id='hose1' checked>");
                                echo("<span class='slider'></span>");
                            }
                            else {
                                echo("<input type='checkbox' id='hose1'>");
                                echo("<span class='slider'></span>");
                            }
                        ?>

					</td>
				</tr>
				<tr style="border-bottom: 1px solid black;">
					<td><strong>Sunshade</strong><br>
                        <label class="switch">
                        <?php
                            if ($state[4] == 'On') {
                                echo("<input type='checkbox' id='sunshade1' checked>");
                                echo("<span class='slider'></span>");
                            }
                            else {
                                echo("<input type='checkbox' id='sunshade1'>");
                                echo("<span class='slider'></span>");
                            }
                        ?>

                    </td>
					<td><strong></strong><br>
                        <label class="switch">
                        <input type="checkbox" id="device1">
                        <span class="slider"></span>
                    </td>
				</tr>
				<tr>
					<th rowspan="2">ZONE 2</th>
					<td><strong>Light</strong><br>
                        <label class="switch">
                        <?php
                            if ($state[1] == 'On') {
                                echo("<input type='checkbox' id='light2' checked>");
                                echo("<span class='slider'></span>");
                            }
                            else {
                                echo("<input type='checkbox' id='light2'>");
                                echo("<span class='slider'></span>");
                            }
                        ?>

                    </td>
					<td><strong>Hose</strong><br>
                        <label class="switch">
                        <?php
                            if ($state[3] == 'On') {
                                echo("<input type='checkbox' id='hose2' checked>");
                                echo("<span class='slider'></span>");
                            }
                            else {
                                echo("<input type='checkbox' id='hose2'>");
                                echo("<span class='slider'></span>");
                            }
                        ?>

                    </td>
				</tr>
				<tr>
					<td><strong>Sunshade</strong><br>
                        <label class="switch">
                        <?php
                            if ($state[5] == 'On') {
                                echo("<input type='checkbox' id='sunshade2' checked>");
                                echo("<span class='slider'></span>");
                            }
                            else {
                                echo("<input type='checkbox' id='sunshade2'>");
                                echo("<span class='slider'></span>");
                            }
                        ?>

                    </td>
					<td><strong></strong><br>
                        <label class="switch">
                        <input type="checkbox" id="device2">
                        <span class="slider"></span>
                    </td>
				</tr>
			</table>
			<script type="text/javascript" src="js/lightLed.js"></script>
		</div>
		<div id="setTime">
			<form action="setTime.php?change=1" method="post">
    		<div>
        		Day:<select name='day' style="width: 50%;">");
                    	<option value='Mon'>Monday</option>
                    	<option value='Tue'>Tuesday</option>
                    	<option value='Wed'>Wednesday</option>
                    	<option value='Thu'>Thursday</option>
                    	<option value='Fri'>Friday</option>
                    	<option value='Sat'>Saturday</option>
                    	<option value='Sun'>Sunday</option>
             	</select><br>
        		Date:<input type="date" name="date" style="width: 50%;" value="now"><br>
        		Time:<input type="time" name="time" style="width: 50%;" value="now"><br><br>
        		<input type="submit" value="Submit" style="border-radius: 10px;"></input>
    		</div>
    		</form>
		</div>
		<div id="schedule">
			<form action="saveSchedule.php" method="post">
				Day-On:&nbsp;
				<select name="dayOn">
                        <option value='Mon'>Monday</option>
                        <option value='Tue'>Tuesday</option>
                        <option value='Wed'>Wednesday</option>
                        <option value='Thu'>Thursday</option>
                        <option value='Fri'>Friday</option>
                        <option value='Sat'>Saturday</option>
                        <option value='Sun'>Sunday</option>
                </select>&nbsp;&nbsp;&nbsp;
				Time-On:&nbsp;
				<input type="time" name="timeOn"/><br><br>
				Day-Off:&nbsp;
				<select name="dayOff">");
                        <option value='Mon'>Monday</option>
                        <option value='Tue'>Tuesday</option>
                        <option value='Wed'>Wednesday</option>
                        <option value='Thu'>Thursday</option>
                        <option value='Fri'>Friday</option>
                        <option value='Sat'>Saturday</option>
                        <option value='Sun'>Sunday</option>
                </select>&nbsp;&nbsp;&nbsp;
				Time-Off:&nbsp;
				<input type="time" name="timeOff" value="now"/><br><br>
				Device:&nbsp;
				<select name="device">
					<option value="light1">Light 1</option>
					<option value="hose1">Hose 1</option>
					<option value="sunshade1">Sunshade 1</option>
					<option value="light2">Light 2</option>
					<option value="hose2">Hose 2</option>
					<option value="sunshade2">Sunshade 2</option>
				</select><br><br>
				<input type="submit" name="addSchedule" value="Add"/>&nbsp;
                <input type="submit" name="deleteSchedule" value="Delete"/>
                <input type="submit" name="deleteScheduleAll" value="Delete All"/>
			</form>
			<br>
			<?php
            $sql = "SELECT * FROM schedule";
            $records = mysqli_query($conn, $sql);
            if ($records) {
                echo("<table class='t03'>");
                echo("<tr style='border-collapse: collapse;'>");
                    echo("<th>DAY_ON</th>");
                    echo("<th>TIME_ON</th>");
                    echo("<th>DAY_OFF</th>");
                    echo("<th>TIME_OFF</th>");
                    echo("<th>DEVICE</th>");
                echo("</tr>");
                while ($data=mysqli_fetch_assoc($records)) {
                    echo("<tr style='border-collapse: collapse;'>");
                        echo("<td>". $data['DAY_ON'] ."</td>");
                        echo("<td>". $data['TIME_ON'] ."</td>");
                        echo("<td>". $data['DAY_OFF'] ."</td>");
                        echo("<td>". $data['TIME_OFF'] ."</td>");
                        echo("<td>". $data['DEVICE'] ."</td>");
                    echo("</tr>");
                }
				echo("</table>");
            }
            else {
                echo("Error reading schedule table from MySQL: ". mysqli_error($conn));
            }
        ?>

		</div>
		<div id="configure">
			<table class="t01">
				<tr>
					<th rowspan="4">ZONE 1</th>
					<td><strong>Temperature</strong>
						<form action="#" method="post">
							<?php
								echo("<input id='LimitTemp1'  type='range' min='0' max='100' step='1' value='".$temp1."'/>");
								echo("<br><span id='LimitTemp1Range'>".$temp1."</span>");
							?>
						</form>
					</td>
				</tr>
				<tr>
					<td><strong>Humidity</strong>
						<form action="#" method="post">
                            <?php
                                echo("<input id='LimitHumid1'  type='range' min='0' max='100' step='1' value='".$humid1."'/>");
                                echo("<br><span id='LimitHumid1Range'>".$humid1."</span>");
                            ?>

                        </form>
					</td>
				</tr>
				<tr>
					<td><strong>High Luminosity</strong>
						<form action="#" method="post">
                            <?php
                                echo("<input id='LimitLuxHigh1'  type='range' min='0' max='10000' step='100' value='".$lux1High."'/>");
                                echo("<br><span id='LimitLuxHigh1Range'>".$lux1High."</span>");
                            ?>

                        </form>
					</td>
				</tr>
                <tr style="border-bottom: 1px solid black;">
					<td><strong>Low Luminosity</strong>
						<form action="#" method="post">
                            <?php
                                echo("<input id='LimitLuxLow1'  type='range' min='0' max='10000' step='100' value='".$lux1Low."'/>");
                                echo("<br><span id='LimitLuxLow1Range'>".$lux1Low."</span>");
                            ?>

                        </form>
					</td>
				</tr>
				<tr>
                    <th rowspan="4">ZONE 2</th>
                    <td><strong>Temperature</strong>
                        <form action="#" method="post">
                            <?php
                                echo("<input id='LimitTemp2'  type='range' min='0' max='100' step='1' value='".$temp2."'/>");
                                echo("<br><span id='LimitTemp2Range'>".$temp2."</span>");
                            ?>

                        </form>
                    </td>
                </tr>
                <tr>
                    <td><strong>Humidity</strong>
                        <form action="#" method="post">
                            <?php
                                echo("<input id='LimitHumid2'  type='range' min='0' max='100' step='1' value='".$humid2."'/>");
                                echo("<br><span id='LimitHumid2Range'>".$humid2."</span>");
                            ?>

                        </form>
                    </td>
                </tr>
                <tr>
                    <td><strong>High Luminosity</strong>
                        <form action="#" method="post">
                            <?php
                                echo("<input id='LimitLuxHigh2'  type='range' min='0' max='10000' step='100' value='".$lux2High."'/>");
                                echo("<br><span id='LimitLuxHigh2Range'>".$lux2High."</span>");
                                mysqli_close($conn);
                       		?>

                        </form>
                    </td>
                </tr>
                <tr>
                    <td><strong>Low Luminosity</strong>
                        <form action="#" method="post">
                            <?php
                                echo("<input id='LimitLuxLow2'  type='range' min='0' max='10000' step='100' value='".$lux2Low."'/>");
                                echo("<br><span id='LimitLuxLow2Range'>".$lux2Low."</span>");
                                mysqli_close($conn);
                       		?>

                        </form>
                    </td>
                </tr>
			</table>
			<script type="text/javascript">
				$('input[type="range"]').on('change', function() {
					var id = $(this).attr('id');
					var value = $(this).val();
					var zone = id[id.length-1];
					var kind = id.slice(0, id.length-1);

					document.getElementById(id + "Range").innerHTML = value;
					$.post("saveLimit.php", {limZone: zone, limPara: kind, limValue: value});
				})
			</script>
		</div>
	</div>
</body>
</html>
