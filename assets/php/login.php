<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

mysql_select_db("library_manage_system", $connect);

$user = $_POST["user"];
$password = $_POST["password"];

$database_query = "SELECT manager_name, password FROM manager WHERE manager_name = '" . $user . "' and password =  '" . $password . "'";
$result = mysql_query($database_query);

if ($row = mysql_fetch_array($result))
{
	$item = array('status'=>'success');
	$info = json_encode($item);
	echo $info;
}
else
{
	$item = array('status'=>'error');
	$info = json_encode($item);
	echo $info;
}
?>
