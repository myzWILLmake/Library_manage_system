<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

$category = $_POST["category"];
$bookname = $_POST["bookname"];
$publish = $_POST["publish"];
$year = $_POST["year"];
$author = $_POST["author"];
$price= $_POST["price"];
$amounts_max = $_POST["amounts_max"];
$amounts = $_POST["amounts"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT MAX(book_id) AS book_id FROM book";
$result = mysql_query($database_query);
if ($row = mysql_fetch_array($result))
{
	$bookid = $row["book_id"] + 1;
	$database_insert = "INSERT INTO book VALUES(" . $bookid .", '" . $category . "', '" . $bookname . "', '" . $publish . "', " . $year . ", '" . $author . "', " . $price . ", " . $amounts_max . ", " . $amounts . ")";
	if (mysql_query($database_insert))
	{
		$item = array(
			'bookid' => $bookid,
			'status' => 'success'
			);
		$info = json_encode($item);
		echo $info;
	}
	else 
	{
		$item = array(
		'bookid' => 0,
		'status' => 'error'
		);
		$info = json_encode($item);
		echo $info;
	}
}
else 
{
	$item = array(
		'bookid' => 0,
		'status' => 'error'
		);
	$info = json_encode($item);
	echo $info;
}
?>
