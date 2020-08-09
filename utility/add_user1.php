<?php

require_once("db_functions.php");

$pref_array = array(
	array("北海道", "北海道地方"),
	array("青森県", "東北地方"),
	array("岩手県", "東北地方"),
	array("宮城県", "東北地方"),
	array("秋田県", "東北地方"),
	array("山形県", "東北地方"),
	array("福島県", "東北地方"),
	array("茨城県", "東北地方"),
	array("栃木県", "関東地方"),
	array("群馬県", "関東地方"),
	array("埼玉県", "関東地方"),
	array("千葉県", "関東地方"),
	array("東京都", "関東地方"),
	array("神奈川県", "関東地方"),
	array("新潟県", "中部地方"),
	array("富山県", "中部地方"),
	array("石川県", "中部地方"),
	array("福井県", "中部地方"),
	array("山梨県", "中部地方"),
	array("長野県", "中部地方"),
	array("岐阜県", "中部地方"),
	array("静岡県", "中部地方"),
	array("愛知県", "中部地方"),
	array("三重県", "近畿地方"),
	array("滋賀県", "近畿地方"),
	array("京都府", "近畿地方"),
	array("大阪府", "近畿地方"),
	array("兵庫県", "近畿地方"),
	array("奈良県", "近畿地方"),
	array("和歌山県", "近畿地方"),
	array("鳥取県", "中国地方"),
	array("島根県", "中国地方"),
	array("岡山県", "中国地方"),
	array("広島県", "中国地方"),
	array("山口県", "中国地方"),
	array("徳島県", "四国地方"),
	array("香川県", "四国地方"),
	array("愛媛県", "四国地方"),
	array("高知県", "四国地方"),
	array("福岡県", "九州地方"),
	array("佐賀県", "九州地方"),
	array("長崎県", "九州地方"),
	array("熊本県", "九州地方"),
	array("大分県", "九州地方"),
	array("宮城県", "九州地方"),
	array("鹿児島県", "九州地方"),
	array("沖縄県", "九州地方"));

$length = count($pref_array);

function get_region($pref)
{
	$len = count($pref_array);
	$ret = "";
	$i = 0;

	for($i = 0; $i < $len; $i++)
	{
		if($pref == $pref_array[$i][0])
		{
			$ret = $pref_array[$i][1];
			break;
		}
	}
	
	return $ret;
}

$i = 0;
$url = "";

if(!empty($_POST['url']))
{
	foreach($_POST['url'] as $selected)
	{
		if($url == "")
			$url = $selected;
		else			
			$url .= "," .$selected;
	}	
}

$username = $_POST['username'];
$password = $_POST['password'];
$fname = sqlite3::escapeString($_POST['fname']);
$lname = $_POST['lname'];
$pref = $_POST['pref'];
$region_name = get_region($pref);
$phone = $_POST['phone'];
$email = $_POST['email'];
$fax = $_POST['fax'];
$postal_code = $_POST['postal_code'];
$memo = sqlite3::escapeString($_POST['memo']);

if(!$db = opendatabase("sake.db"))
{
	die("データベース接続エラー.<br />");
}

$sql = "INSERT INTO USERS_J(username, 
		                        password, 
		                        fname, 
		                        lname, 
		                        pref, 
								region,
		                        phone, 
		                        fax, 
		                        email, 
								url,
		                        postal_code, 
		                        address, 
		                        phone, 
		                        fax, 
		                        url, 
		                        memo) VALUES(
                                '$username', 
                                '$password', 
                                '$fname', 
                                '$lname', 
                                '$pref', 
                                '$region', 
                                '$phone', 
                                '$fax', 
                                '$email', 
                                '$url', 
                                '$postal_code', 
                                '$address', 
                                '$phone', 
                                '$fax', 
                                '$url', 
                                '$memo')";

$res = executequery($db, $sql);

if(!$res)   
{
    $return = "failed1:".$sql;
	
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
    echo '<username>'.$username.'</username>'."\n";
    echo '</xml>'."\n";
}

?>
