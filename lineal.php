  <?php
  include_once("db.config.php");

$results = DB::query("SELECT * FROM sensors WHERE clientId=1 order by id desc limit 50", $clientId, $deviceId);
//  $results = DB::query("SELECT created, value, name, location, description FROM ((sensors INNER JOIN device ON sensors.deviceId = device.id) INNER JOIN client ON sensors.clientId = client.id) order by sensors.id desc limit 40", $clientId, $deviceId, $description);

//print_r($results);

  foreach ($results as $key => $result) {
   $created[$key] = $result['created'];
   $value[$key] = $result['value'];
 }
 $created = json_encode($created);
 $value = json_encode($value);
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

<div id="graficaLineal"></div>

<script type="text/javascript">
  var today = new Date();
  //console.log(today);
  var yesterday = new Date();
  yesterday.setDate(yesterday.getDate() - 1);
  //console.log(yesterday);

  var hourAgo = new Date(today.getTime() - (1000*60*60));
  //console.log(hourAgo);

  created = crearCadenaLineal('<?php echo $created; ?>');
  value = crearCadenaLineal('<?php echo $value; ?>');
  var data = [
  {
    x: created,
    y: value,
    type: 'bar'
  }
  ];

  var layout = {
    //title: '<?php echo $description;?>',
    //font: {size: 12}

    yaxis: { range: [0,1],
      fixedrange: true,
      tickformat: 'd'},

      xaxis: {
        range: [hourAgo, Date.now()]
      }
    };

  //var data = [trace1, trace2];

  Plotly.newPlot('graficaLineal', data, layout, {responsive: false});

  setInterval(function() {
    Plotly.extendTraces('graficaLineal', { x: [[crearCadenaLineal('<?php echo $created; ?>')]], y: [[crearCadenaLineal('<?php echo $value; ?>')]] }, [0])
  }, 5000);
</script>