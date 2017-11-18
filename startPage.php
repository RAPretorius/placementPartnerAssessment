<?php
	include('retrieveAdverts.php');
?>

<!DOCTYPE html>
<html style="padding: 20px;">
	<head>
		<title>Placement Partner Assessment</title>
		
		<!--reference to the stylesheets used for bootstrap and datatables-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-flash-1.4.2/b-html5-1.4.2/datatables.min.css"/>
		
		<!--reference to the scripts used for jquery, bootstrap, highcharts, and datatables-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-flash-1.4.2/b-html5-1.4.2/datatables.min.js"></script>
		
		<!--scripts for getting the php category and series objects into javascript objects for use in highcharts-->
		<script>
			var categories = JSON.parse( '<?php echo json_encode($categoriesArray); ?>' );
			var series = JSON.parse( '<?php echo json_encode($seriesArray); ?>' );
		</script>
		<script src="createChart.js"></script>
		<script src="exportExcel.js"></script>
	</head>
	<body>
		<h1>Please select a format to display the number of advertisments in below.</h1>
		<div>
			<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#tableDiv">Table</button>
			<br>
			<div id="tableDiv" class="collapse">
				<table id="adsTable" class="display nowrap dataTable" role="grid" aria-describedby="example_info" style="width: 100%;" cellspacing="0">
					<thead>
						<tr>
							<th>Week</th>
							<?php 
								foreach ($regions as $reg)
								{
									echo "<th>${reg}</th>";
								}
							?>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($weekVacancyResults as $week => $region)
						{
							echo "<tr>";
							echo "<td>${week}</td>";
							foreach ($region as $adCount)
							{
								echo "<td>${adCount}</td>";
							}
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		
		<br>
		
		<div>
			<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#graphDiv">Graph</button>
			<div id="graphDiv" class="collapse">
				<div id="graph" style="width:100%; height:400px;">
				</div>
			</div>
			<script>generateChart();</script>
		</div>
	</body>
</html>