$(document).ready(function(){
	$.ajax({
		url : "/measureTempData.php",
		type : "GET",
		success : function(data){
			console.log(data);

			data = JSON.parse(data);
			var time = [];
			var temp = [];

			for(var i in data) {
				time.push(data[i].TIME);
				temp.push(data[i].TEMPERATURE);
			}

			var chartdata = {
				labels: time,
				datasets: [
					{
						label: "Temperature",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: temp
					}
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
