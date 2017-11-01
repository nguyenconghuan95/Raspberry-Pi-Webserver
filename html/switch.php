<!DOCTYPE html>
<?php
	$servername = "localhost";
	$username = "admin";
	$password = "admin";
	$dbname = "smartGarden";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$sql_led1 = "SELECT STATUS FROM led WHERE LED='Led1'";
	$sql_led2 = "SELECT STATUS FROM led WHERE LED='Led2'";
	$led1 = mysqli_query($conn, $sql_led1);
	$led1 = mysqli_fetch_array($led1);
	$led1 = $led1[0];
	$led2 = mysqli_query($conn, $sql_led2);
	$led2 = mysqli_fetch_array($led2);
	$led2 = $led2[0];
?>
<html>
<head>
	<title>Switch</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header class="project-name">
		<h1>MANUAL CONTROL</h1>
	</header>
	<div style="padding: 5%; height: 100%;">
		<table id="t01">
			<tr>
				<th>ZONE 1</th>
				<th>ZONE 2</th>
			</tr>
			<tr>
				<td>
					<?php
						if ($led1 == "On") {
							echo "<img id='Led1' src='image/onbutton.jpg'/></a><br>";
						}
						else {
							echo "<img id='Led1' src='image/offbutton.jpg'/></a><br>";
						}
					?>
					<button onclick="turn('On', 'Led1');">Turn On</button>
					<button onclick="turn('Off', 'Led1');">Turn Off</button>
					<br>
					<p>LED 1</p>
				</td>
				<td>
					<?php
						if ($led2 == "On") {
							echo "<a href='#'><img id='Led2' src='image/onbutton.jpg' onclick=/></a><br>";
						}
						else {
							echo "<a href='#'><img id='Led2' src='image/offbutton.jpg' onclick=/></a><br>";
						}
					?>
					<button onclick="turn('On', 'Led2');">Turn On</button>
                    <button onclick="turn('Off', 'Led2');">Turn Off</button>
                    <br>
                    <p>LED 2</p>
				</td>
			</tr>
		</table>
	</div>
	<script src="lightLed.js"></script>
</body>
</html>
