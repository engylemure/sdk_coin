<html>
  <head>
  <?php
        require_once("bc_ticker.php");
        $dataPoints = array();
        array_push($dataPoints,array('Date','High','Low','Last'));
        $ticker = new Ticker();
        $ticker->createInstance();
        $ticker->info();
        $array_ticker = $ticker->getByPeriod($ticker->getDateUnix()-3600*72,$ticker->getDateUnix(),60);
        foreach($array_ticker as $k => $var){
            array_push($dataPoints, array($var->getDate(), $var->getHigh(),$var->getLow(),$var->getLast()));
        }
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);

        var options = {
          title: 'Bitcoin Quotation',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
