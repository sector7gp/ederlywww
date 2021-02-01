<!DOCTYPE html>
<html>
<head>
	<title>Viewer</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="20">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="libs/jquery-3.5.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="libs/plotly-latest.min.js"></script>
</head>

<body>




	<div class="container">
		<div clase="row">
			<div class="col">
				<div class="panel panel-default">
					<div class="panel panel-heading"> <?php echo $description; ?> </div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-lg">
								<div id="cargaLineal"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargaLineal').load('lineal.php');
		//$('#cargaBarras').load('barras.php');
	});
</script>