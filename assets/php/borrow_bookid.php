<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}
$bookid = $_POST["bookid"];
$cardid = $_POST["cardid"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT amounts FROM book WHERE book_id = " . $bookid;
$result = mysql_query($database_query);
$row = mysql_fetch_array($result);

$not_borrow = 1;
$database_query = "SELECT book_id FROM record WHERE card_id = " . $cardid . " and date_end = 0";
$result = mysql_query($database_query);
while ($item = mysql_fetch_array($result))
	if ($item["book_id"]==$bookid) $not_borrow = 0;	

if ($row["amounts"] == 0)
{
	$item = array('status'=>'error0');
	$info = json_encode($item);
	echo $info;
}
elseif ($not_borrow == 0)
{
	$item = array('status'=>'error1');
	$info = json_encode($item);
	echo $info;
}
else
{
	$database_update = "UPDATE book SET amounts = amounts - 1 WHERE book_id = " . $bookid;

	mysql_query($database_update);

	$date_now = date("Y-m-d");
	$database_insert = "INSERT INTO record values( " . $bookid . ", " . $cardid . ", " . "'" . $date_now . "', '', " . 1 . ")";

	mysql_query($database_insert);
	$item = array('status'=>'success');
	$info = json_encode($item);
	echo $info;
}
?>
