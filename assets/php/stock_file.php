<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

mysql_select_db("library_manage_system", $connect);

$myfile = fopen("book_stock.txt","r") or die("Unable to open file!");
$database_insert = fread($myfile, filesize("book_stock.txt"));
fclose($myfile);

if (mysql_query($database_insert))
{
	$item = array('status' => 'success');
	$info = json_encode($item);
	echo $info;
}
else 
{
	$item = array('status' => 'error');
	$info = json_encode($item);
	echo $info;
}
?>
