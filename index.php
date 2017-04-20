<!DOCTYPE html>

<html>
<head>
  <link class="include" rel="stylesheet" type="text/css" href="./jqplot/jquery.jqplot.min.css" />
  <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>


<!-- Example scripts go here -->



<?php
  $data = file('./data/battery.log');
  $point = array();
  foreach($data as $line)
  {
    $a = explode(',', $line);
    $point[] = '[\'' . trim($a[0]) . '\',' . trim($a[2]) . ']';
  }
  $str_point = '[' . implode(',', $point) . ']';
?>

<div id="chart-battery" style="height:300px; width:500px; margin-bottom: 30px;"></div>
marker <input type="checkbox" id="switch-marker"/>

<script class="code" type="text/javascript">
$(document).ready(function() {
  var point = [<?=$str_point?>];
  var options = {
    seriesDefaults: {
      showMarker: false,
      rendererOptions: {
        smooth: true
      }
    },
    axes:{
      xaxis:{
        renderer: $.jqplot.DateAxisRenderer
      },
      yaxis: {
        min: 0,
        max: 8000,
      }
    },
  }
  var plot = $.jqplot('chart-battery', point, options);

  $('#switch-marker').change(function() {
    if($(this).is(":checked"))
    {
      options.seriesDefaults.showMarker = true;
    }
    else
    {
      options.seriesDefaults.showMarker = false;
    }
    $('#chart-battery').empty();
    plot = $.jqplot('chart-battery', point, options);
  });
});
</script>


  <script class="include" type="text/javascript" src="./jqplot/jquery.jqplot.min.js"></script>

  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.DateAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.canvasTextRenderer.js"></script>
  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.canvasAxisLabelRenderer.js"></script>

</body>


</html>

