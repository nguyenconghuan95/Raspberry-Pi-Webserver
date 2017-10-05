$(document).ready(function(){
	$.ajax( {
		url : "/measureData.php",
		type : "GET",
		success : function(data) {
			console.log(data);

			var time = [];
			var humidity = [];

			for (var i in data) {
				time.push(data[i].TIME);
				humidity.push(data[i].HUMIDITY);
			}

			var chartdata = {
				labels: time,
				datasets: [
					{
						label: "humidity",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rbga(59, 89, 152,0.75)",
						borderColor: "rbga(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rbga(59, 89, 152,1)",
						pointHoverBorderColor: "rbga(59, 89, 152, 1)",
						data: humidity
					}
				]
			};
			var ctx = $("#mycanvas");
			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error : function(data) {
			
		}
	});
});
