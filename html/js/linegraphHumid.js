$(document).ready(function() {
	$.ajax({
		url : "/measureHumidData.php",
		type : "GET",
		success : function(data) {
			console.log(data);
			
			data = JSON.parse(data);
			var measureTime = [];
            var humidZone1 = [];
            var humidZone2 = [];

			for(var i in data) {
                if (data[i].ZONE == 1) {
                    measureTime.push(data[i].TIME);
                    humidZone1.push(data[i].HUMIDITY);
                }
                else {
                    humidZone2.push(data[i].HUMIDITY);
                }
            }

            console.log(measureTime);
            console.log(humidZone1);
            console.log(humidZone2);
            
            var chartdata = {
				labels: measureTime,
				datasets: [
					{
						label: "Zone 1 Humidity (%)",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: humidZone1
                    },
                    {
                        label: "Zone 2 Humidity (%)",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: humidZone2
                    },
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