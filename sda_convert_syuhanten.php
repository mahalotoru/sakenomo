<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>文字列変換</title>
</head>

文字列変換<br>

<?php
require_once("db_functions.php");

if(!$db = opendatabase("sake2.db"))
{
   die("データベース接続エラー .<br>");
}

$sql = "SELECT * FROM SYUHANTEN_J";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
	$syuhanten_id = $row["syuhanten_id"];
	
	//$row["syuhanten_id"] = mb_convert_encoding($row["syuhanten_id"], "SJIS", "UTF-8");
	//$row["syuhanten"] = mb_convert_encoding($row["syuhanten"], "SJIS", "UTF-8");
	$row["syuhanten_rank"] = mb_convert_encoding($row["syuhanten_rank"], "SJIS", "UTF-8");
	$row["syuhanten_type"] = mb_convert_encoding($row["syuhanten_type"], "SJIS", "UTF-8");
	
	$row["syuhanten_name"] = mb_convert_encoding($row["syuhanten_name"], "SJIS", "UTF-8");
	$row["syuhanten_search"] = mb_convert_encoding($row["syuhanten_search"], "SJIS", "UTF-8");
	$row["syuhanten_read"] = mb_convert_encoding($row["syuhanten_read"], "SJIS", "UTF-8");
	$row["syuhanten_sort"] = mb_convert_encoding($row["syuhanten_sort"], "SJIS", "UTF-8");
	$row["syuhanten_intro"] = mb_convert_encoding($row["syuhanten_intro"], "SJIS", "UTF-8");
	$row["syuhanten_country"] = mb_convert_encoding($row["syuhanten_country"], "SJIS", "UTF-8");
	$row["syuhanten_region"] = mb_convert_encoding($row["syuhanten_region"], "SJIS", "UTF-8");
	$row["syuhanten_pref"] = mb_convert_encoding($row["syuhanten_pref"], "SJIS", "UTF-8");
	$row["syuhanten_pref_read"] = mb_convert_encoding($row["syuhanten_pref_read"], "SJIS", "UTF-8");

	//$row["syuhanten_postal_code"] = mb_convert_encoding($row["syuhanten_postal_code"], "SJIS", "UTF-8");
	$row["syuhanten_address"] = mb_convert_encoding($row["syuhanten_address"], "SJIS", "UTF-8");

	//$row["syuhanten_phone"] = mb_convert_encoding($row["syuhanten_phone"], "SJIS", "UTF-8");
	//$row["syuhanten_fax"] = mb_convert_encoding($row["syuhanten_fax"], "SJIS", "UTF-8");
	//$row["syuhanten_url"] = mb_convert_encoding($row["syuhanten_url"], "SJIS", "UTF-8");
	//$row["syuhanten_email"] = mb_convert_encoding($row["syuhanten_email"], "SJIS", "UTF-8");

	$row["syuhanten_hours"] = mb_convert_encoding($row["syuhanten_hours"], "SJIS", "UTF-8");
	$row["syuhanten_closed"] = mb_convert_encoding($row["syuhanten_closed"], "SJIS", "UTF-8");
	$row["syuhanten_parking"] = mb_convert_encoding($row["syuhanten_parking"], "SJIS", "UTF-8");
	$row["syuhanten_sake"] = mb_convert_encoding($row["syuhanten_sake"], "SJIS", "UTF-8");
	$row["syuhanten_memo"] = mb_convert_encoding($row["syuhanten_memo"], "SJIS", "UTF-8");
	$row["syuhanten_datasource"] = mb_convert_encoding($row["syuhanten_datasource"], "SJIS", "UTF-8");
	$row["syuhanten_lastcontacted"] = mb_convert_encoding($row["syuhanten_lastcontacted"], "SJIS", "UTF-8");
	
	$stmt = "UPDATE SYUHANTEN_J SET  syuhanten_name			= '".$row["syuhanten_name"]
								."', syuhanten_search		= '".$row["syuhanten_search"]
								."', syuhanten_read			= '".$row["syuhanten_read"]
								."', syuhanten_sort			= '".$row["syuhanten_sort"]
								."', syuhanten_intro		= '".$row["syuhanten_intro"]
								."', syuhanten_rank			= '".$row["syuhanten_rank"]
								."', syuhanten_type			= '".$row["syuhanten_type"]
								."', syuhanten_country		= '".$row["syuhanten_country"]
								."', syuhanten_region		= '".$row["syuhanten_region"]
								."', syuhanten_pref			= '".$row["syuhanten_pref"]
								."', syuhanten_pref_read	= '".$row["syuhanten_pref_read"]
								."', syuhanten_address		= '".$row["syuhanten_address"]
								."', syuhanten_hours		= '".$row["syuhanten_hours"]
								."', syuhanten_closed		= '".$row["syuhanten_closed"]
								."', syuhanten_parking		= '".$row["syuhanten_parking"]
								."', syuhanten_sake			= '".$row["syuhanten_sake"]
								."', syuhanten_memo			= '".$row["syuhanten_memo"]
								."', syuhanten_datasource	= '".$row["syuhanten_datasource"]
								."', syuhanten_lastcontacted	= '".$row["syuhanten_lastcontacted"]
								."' where		syuhanten_id	='" .$syuhanten_id ."'";

	//print($stmt);
	$ret = executequery($db, $stmt);
	 
	if(!$ret)
		print("\n更新できませんでした:".$i);
}

print("\n終了しました");
?>

</body>
</html>
