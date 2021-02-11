  <?php
  include_once("db.config.php");

  $results = DB::query("SELECT * FROM sensors WHERE clientId=2 order by id desc limit 10", $clientId, $deviceId);
//  $results = DB::query("SELECT created, value, name, location, description FROM ((sensors INNER JOIN device ON sensors.deviceId = device.id) INNER JOIN client ON sensors.clientId = client.id) order by sensors.id desc limit 40", $clientId, $deviceId, $description);

//print_r($results);

  foreach ($results as $key => $result) {
   $created[$key] = $result['created'];
   $value[$key] = $result['value'];
   $deviceId[$key] = $result['deviceId'];
   //print_r($deviceId[$key].'<br>');
   
   
   switch($deviceId[$key]){
    case "257A00": 
    $barColor[$key] = 'red';
    $description[$key] = 'DEMO';
    break;

  }

}
$created = json_encode($created);
$value = json_encode($value);
$deviceId = json_encode($deviceId);
$barColor = json_encode($barColor);
$description = json_encode($description);
//print_r($created);

?> 
<script type="text/javascript">

  function crearCadenaLineal(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }
</script>

<div id="co2"></div>

<script type="text/javascript">
  var today = new Date();
  //console.log(today);
  var yesterday = new Date();
  yesterday.setDate(yesterday.getDate() - 1);
  //console.log(yesterday);

  var hourAgo = new Date(today.getTime() - (1000*20*60));
  //console.log(hourAgo);

  created = crearCadenaLineal('<?php echo $created; ?>');
  value = crearCadenaLineal('<?php echo $value; ?>');
  deviceId = crearCadenaLineal('<?php echo $deviceId; ?>');
  barColor = crearCadenaLineal('<?php echo $barColor; ?>');
  description = crearCadenaLineal('<?php echo $description; ?>');
  var data = [
  {
    x: created,
    y: value,
    text: description,
    type: 'bar',
    marker: {color: barColor}

  }
  ];


  var layout = {
    title: 'Testing',
    //font: {size: 12}

    hovermode:'closest',
    yaxis: { range: [0,1],
      fixedrange: true,
      tickformat: 'd'},

      xaxis: {
        range: [hourAgo, Date.now()],
        autosize: false
      }
    };

  //var data = [trace1, trace2];

  Plotly.newPlot('co2', data, layout, {responsive: false});

  // setInterval(function() {
  //   Plotly.extendTraces('graficaLineal', { x: [[crearCadenaLineal('<?php echo $created; ?>')]], y: [[crearCadenaLineal('<?php echo $value; ?>')]] }, [0])
  // }, 5000);
</script>