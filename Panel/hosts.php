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

<h2>Hosts
    <div align="right" style="float:right;">
    <?php
        if(isset($_GET['p'])){
            echo '<a href="hosts.php?p=' . $_GET['p'] . '">';
        }
        else{
            echo '<a href="hosts.php">';
        }
    ?>
    <img src="img/other/refresh.png"></a></div>
</h2>

<form action="hosts.php" method="post" name="boxen">
<table id="table" style="width:100%">
  <tr>
    <th class="table" style="color: black;width:5px;">Icon</th>
    <th class="table" id="groesser" style="width:200px;" >Host Name</th>
    <th class="table" id="kleiner">Request ID</th>
    <th class="table" id="kleiner">L&ouml;schen</th>
  </tr>
<?php
    $query = mysql_query("SELECT COUNT(*) FROM remotehosts");
    $item_count = mysql_result($query, 0);
    $nav = new PageNavigation($item_count, $pagecount);
    $query = mysql_query("SELECT * FROM remotehosts ORDER BY 'HostID' DESC LIMIT " . $nav->sql_limit);
    $item_number = $nav->first_item_id;
    // list Host
    while($row = mysql_fetch_array($query)) {
        echo '<tr>';
        echo '<td class="td" style="color: black;width:5px;"><img style="margin-bottom:-3px;margin-left:+6px;height:16px;width:16px;" src="img/pictures/'.$row['HostPicture'].'"></td>
                    <td class="td" style="color: black;">'.$row['HostName'].'</td>
                    <td class="td" style="color: black;"  id="kleiner">'.$row['HostID'].'</td>
                    <td class="td" id="kleiner" style="color: black;"><input type="checkbox" name="dele[]" value="'.$row['HostID'].'" /></td>';
                    //<th class="table" style="text-align: center;"><a href="logs.php?delid='.$row[id].'"><img src="img/other/del.png" style="border: none;" /></a></th>
        echo "</tr>";
    }
?>
</table>
<p align="right"><input type="submit" class="button" name="del" value="Delete selected Hosts" />&nbsp;<a href="hosts.php?delall1=ja"></a><input type="Checkbox" name="alle" onClick="AlleBoxen(this.form);" value="alle">Select all &nbsp;</p>
</form>


<?php
    // add Host
    echo "<h2>add new Host</h2>";
    echo '<form action="hosts.php" method="post" name="add_new_host">';
    echo '<table>';
    echo "<tr>\n"; 
    echo "	<th class=\"table\" style=\"color: black;width:5px;\">Icon</th>\n"; 
    echo "	<th class=\"table\" id=\"groesser\" style=\"width:200px;\" >Host Name</th>\n"; 
    echo "	<th class=\"table\" id=\"kleiner\">add</th>\n"; 
    echo "</tr>\n";
    echo "<tr>\n"; 
    echo '<td class="td" style="border:none;" >';
    echo '<select size="1" class="tb" name="AddIcon">';
    $dir = scandir( "img/pictures/" );
    sort($dir);
    foreach( $dir as $img ) {
        if ($img != "." && $img != "..") {
            echo '<option>' . $img . '</option>';
        }
    }
    echo "</select>\n</td>\n";
    echo '<td class="td" style="border:none;"><input type="text" style="width:205px;" class="tb" name="AddURL"></td>';
    echo '<td class="td" style="border:none;" id="kleiner" ><input type="image" src="img/other/add.png" style="cursor: pointer;border: none;background-color:#ffffff;" value="Search" class="button" name="confirm"></td>';
    echo "</tr>\n"; 
    echo '</table>';
    echo '</form>';
?>


<?php
    // del select item
	if(isset($_POST['del'])){
		for ($i=0; $i<count($_POST["dele"]); $i++) {
			$wegdamit = $_POST['dele'][$i];
			mysql_query("DELETE FROM `remotehosts` WHERE `remotehosts`.`HostID` = " . $wegdamit);
		}
		
		echo '<script>alert(unescape("'.$i.' Hosts successfully deleted!"));</script>
			  <meta http-equiv="refresh" content="0; URL=hosts.php">';
	}
    // add new item
	if(isset($_POST['AddIcon'])){
        $IconLink = $_POST['AddIcon'];
        $URLHttp = $_POST['AddURL'];
        if($IconLink!="" and $URLHttp!=""){
            mysql_query("INSERT INTO `remotehosts`(`HostName`, `HostPicture`) VALUES ('" . $URLHttp . "', '" . $IconLink . "')");
        }
		echo '<meta http-equiv="refresh" content="0; URL=hosts.php">';
	}
	echo '<div style="float: right;">'.$nav->createPageBar().'</div><br />';
	require_once('inc/footer.php'); 
?>
