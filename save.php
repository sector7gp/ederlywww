<?php
	include_once("db.config.php");

	$data = json_decode(file_get_contents('php://input'), true);
    print_r($data);

	//foreach ($data as $key => $value) {
	//	echo $key . ": ". $value . "</br>";
		DB::insert('sensors', array(
		  'clientId' => $data[clientId],
		  'deviceId' => $data[deviceId],
		  'value' => $data[value]
		));
	//}

	print("ok-www");
?>

