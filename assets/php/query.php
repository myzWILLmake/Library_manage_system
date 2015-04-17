<?php
$connect = mysql_connect("localhost","root","root");
if (!$connect)
	{
		die('Error!Cannot connect:' . mysql_error());
	}

$category = $_POST["category"];
$bookname = $_POST["bookname"];
$publish = $_POST["publish"];
$year_begin = (int)$_POST["year_begin"];
$year_end = (int)$_POST["year_end"];
$author = $_POST["author"];
$price_begin = (float)$_POST["price_begin"];
$price_end = (float)$_POST["price_end"];

mysql_select_db("library_manage_system", $connect);

$database_query = "SELECT * FROM book WHERE 1";
if ($category != "") $database_query .= " and category = " . "'" . $category . "'";
if ($bookname != "") $database_query .= " and book_name = " . "'" . $bookname . "'";
if ($publish != "") $database_query .= " and publish = " . "'" . $publish . "'" ;
if ($year_begin != 0) $database_query .= " and year >= " . "'" . $year_begin . "'";
if ($year_end != 0) $database_query .= " and year <= " . "'" . $year_end . "'";
if ($author != "") $database_query .= " and author = " . "'" . $author . "'";
if ($price_begin != 0) $database_query .= " and price >= " . "'" . $price_begin . "'";
if ($price_end != 0) $database_query .= " and price <= " . "'" . $price_end . "'";

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
