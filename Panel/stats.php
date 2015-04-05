<?php


session_start();

	require_once('inc/session.php');
	require_once('inc/header.php');
?>

<script language="javascript">
$(document).ready(function() {
    $('a[rel*=facebox]').facebox();
})
</script>

<h2>Statistics</h2>

<br>

<a href="facebox/allstats.php" rel="facebox">
	<img src="img/other/stats1.png" style="margin-left: 55px; border: none;"></a><br />
<p style="margin-left: 51px;">Countrys</p>

<div style="margin-top: -103px; margin-left: 100px;">
	<a href="facebox/other.php" rel="facebox"><img src="img/other/stats3.png" style="margin-left: 53px; border: none;"></a>
	<p style="margin-left: 45px;"> Phishing Statistics</p>
</div>

<?php require_once('inc/footer.php');