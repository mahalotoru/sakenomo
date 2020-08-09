<html lang="ja">
<head>
<link rel="stylesheet" type="text/css" href="cgi.drinksake.org/sakagura/css/header.css" />
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<body>
<?php

require_once("db_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

$sql = "SELECT * FROM SAKAGURA_J";
$res = executequery($db, $sql);
$newaddress = "";

while($row = getnextrow($res)) 
{
	$sakagura_id = $row["id"];
	$in_time = time();

	$stmt = "UPDATE SAKAGURA_J SET LastContacted = '".$in_time ."' where id	='" .$sakagura_id ."'";
	$ret = executequery($db, $stmt);
	print($in_time ."<br>");
}

print("done" ."<br>");

?>

</body>
</html>
