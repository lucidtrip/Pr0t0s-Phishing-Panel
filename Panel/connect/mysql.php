<?php
// #########################
// MYSqlU = MySQl Username
// MYSqlP = MySQL Password
// MYSqlH = MySQl Host (Standart 127.0.0.1)
// MYSqlDBName = MySql Database Name
// #########################
$MYSqlU = "root";
$MYSqlP = "test123";
$MYSqlH = "localhost";
$MYSqlUDBName = "protos";
mysql_connect($MYSqlH, $MYSqlU, $MYSqlP) or die("");
mysql_select_db($MYSqlUDBName) or die("");
?>
