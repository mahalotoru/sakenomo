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

$sql = "SELECT * FROM SAKE_J";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
	$sake_id = $row["sake_id"];
	
	//$row["sake_id"] = mb_convert_encoding($row["sake_id"], "SJIS", "UTF-8");
	
	$row["sake_name"] = mb_convert_encoding($row["sake_name"], "SJIS", "UTF-8");
	$row["sake_search"] = mb_convert_encoding($row["sake_search"], "SJIS", "UTF-8");
	$row["sake_read"] = mb_convert_encoding($row["sake_read"], "SJIS", "UTF-8");
	
	//$row["sake_english"] = mb_convert_encoding($row["sake_english"], "SJIS", "UTF-8");
	//$row["sakagura_id"] = mb_convert_encoding($row["sakagura_id"], "SJIS", "UTF-8");
	//$row["sake_rank"] = mb_convert_encoding($row["sake_rank"], "SJIS", "UTF-8");
	
	$row["definition"] = mb_convert_encoding($row["definition"], "SJIS", "UTF-8");
	$row["special_name"] = mb_convert_encoding($row["special_name"], "SJIS", "UTF-8");
	$row["sake_category"] = mb_convert_encoding($row["sake_category"], "SJIS", "UTF-8");
	$row["sake_category3"] = mb_convert_encoding($row["sake_category3"], "SJIS", "UTF-8");
	
	//$row["volume_720"] = mb_convert_encoding($row["volume_720 "], "SJIS", "UTF-8");
	//$row["volume_1800"] = mb_convert_encoding($row["volume_1800"], "SJIS", "UTF-8");
	//$row["volume_other"] = mb_convert_encoding($row["volume_other"], "SJIS", "UTF-8");
	//$row["price_720"] = mb_convert_encoding($row["price_720"], "SJIS", "UTF-8");
	//$row["price_1800"] = mb_convert_encoding($row["price_1800"], "SJIS", "UTF-8");
	//$row["price_other"] = mb_convert_encoding($row["price_other"], "SJIS", "UTF-8");
	
	$row["ingredients"] = mb_convert_encoding($row["ingredients"], "SJIS", "UTF-8");
	
	//$row["seimai_rate"] = mb_convert_encoding($row["seimai_rate"], "SJIS", "UTF-8");
	//$row["alcohol_level"] = mb_convert_encoding($row["alcohol_level"], "SJIS", "UTF-8");
	
	$row["rice_used"] = mb_convert_encoding($row["rice_used"], "SJIS", "UTF-8");
	
	//$row["jsake_level"] = mb_convert_encoding($row["jsake_level"], "SJIS", "UTF-8");
	//$row["oxidation_level"] = mb_convert_encoding($row["oxidation_level"], "SJIS", "UTF-8");
	//$row["amino_level"] = mb_convert_encoding($row["amino_level"], "SJIS", "UTF-8");
	
	$row["koubo_used"] = mb_convert_encoding($row["koubo_used"], "SJIS", "UTF-8");
	$row["syubo"] = mb_convert_encoding($row["syubo"], "SJIS", "UTF-8");
	$row["kasu_level"] = mb_convert_encoding($row["kasu_level"], "SJIS", "UTF-8");
	$row["water_used"] = mb_convert_encoding($row["water_used"], "SJIS", "UTF-8");
	$row["year_made"] = mb_convert_encoding($row["year_made"], "SJIS", "UTF-8");
	$row["sake_type"] = mb_convert_encoding($row["sake_type"], "SJIS", "UTF-8");
	$row["taste"] = mb_convert_encoding($row["taste"], "SJIS", "UTF-8");
	$row["smell"] = mb_convert_encoding($row["smell"], "SJIS", "UTF-8");
	$row["feature"] = mb_convert_encoding($row["feature"], "SJIS", "UTF-8");
	$row["recommended_drink"] = mb_convert_encoding($row["recommended_drink"], "SJIS", "UTF-8");
	$row["recommended_cook"] = mb_convert_encoding($row["recommended_cook"], "SJIS", "UTF-8");
	$row["sake_award_history"] = mb_convert_encoding($row["sake_award_history"], "SJIS", "UTF-8");
	$row["sake_memo"] = mb_convert_encoding($row["sake_memo"], "SJIS", "UTF-8");
	
	$stmt = "UPDATE SAKE_J SET   sake_name              = '".$row["sake_name"]
								."', sake_search		= '".$row["sake_search"]
								."', sake_read			= '".$row["sake_read"]
								."', definition			= '".$row["definition"]
								."', special_name		= '".$row["special_name"]
								."', sake_category		= '".$row["sake_category"]
								."', sake_category3		= '".$row["sake_category3"]
								."', ingredients		= '".$row["ingredients"]
								."', rice_used			= '".$row["rice_used"]
								."', koubo_used			= '".$row["koubo_used"]
								."', syubo				= '".$row["syubo"]
								."', kasu_level			= '".$row["kasu_level"]
								."', water_used			= '".$row["water_used"]
								."', year_made			= '".$row["year_made"]
								."', sake_type			= '".$row["sake_type"]
								."', taste				= '".$row["taste"]
								."', smell				= '".$row["smell"]
								."', feature			= '".$row["feature"]
								."', recommended_drink	= '".$row["recommended_drink"]
								."', recommended_cook	= '".$row["recommended_cook"]
								."', sake_award_history	= '".$row["sake_award_history"]
								."', sake_memo			= '".$row["sake_memo"]
								."' where		sake_id		='" .$sake_id ."'";

	$ret = executequery($db, $stmt);
	 
	if(!$ret)
		print("更新できませんでした");
}

print("終了しました");

?>
</body>
</html>
