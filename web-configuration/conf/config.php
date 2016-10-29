<!-- By D.J. Murray (apie), 2016-10-27 -->
<?php
// connect to db
$host='';
$user='';
$passwd='';
$db='';
$c_config_id=1;
$mysqli = mysqli_connect($host, $user, $passwd, $db);
if (!$mysqli) {
    die('Not connected : ' . mysql_error());
}

?>
