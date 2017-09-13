<!DOCTYPE HTML>
<html>
<style>
    .btn {
	border-radius: 10px;
    }

    body {
	background-color: #A9A9A9;
    }

    h1 {
	color: white;
	text-align: center;
    }

    .number {
	width: 50px;
    }
</style>
<body>
    <h1>WATER SCHEDULE</h1>
    <strong>Choose (1-10) number of settings you want to set or delete:<strong><br>
    <form action="#" method="post">
	<input class="number" type="number" name="number" min="0" max="10">&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="btn"  type="submit" name="Add" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="btn" type="submit" name="Delete" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="btn" type="submit" name="schedule" value="Water Schedule"><br><br>
    </form>
    <?php
        if (isset($_POST["Add"])) {
            echo("<form action='saveSchedule.php?count=".$_POST["number"]."' method='post'>");
	    for ($i = 1; $i <= $_POST["number"]; $i++) {
		$day="day".$i;
		$time="time".$i;
		$type="type".$i;
	        echo("Day:<select name='$day'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
                echo("</select>&nbsp;&nbsp;&nbsp;&nbsp");
                echo("Time:<input type='time' name='$time'>&nbsp;&nbsp;&nbsp;&nbsp;");
                echo("Type:<select name='$type'>");
                    echo("<option value='Water'>Water</option>");
                echo("</select><br><br>");
	    }
	    echo("<input class='btn' type='submit' name='submitAdd' value='Add'>");
            echo("</form>");
        }

	if (isset($_POST["Delete"])) {
            echo("<form action='saveSchedule.php?count=".$_POST["number"]."' method='post'>");
            for ($i = 1; $i <= $_POST["number"]; $i++) {
		$day = "day".$i;
		$time = "time".$i;
		$type = "type".$i;
                echo("Day:<select name='$day'>");
                    echo("<option value='Mon'>Monday</option>");
                    echo("<option value='Tue'>Tuesday</option>");
                    echo("<option value='Wed'>Wednesday</option>");
                    echo("<option value='Thu'>Thursday</option>");
                    echo("<option value='Fri'>Friday</option>");
                    echo("<option value='Sat'>Saturday</option>");
                    echo("<option value='Sun'>Sunday</option>");
                echo("</select>&nbsp;&nbsp;&nbsp;&nbsp");
                echo("Time:<input type='time' name='$time'>&nbsp;&nbsp;&nbsp;&nbsp;");
                echo("Type:<select name='$type'>");
                    echo("<option value='Water'>Water</option>");
                echo("</select><br><br>");
	    }
            echo("<input class='btn' type='submit' name='submitDelete' value='Delete'>");
            echo("</form>");
	}
    ?>
</body>
</html>
