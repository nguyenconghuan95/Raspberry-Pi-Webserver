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
	echo $state[1];
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
		<nav>
			<ul>
				<li><a class="menuSelected" href="schedule.php">SCHEDULE</a></li>
				<li><a href="syncTime.php">SET TIME</a></li>
				<li><a href="configure.php">CONFIGURE</a></li>
			</ul>
		</nav>
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
			<table id="t01">
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
	</div>
</body>

</html>
