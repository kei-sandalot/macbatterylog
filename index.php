<!DOCTYPE html>

<html>
<head>
  <link class="include" rel="stylesheet" type="text/css" href="./jqplot/jquery.jqplot.min.css" />
  <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>



<div id="chart-battery" style="height:300px; width:500px; margin-bottom: 30px;"></div>
marker <input type="checkbox" id="switch-marker"/>



  <script class="include" type="text/javascript" src="./jqplot/jquery.jqplot.min.js"></script>

  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.DateAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.canvasTextRenderer.js"></script>
  <script class="include" type="text/javascript" src="./jqplot/plugins/jqplot.canvasAxisLabelRenderer.js"></script>



<script type="text/javascript">
$(document).ready(function() {
  var point = [];
  var plot = null;

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

  var draw_chart = function(chart_data) {
    point = [chart_data];
    plot = $.jqplot('chart-battery', point, options);
  };

  $.ajax({
    url: './data/battery.log',
    success: function(data) {
      var chart_data = [];
      var row = data.split(/\r\n|\r|\n/);
      row.forEach(function(val) {
        var col = val.split(',');
        chart_data.push([col[0], col[2]]);
      });

      draw_chart(chart_data);
    },
    error: function(a, b, c) {
      console.log(a, b, c);
    }
  });

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



</body>
</html>
