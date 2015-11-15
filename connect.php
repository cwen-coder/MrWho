<?php
$sqladdress = 'localhost';
$sqlname = 'root';
$sqlpassword = 'yin123';
$con = mysql_connect($sqladdress,$sqlname,$sqlpassword) or die("数据库链接错误".mysql_error());  
mysql_select_db("MrWho",$con) or die("数据库访问错误".mysql_error());  
mysql_query("set names utf8");
?>