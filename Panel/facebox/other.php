<?php
session_start();
require_once('../inc/session.php');
require_once('../inc/config.php');
require_once('../connect/mysql.php');
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
	
<script type="text/javascript">
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container',
         defaultSeriesType: 'bar'
      },
      title: {
         text: 'Phishing Statistics'
      },
      subtitle: {
         text: ''
      },
      xAxis: {
         categories: ['Logs:','IPs:', 'Users:', 'Passwords:', 'Days:'],
         title: {
            text: null
         }
      },
      yAxis: {
         min: 0,
         title: {
            text: 'Logs',
            align: 'high'
         }
      },
      tooltip: {
         formatter: function() {
            return ''+
                this.y +' Logs';
         }
      },
      plotOptions: {
         bar: {
            dataLabels: {
               enabled: true
            }
         }
      },
      legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'top',
         x: -100,
         y: 100,
         borderWidth: 1,
         backgroundColor: '#FFFFFF'
      },
      credits: {
         enabled: false
      },
         series: [{
         name: 'Logs',
         data: [<?php echo get_logs(); ?>, <?php echo get_anzahl('IPAdress'); ?>, <?php echo get_anzahl('Username'); ?>, <?php echo get_anzahl('Password'); ?>, <?php echo get_anzahl('Datum'); ?>]
      }]
   });
});
</script>

<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>

<?php
function get_anzahl($was){
  $InfoDB = mysql_query("SELECT DISTINCT('". $was ."') FROM `maintable`");
  $count  = mysql_num_rows($InfoDB);
  return $count;
}

function get_logs(){
	$logs 	    = mysql_query("SELECT * FROM `maintable`");
	$logs_count = mysql_num_rows($logs);
	
	return $logs_count;
}
?>