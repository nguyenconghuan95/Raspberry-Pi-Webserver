$(document).ready(function() {
	$.ajax({
		url : "/measureTempData.php",
		type : "GET",
		success : function(data) {
			console.log(data);
			
			data = JSON.parse(data);
			var measureTime = [];
            var tempZone1 = [];
            var tempZone2 = [];

			for(var i in data) {
                if (data[i].ZONE == 1) {
                    measureTime.push(data[i].TIME);
                    tempZone1.push(data[i].HUMIDITY);
                }
                else {
                    tempZone2.push(data[i].HUMIDITY);
                }
			}
			
			console.log(tempZone1);
            
            var chartdata = {
				labels: measureTime,
				datasets: [
					{
						label: "Zone 1 Temperature (%)",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(255, 0, 0, 0.75)",
						borderColor: "rgba(255, 0, 0, 1)",
						pointHoverBackgroundColor: "rgba(255, 0, 0, 1)",
						pointHoverBorderColor: "rgba(255, 0, 0, 1)",
						data: tempZone1
                    },
                    {
                        label: "Zone 2 Temperature (%)",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(128, 0, 0, 0.75)",
						borderColor: "rgba(128, 0, 0, 1)",
						pointHoverBackgroundColor: "rgba(128, 0, 0, 1)",
						pointHoverBorderColor: "rgba(128, 0, 0, 1)",
						data: tempZone2
                    },
				]
            };
            
            var ctx = $("#tempGraph");

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