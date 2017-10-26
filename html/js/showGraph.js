function showTempGraph() {
	document.getElementById("humidGraph").style.display = "none";
	document.getElementById("luxGraph").style.display = "none";
	document.getElementById("tempGraph").style.display = "block";
}

function showLuxGraph() {
    document.getElementById("humidGraph").style.display = "none";
    document.getElementById("luxGraph").style.display = "block";
    document.getElementById("tempGraph").style.display = "none";
}

function showHumidGraph() {
    document.getElementById("humidGraph").style.display = "block";
    document.getElementById("luxGraph").style.display = "none";
    document.getElementById("tempGraph").style.display = "none";
}


