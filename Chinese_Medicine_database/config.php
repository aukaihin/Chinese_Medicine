<?php
$db = mysql_connect("127.0.0.1:3306", "root", "pass");

if (!$db) {
	die('Could not connect' . mysql_error());
}
mysql_query("SET NAMES 'gb2312'");
mysql_query("SET CHARACTER SET gb2312");
mysql_query("SET COLLATION_CONNECTION = 'gb2312_chinese_ci'");
$db_selected = mysql_select_db('Chinese_Medicine', $db);
date_default_timezone_set('Asia/Hong_Kong');

?>