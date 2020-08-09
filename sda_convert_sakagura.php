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

if(!$db = opendatabase("sake2.db"))
{
   die("データベース接続エラー .<br>");
}

$sql = "SELECT * FROM SAKAGURA_J";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
	$id = $row["id"];
	
	//$row["id"] = mb_convert_encoding($row["id"], "SJIS", "UTF-8");
	//$row["rank"] = mb_convert_encoding($row["rank"], "SJIS", "UTF-8");
	
	$row["country"] = mb_convert_encoding($row["country"], "SJIS", "UTF-8");
	$row["region_name"] = mb_convert_encoding($row["region_name"], "SJIS", "UTF-8");
	$row["pref"] = mb_convert_encoding($row["pref"], "SJIS", "UTF-8");
	$row["pref_read"] = mb_convert_encoding($row["pref_read"], "SJIS", "UTF-8");

	$row["sakagura_name"] = mb_convert_encoding($row["sakagura_name"], "SJIS", "UTF-8");
	$row["sakagura_search"] = mb_convert_encoding($row["sakagura_search"], "SJIS", "UTF-8");
	$row["sakagura_read"] = mb_convert_encoding($row["sakagura_read"], "SJIS", "UTF-8");
	$row["sakagura_intro"] = mb_convert_encoding($row["sakagura_intro"], "SJIS", "UTF-8");
	$row["postal_code"] = mb_convert_encoding($row["postal_code"], "SJIS", "UTF-8");
	$row["address"] = mb_convert_encoding($row["address"], "SJIS", "UTF-8");
	
	//$row["sakagura"] = mb_convert_encoding($row["sakagura"], "SJIS", "UTF-8");
	//$row["phone"] = mb_convert_encoding($row["phone"], "SJIS", "UTF-8");
	//$row["fax"] = mb_convert_encoding($row["fax"], "SJIS", "UTF-8");
	//$row["url"] = mb_convert_encoding($row["url"], "SJIS", "UTF-8");
	//$row["email"] = mb_convert_encoding($row["email"], "SJIS", "UTF-8");
	
	$row["brand"] = mb_convert_encoding($row["brand"], "SJIS", "UTF-8");
	$row["representative"] = mb_convert_encoding($row["representative"], "SJIS", "UTF-8");
	$row["touji"] = mb_convert_encoding($row["touji"], "SJIS", "UTF-8");
	$row["establishment"] = mb_convert_encoding($row["establishment"], "SJIS", "UTF-8");
	$row["award_history"] = mb_convert_encoding($row["award_history"], "SJIS", "UTF-8");
	$row["observation"] = mb_convert_encoding($row["observation"], "SJIS", "UTF-8");
	$row["observation_info"] = mb_convert_encoding($row["observation_info"], "SJIS", "UTF-8");
	$row["direct_sale"] = mb_convert_encoding($row["direct_sale"], "SJIS", "UTF-8");
	$row["payment_method"] = mb_convert_encoding($row["payment_method"], "SJIS", "UTF-8");
	$row["memo"] = mb_convert_encoding($row["memo"], "SJIS", "UTF-8");
	$row["data_source"] = mb_convert_encoding($row["data_source"], "SJIS", "UTF-8");
	$row["LastContacted"] = mb_convert_encoding($row["LastContacted"], "SJIS", "UTF-8");

	$stmt = "UPDATE SAKAGURA_J SET   rank           = '".$row["rank"]
							."', country			= '".$row["country"]
							."', region_name		= '".$row["region_name"]
							."', pref				= '".$row["pref"]
							."', pref_read			= '".$row["pref_read"]
							."', sakagura_name		= '".$row["sakagura_name"]
							."', sakagura_search	= '".$row["sakagura_search"]
							."', sakagura_read		= '".$row["sakagura_read"]
							."', sakagura_intro		= '".$row["sakagura_intro"]
							."', postal_code		= '".$row["postal_code"]
							."', address			= '".$row["address"]
							."', phone				= '".$row["phone"]
							."', fax				= '".$row["fax"]
							."', url				= '".$row["url"]
							."', email				= '".$row["email"]
							."', brand				= '".$row["brand"]
							."', representative		= '".$row["representative"]
							."', touji				= '".$row["touji"]
							."', establishment		= '".$row["establishment"]
							."', award_history		= '".$row["award_history"]
							."', observation		= '".$row["observation"]
							."', observatory_info	= '".$row["observatory_info"]
							."', direct_sale		= '".$row["direct_sale"]
							."', payment_method		= '".$row["payment_method"]
							."', memo				= '".$row["memo"]
							."', data_source		= '".$row["data_source"]
							."', LastContacted		= '".$row["LastContacted"] 
							."' where		id		='" .$id ."'";


	$ret = executequery($db, $stmt);
	 
	if(!$ret)
		print("更新できませんでした");
}

print("終了しました");
?>

</body>
</html>
