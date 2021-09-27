<html>
<head>
	<title>Elwyn's Highcharts Example</title>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src = "https://code.highcharts.com/highcharts.js"></script>  
</head>

<body>
<div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
<script language = "JavaScript">

$(document).ready(function() {   
	var title = {
		text: 'Maximum and Minimum Temperatures for Last 7 Days'   
	};
	var subtitle = {
		text: 'Source: Randomly Generated Fake Data'
	};
	var xAxis = {
		categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun']
	};
	var yAxis = {
		title: {
			text: 'Temperature (\xB0C)'
		}
	};
	var plotOptions = {
		line: {
			dataLabels: {
				enabled: true
			},   
			enableMouseTracking: false
		}
	};

/* 
	var series = [
		{
			name: 'Tokyo',
			data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		}, 
		{
			name: 'London',
			data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
		}
	];
*/
	
	var json = {};
	json.title = title;
	json.subtitle = subtitle;
	json.xAxis = xAxis;
	json.yAxis = yAxis;  
	json.plotOptions = plotOptions;

	$.getJSON('weather.php', (result) => {
		json.series = result;
		$('#container').highcharts(json); 
	});
});
</script>
</body>

</html>
