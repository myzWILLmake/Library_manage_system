<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

$cardid = $_POST["cardid"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT B.book_id, category, book_name, publish, year, author, price, amounts FROM book as B, record as R WHERE ";
$database_query .= "R.card_id = " . "'" . $cardid . "' ";
$database_query .= "and B.book_id = R.book_id";

$result = mysql_query($database_query);

while ($row = mysql_fetch_array($result))
{
	$item = array(
	'bookid' => $row["book_id"],
	'category' => $row["category"],
	'bookname' => $row["book_name"],
	'publish' => $row["publish"],
	'year' => $row["year"],
	'author' => $row["author"],
	'price' => $row["price"],
	'amounts' => $row["amounts"]
	);
	$arr[] = $item;
}

$info = json_encode($arr);
echo $info;
?>
