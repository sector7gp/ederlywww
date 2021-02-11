<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Viewer</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="120">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="libs/jquery-3.5.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="libs/plotly-latest.min.js"></script>
	<link rel="stylesheet" href="custom.css">
</head>

<body>
	<div class="container">
		<div clase="row">
			<div class="col">
				<div class="panel panel-default">
					<div class="panel panel-heading"> <?php echo "Prueba de sensores WiFi" ?> </div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-lg">
								<div id="cargaLineal"></div>
								<div id="cargaCO2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<?php

include_once("db.config.php");
//echo ">>>>>>>".$_SESSION["lastIP"]."<->".$_SERVER['REMOTE_ADDR'];

if (strcmp($_SESSION["lastIP"],$_SERVER['REMOTE_ADDR'])!==0)
{
	echo "saved";
	$_SESSION["lastIP"] = $_SERVER['REMOTE_ADDR'];
	DB::insert('access', array(
		'IP' => $_SERVER['REMOTE_ADDR'],
		'xF' => $_SERVER['HTTP_X_FORWARDED_FOR']
	));
}
?>

<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright:
    <a class="text-dark" href="https://mdbootstrap.com/">sector7gp.com </a>
     <!-- - lastIP: <?php echo $_SESSION["lastIP"]." - current: ".$_SERVER['REMOTE_ADDR'];?> -->
  </div>
  <!-- Copyright -->
</footer>

</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargaLineal').load('lineal.php');
		$('#cargaCO2').load('co2.php');
	});
</script>