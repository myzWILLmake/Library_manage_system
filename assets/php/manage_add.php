<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

$name = $_POST["name"];
$department = $_POST["department"];
$property = $_POST["property"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT MAX(card_id) AS card_id FROM card";
$result = mysql_query($database_query);
$row = mysql_fetch_array($result);

$cardid = $row["card_id"] + 1;

$database_insert = "INSERT INTO card VALUES (" . $cardid . ", '" . $name . "', '" . $department . "', '" . $property . "')";
mysql_query($database_insert);

$item = array(
	'cardid' => $cardid,
	'status' => 'success'
	);
$info = json_encode($item);
echo $info;
?>
