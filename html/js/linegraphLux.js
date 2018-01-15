$(document).ready(function() {
	$.ajax({
		url : "/measureLuxData.php",
		type : "GET",
		success : function(data) {
			
			data = JSON.parse(data);
			var measureTime = [];
            var luxZone1 = [];
            var luxZone2 = [];

			for(var i in data) {
                if (data[i].ZONE == 1) {
                    measureTime.push(data[i].TIME);
                    luxZone1.push(data[i].LUMINOSITY);
                }
                else {
                    luxZone2.push(data[i].LUMINOSITY);
                }
			}

            
            var chartdata = {
				labels: measureTime,
				datasets: [
					{
						label: "Zone 1 Lux (%)",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(51, 255, 51, 0.75)",
						borderColor: "rgba(51, 255, 51, 1)",
						pointHoverBackgroundColor: "rgba(51, 255, 51, 1)",
						pointHoverBorderColor: "rgba(51, 255, 51, 1)",
						data: luxZone1
                    },
                    {
                        label: "Zone 2 Lux (%)",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(0, 51, 0, 0.75)",
						borderColor: "rgba(0, 51, 0, 1)",
						pointHoverBackgroundColor: "rgba(0, 51, 0, 1)",
						pointHoverBorderColor: "rgba(0, 51, 0, 1)",
						data: luxZone2
                    },
				]
            };
            
            var ctx = $("#luxGraph");

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
                                max: 5000,
                                stepSize: 250
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