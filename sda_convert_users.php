<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>文字列変換</title>
</head>
<p>文字列変換</p><br>

<?php
require_once("db_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br>");
}

$sql = "SELECT * FROM USERS_J";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
	$username = $row["username"];
	$row["password"] = mb_convert_encoding($row["password"], "SJIS", "UTF-8");
	$row["usertype"] = mb_convert_encoding($row["usertype"], "SJIS", "UTF-8");
	$row["fname"] = mb_convert_encoding($row["fname"], "SJIS", "UTF-8");
	$row["minit"] = mb_convert_encoding($row["minit"], "SJIS", "UTF-8");
	$row["lname"] = mb_convert_encoding($row["lname"], "SJIS", "UTF-8");
	$row["sex"] = mb_convert_encoding($row["sex"], "SJIS", "UTF-8");
	$row["bdate"] = mb_convert_encoding($row["bdate"], "SJIS", "UTF-8");
	$row["email"] = mb_convert_encoding($row["email"], "SJIS", "UTF-8");
	$row["phone"] = mb_convert_encoding($row["phone"], "SJIS", "UTF-8");
	$row["country"] = mb_convert_encoding($row["country"], "SJIS", "UTF-8");
	$row["region"] = mb_convert_encoding($row["region"], "SJIS", "UTF-8");
	$row["pref"] = mb_convert_encoding($row["pref"], "SJIS", "UTF-8");
	$row["address"] = mb_convert_encoding($row["address"], "SJIS", "UTF-8");
	$row["address_read"] = mb_convert_encoding($row["address_read"], "SJIS", "UTF-8");
	$row["postal_code"] = mb_convert_encoding($row["postal_code"], "SJIS", "UTF-8");
	
	$stmt = "UPDATE USERS_J SET  username               = '".$row["username"]
								."', password			= '".$row["password"]
								."', usertype			= '".$row["usertype"]
								."', fname				= '".$row["fname"]
								."', minit				= '".$row["minit"]
								."', lname				= '".$row["lname"]
								."', sex				= '".$row["sex"]
								."', bdate				= '".$row["bdate"]
								."', email				= '".$row["email"]
								."', phone				= '".$row["phone"]
								."', country			= '".$row["country"]
								."', region				= '".$row["region"]
								."', pref				= '".$row["pref"]
								."', address			= '".$row["address"]
								."', address_read		= '".$row["address_read"]
								."', postal_code		= '".$row["postal_code"]
								."' where		username		='" .$username ."'";

	$ret = executequery($db, $stmt);
	 
	if(!$ret)
		print("更新できませんでした");
}

print("終了しました");

?>
</body>
</html>
