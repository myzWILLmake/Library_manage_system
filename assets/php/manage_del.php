<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

$cardid = $_POST["cardid"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT card_id FROM card WHERE card_id = " . $cardid;
$result = mysql_query($database_query);
if ($row = mysql_fetch_array($result))
{
	$database_delete = "DELETE FROM card WHERE card_id = " . $cardid;
	mysql_query($database_delete);
	
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