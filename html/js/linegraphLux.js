$(document).ready(function(){
	$.ajax({
		url : "/measureLuxData.php",
		type : "GET",
		success : function(data){
			console.log(data);

			data = JSON.parse(data);
			var time = [];
			var lux = [];

			for(var i in data) {
				time.push(data[i].TIME);
				lux.push(data[i].LUMINOSITY);
			}

			var chartdata = {
				labels: time,
				datasets: [
					{
						label: "Luminosity",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(211, 72, 54, 0.75)",
						borderColor: "rgba(211, 72, 54, 1)",
						pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
						pointHoverBorderColor: "rgba(211, 72, 54, 1)",
						data: lux
					}
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
                                max: 1000,
                                stepSize: 100
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
