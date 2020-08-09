<?php

require_once("db_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

$updir = "./upload/";
$filename = $_FILES['upfile']['name'];

if(move_uploaded_file($_FILES['upfile']['tmp_name'], $updir.$filename) == FALSE)
{
	$return = "failed";
	
	header("Content-type: application/xml");
	echo '<?xml version="1.0" encoding="utf-8" ?> ' . "\n";
	echo '<xml>'."\n";
	echo '<str>'.$return.'</str>'."\n";
	echo '</xml>'."\n";
}
else 
{
	$return = "success";

	header("Content-type: application/xml");
	echo '<?xml version="1.0" encoding="utf-8" ?> ' . "\n";
	echo '<xml>'."\n";
	echo '<str>'.$return.'</str>'."\n";
	echo '<sake_id>'.$sequence.'</sake_id>'."\n";
	echo '</xml>'."\n";
}
?>
