$(document).ready(function() {
	$.ajax({
		url : "/measureHumidData.php",
		type : "GET",
		success : function(data) {
			console.log(data);
			
			data = JSON.parse(data);
			var time = [];
			var humid = [];

			for(var i in data) {
				time.push(data[i].TIME);
				humid.push(data[i].HUMIDITY);
			}

			var chartdata = {
				labels: time,
				datasets: [
					{
						label: "Humidity",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: humid
					}
				]
			};
			var ctx = $("#humidGraph");
			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
                    responsive: true,
                    title:{
                        display: true,
                        text: "Measurement"
                    },
                    scales: {
                        responsive: true,
                        title:{
                            display: true,
                            text: "Measurement"
                        },
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
								stepSize: 10
                            }
                        }]
                    }
                }

			});

		},
		error : function(data) {

		}
	});
});
