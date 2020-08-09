<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>酒蔵を更新します</title>
</head>
<style>

#sample1 {
    position: "absolute";
    backgroundColor:	"#000";
    color:				    #ffffff;
    opacity:			    1.0;
    background-color:	#404040;
    border:	5px solid	#404040;
    border-radius:    10px 10px 0 0;
    boxShadow:			  "5px 5px 10px #444";
}

#form {
    font-family: "メイリオ", Arial, Helvetica, sans-serif;
    position: relative;
    top: 0px;
    border:	3px solid	#404040;
    boxShadow:			"5px 5px 10px #444";
}

.add_button {
    border: none;
    background: #a40f0c;
    font-family: "メイリオ", "Myriad Pro", Arial, sans-serif;
    height: 34px;
    width: 120px;
    color: #ffffff;
    text-align: center;
    border-radius: 5px;
    margin:0px 4px 0px 0px;

    /*box-shadow: 0px 3px 1px #2075aa;*/
    -webkit-transition: all 0.15s linear;
    -moz-transition: all 0.15s linear;
    transition: all 0.15s linear;
}

.add_button:hover {
    background: #dec6e6;
    /*box-shadow: 0 3px 1px #237bb2;*/
}

.add_button:active {
    background: #136899;
    /*box-shadow: 0 3px 1px #0f608c;*/
}

#customers {
    font-family: "メイリオ", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 0.9em;
    border: 1px solid #626262;
    padding: 2px 2px 2px 2px;
}

#customers th {
    color: #ffffff;
    background-color: #626262;
}

#customers tr.alt td {
    color: #000000;
    background-color: #e3e3e3;
}

</style>

<!-- The JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<body>
<?php
require_once("db_functions.php");
$id = $_GET['id'];
$sql = "SELECT * FROM SAKAGURA_J WHERE id = '$id'";

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

$res = executequery($db, $sql);
$count_result = sqlite_num_rows($res);
?>

<div id="sample1"　style="font-weight:bold; background:#404040; color:#fff; padding:5px;">酒蔵を更新します</div>
<form id="form" name="form" method="post">
<table id="customers">

<?php
$row = getnextrow($res);

if($row)
{
	print("<tr class=\"alt\">");
	print("<td>酒蔵名</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"sakagura_name\" value= \"".$row["sakagura_name"]."\"></td>");
	print("<td>酒蔵名よみ</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"sakagura_read\" value= \"".$row["sakagura_read"]."\"></td>");
	print("</tr>");

  print("<tr class=\"alt\">");
	print("<td colspan=\"4\">酒蔵の紹介</td>");
	print("</tr>");
  print("<tr>");
	print("<td colspan=\"4\"><textarea id=\"sakagura_intro\" name=\"sakagura_intro\" rows=10 cols=100>".$row["sakagura_intro"]."</textarea></td>");

	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>酒蔵</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"sakagura\" value= \"".$row["sakagura"]."\"></td>");
	print("<td>酒蔵ID</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"sakagura_id\" value= \"".$row["id"]."\"></td>");
	print("</tr>");
	
	print("<tr>");
	print("<td>酒蔵ランク</td>");
	//print("<td><input size=\"48\" type=\"text\" name=\"rank\" value= \"".$row["rank"]."\"></td>");


	//////////////////////////////////////////////////////////////////
	// sakagura rank
	//////////////////////////////////////////////////////////////////
  print("<td colspan=\"1\"><SELECT id=\"rank\" name=\"rank\">");

	if($row["rank"] == "")
		print("<OPTION VALUE=\"0\" SELECTED>0</OPTION>");
	else
		print("<OPTION VALUE=\"0\">0</OPTION>");

	if($row["rank"] == "1")
		print("<OPTION VALUE=\"1\" SELECTED>1</OPTION>");
	else
		print("<OPTION VALUE=\"1\">1</OPTION>");

	if($row["rank"] == "2")
		print("<OPTION VALUE=\"2\" SELECTED>2</OPTION>");
	else
		print("<OPTION VALUE=\"2\">2</OPTION>");

	if($row["rank"] == "3")
		print("<OPTION VALUE=\"3\" SELECTED>3</OPTION>");
	else
		print("<OPTION VALUE=\"3\">3</OPTION>");

	if($row["rank"] == "4")
		print("<OPTION VALUE=\"4\" SELECTED>4</OPTION>");
	else
		print("<OPTION VALUE=\"4\">4</OPTION>");

	if($row["rank"] == "5")
		print("<OPTION VALUE=\"5\" SELECTED>5</OPTION>");
	else
		print("<OPTION VALUE=\"5\">5</OPTION>");

	if($row["rank"] == "6")
		print("<OPTION VALUE=\"6\" SELECTED>6</OPTION>");
	else
		print("<OPTION VALUE=\"6\">6</OPTION>");

	if($row["rank"] == "7")
		print("<OPTION VALUE=\"7\" SELECTED>7</OPTION>");
	else
		print("<OPTION VALUE=\"7\">7</OPTION>");

	if($row["rank"] == "8")
		print("<OPTION VALUE=\"8\" SELECTED>8</OPTION>");
	else
		print("<OPTION VALUE=\"8\">8</OPTION>");

	if($row["rank"] == "9")
		print("<OPTION VALUE=\"9\" SELECTED>9</OPTION>");
	else
		print("<OPTION VALUE=\"9\">9</OPTION>");

	if($row["rank"] == "10")
		print("<OPTION VALUE=\"10\" SELECTED>10</OPTION>");
	else
		print("<OPTION VALUE=\"10\">10</OPTION>");

	print("</SELECT></td>");

	print("<td>代表銘柄</td>");
	print("<td colspan=\"3\"><input size=\"48\" type=\"text\" name=\"brand\" value= \"".$row["brand"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>国名</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"country\" value= \"".$row["country"]."\"></td>");
	
	print("<td>地方名</td>");
	//print("<td><input size=\"48\" type=\"text\" name=\"region_name\" value= \"".$row["region_name"]."\"></td>");
	print("<td><SELECT id=\"region_name\" name=\"region_name\">");

	if($row["region_name"] == "北海道地方")
		print("<OPTION VALUE=\"北海道地方\" SELECTED>北海道地方</OPTION>");
	else
		print("<OPTION VALUE=\"北海道地方\">北海道地方</OPTION>");

	if($row["region_name"] == "東北地方")
		print("<OPTION VALUE=\"東北地方\" SELECTED>東北地方</OPTION>");
	else	
		print("<OPTION VALUE=\"東北地方\">東北地方</OPTION>");

	if($row["region_name"] == "関東地方")
		print("<OPTION VALUE=\"関東地方\" SELECTED>関東地方</OPTION>");
	else
		print("<OPTION VALUE=\"関東地方\">関東地方</OPTION>");

	if($row["region_name"] == "中部地方")
		print("<OPTION VALUE=\"中部地方\" SELECTED>中部地方</OPTION>");
	else
		print("<OPTION VALUE=\"中部地方\">中部地方</OPTION>");

	if($row["region_name"] == "近畿地方")
		print("<OPTION VALUE=\"近畿地方\" SELECTED>近畿地方</OPTION>");
	else
		print("<OPTION VALUE=\"近畿地方\">近畿地方</OPTION>");

	if($row["region_name"] == "中国地方")
		print("<OPTION VALUE=\"中国地方\" SELECTED>中国地方</OPTION>");
	else
		print("<OPTION VALUE=\"中国地方\">中国地方</OPTION>");

	if($row["region_name"] == "九州地方")
		print("<OPTION VALUE=\"九州地方\" SELECTED>九州地方</OPTION>");
	else
		print("<OPTION VALUE=\"九州地方\">九州地方</OPTION>");

	print("</SELECT></td></tr>");

	print("<tr>");
	print("<td>都道府県</td><td>");
	print("<SELECT id=\"pref\" name=\"pref\">");
	//print("<td><input size=\"48\" type=\"text\" name=\"pref\" value= \"".$row["pref"]."\"></td>");

	if($row["pref"] == "北海道")
		print("<OPTION VALUE=\"北海道\" SELECTED>北海道</OPTION>");
	else	
		print("<OPTION VALUE=\"北海道\">北海道</OPTION>");
	
	if($row["pref"] == "青森県")
		print("<OPTION VALUE=\"青森県\" SELECTED>青森県</OPTION>");
	else
		print("<OPTION VALUE=\"青森県\">青森県</OPTION>");
	
	if($row["pref"] == "岩手県")
		print("<OPTION VALUE=\"岩手県\" SELECTED>岩手県</OPTION>");
	else
		print("<OPTION VALUE=\"岩手県\">岩手県</OPTION>");
	
	if($row["pref"] == "宮城県")
		print("<OPTION VALUE=\"宮城県\" SELECTED>宮城県</OPTION>");
	else	
		print("<OPTION VALUE=\"宮城県\">宮城県</OPTION>");

	if($row["pref"] == "秋田県")
		print("<OPTION VALUE=\"秋田県\" SELECTED>秋田県</OPTION>");
	else
		print("<OPTION VALUE=\"秋田県\">秋田県</OPTION>");
	
	if($row["pref"] == "山形県")
		print("<OPTION VALUE=\"山形県\" SELECTED>山形県</OPTION>");
	else		
		print("<OPTION VALUE=\"山形県\">山形県</OPTION>");
	
	if($row["pref"] == "福島県")
		print("<OPTION VALUE=\"福島県\" SELECTED>福島県</OPTION>");
	else	
		print("<OPTION VALUE=\"福島県\">福島県</OPTION>");
	
	if($row["pref"] == "茨城県")
		print("<OPTION VALUE=\"茨城県\" SELECTED>茨城県</OPTION>");
	else	
		print("<OPTION VALUE=\"茨城県\">茨城県</OPTION>");
	
	if($row["pref"] == "栃木県")
		print("<OPTION VALUE=\"栃木県\" SELECTED>栃木県</OPTION>");
	else
		print("<OPTION VALUE=\"栃木県\">栃木県</OPTION>");
	
	if($row["pref"] == "群馬県")
		print("<OPTION VALUE=\"群馬県\" SELECTED>群馬県</OPTION>");
	else
		print("<OPTION VALUE=\"群馬県\">群馬県</OPTION>");
	
	if($row["pref"] == "埼玉県")
		print("<OPTION VALUE=\"埼玉県\" SELECTED>埼玉県</OPTION>");
	else
		print("<OPTION VALUE=\"埼玉県\">埼玉県</OPTION>");
	
	if($row["pref"] == "千葉県")
		print("<OPTION VALUE=\"千葉県\" SELECTED>千葉県</OPTION>");
	else
		print("<OPTION VALUE=\"千葉県\">千葉県</OPTION>");
	
	if($row["pref"] == "東京都")
		print("<OPTION VALUE=\"東京都\" SELECTED SELECTED>東京都</OPTION>");
	else
		print("<OPTION VALUE=\"東京都\">東京都</OPTION>");
	
	if($row["pref"] == "神奈川県")
		print("<OPTION VALUE=\"神奈川県\" SELECTED>神奈川県</OPTION>");
	else
		print("<OPTION VALUE=\"神奈川県\">神奈川県</OPTION>");
	
	if($row["pref"] == "新潟県")
		print("<OPTION VALUE=\"新潟県\" SELECTED>新潟県</OPTION>");
	else	
		print("<OPTION VALUE=\"新潟県\">新潟県</OPTION>");
	
	if($row["pref"] == "富山県")
		print("<OPTION VALUE=\"富山県\" SELECTED>富山県</OPTION>");
	else	
		print("<OPTION VALUE=\"富山県\">富山県</OPTION>");
	
	if($row["pref"] == "石川県")
		print("<OPTION VALUE=\"石川県\" SELECTED>石川県</OPTION>");
	else	
		print("<OPTION VALUE=\"石川県\">石川県</OPTION>");
	
	if($row["pref"] == "福井県")
		print("<OPTION VALUE=\"福井県\" SELECTED>福井県</OPTION>");
	else
		print("<OPTION VALUE=\"福井県\">福井県</OPTION>");
	
	if($row["pref"] == "山梨県")
		print("<OPTION VALUE=\"山梨県\" SELECTED>山梨県</OPTION>");
	else
		print("<OPTION VALUE=\"山梨県\">山梨県</OPTION>");
	
	if($row["pref"] == "長野県")
		print("<OPTION VALUE=\"長野県\" SELECTED>長野県</OPTION>");
	else	
		print("<OPTION VALUE=\"長野県\">長野県</OPTION>");
	
	if($row["pref"] == "岐阜県")
		print("<OPTION VALUE=\"岐阜県\" SELECTED>岐阜県</OPTION>");
	else	
		print("<OPTION VALUE=\"岐阜県\">岐阜県</OPTION>");
	
	if($row["pref"] == "静岡県")
		print("<OPTION VALUE=\"静岡県\" SELECTED>静岡県</OPTION>");
	else
		print("<OPTION VALUE=\"静岡県\">静岡県</OPTION>");

	if($row["pref"] == "愛知県")
		print("<OPTION VALUE=\"愛知県\" SELECTED>愛知県</OPTION>");
	else
		print("<OPTION VALUE=\"愛知県\">愛知県</OPTION>");

	if($row["pref"] == "三重県")
		print("<OPTION VALUE=\"三重県\" SELECTED>三重県</OPTION>");
	else
		print("<OPTION VALUE=\"三重県\">三重県</OPTION>");

	if($row["pref"] == "滋賀県")
		print("<OPTION VALUE=\"滋賀県\" SELECTED>滋賀県</OPTION>");
	else
		print("<OPTION VALUE=\"滋賀県\">滋賀県</OPTION>");
		
	if($row["pref"] == "京都府")
		print("<OPTION VALUE=\"京都府\" SELECTED>京都府</OPTION>");
	else
		print("<OPTION VALUE=\"京都府\">京都府</OPTION>");

	if($row["pref"] == "大阪府")
		print("<OPTION VALUE=\"大阪府\" SELECTED>大阪府</OPTION>");
	else
		print("<OPTION VALUE=\"大阪府\">大阪府</OPTION>");
	
	if($row["pref"] == "兵庫県")
		print("<OPTION VALUE=\"兵庫県\" SELECTED>兵庫県</OPTION>");
	else
		print("<OPTION VALUE=\"兵庫県\">兵庫県</OPTION>");
	
	if($row["pref"] == "奈良県")
		print("<OPTION VALUE=\"奈良県\" SELECTED>奈良県</OPTION>");
	else
		print("<OPTION VALUE=\"奈良県\">奈良県</OPTION>");
	
	if($row["pref"] == "和歌山県")
		print("<OPTION VALUE=\"和歌山県\" SELECTED>和歌山県</OPTION>");
	else
		print("<OPTION VALUE=\"和歌山県\">和歌山県</OPTION>");
	
	if($row["pref"] == "鳥取県")
		print("<OPTION VALUE=\"鳥取県\" SELECTED>鳥取県</OPTION>");
	else
		print("<OPTION VALUE=\"鳥取県\">鳥取県</OPTION>");
	
	if($row["pref"] == "島根県")
		print("<OPTION VALUE=\"島根県\" SELECTED>島根県</OPTION>");
	else
		print("<OPTION VALUE=\"島根県\">島根県</OPTION>");
	
	if($row["pref"] == "岡山県")
		print("<OPTION VALUE=\"岡山県\" SELECTED>岡山県</OPTION>");
	else
		print("<OPTION VALUE=\"岡山県\">岡山県</OPTION>");
	
	if($row["pref"] == "広島県")
		print("<OPTION VALUE=\"広島県\" SELECTED>広島県</OPTION>");
	else
		print("<OPTION VALUE=\"広島県\">広島県</OPTION>");
	
	if($row["pref"] == "山口県")
		print("<OPTION VALUE=\"山口県\" SELECTED>山口県</OPTION>");
	else
		print("<OPTION VALUE=\"山口県\">山口県</OPTION>");
	
	if($row["pref"] == "徳島県")
		print("<OPTION VALUE=\"徳島県\" SELECTED>徳島県</OPTION>");
	else
		print("<OPTION VALUE=\"徳島県\">徳島県</OPTION>");
	
	if($row["pref"] == "香川県")
		print("<OPTION VALUE=\"香川県\" SELECTED>香川県</OPTION>");
	else
		print("<OPTION VALUE=\"香川県\">香川県</OPTION>");

	if($row["pref"] == "愛媛県")
		print("<OPTION VALUE=\"愛媛県\" SELECTED>愛媛県</OPTION>");
	else
		print("<OPTION VALUE=\"愛媛県\">愛媛県</OPTION>");
	
	if($row["pref"] == "高知県")
		print("<OPTION VALUE=\"高知県\" SELECTED>高知県</OPTION>");
	else
		print("<OPTION VALUE=\"高知県\">高知県</OPTION>");

	if($row["pref"] == "福岡県")
		print("<OPTION VALUE=\"福岡県\" SELECTED>福岡県</OPTION>");
	else
		print("<OPTION VALUE=\"福岡県\">福岡県</OPTION>");
	
	if($row["pref"] == "佐賀県")
		print("<OPTION VALUE=\"佐賀県\" SELECTED>佐賀県</OPTION>");
	else
		print("<OPTION VALUE=\"佐賀県\">佐賀県</OPTION>");
	
	if($row["pref"] == "長崎県")
		print("<OPTION VALUE=\"長崎県\" SELECTED>長崎県</OPTION>");
	else
		print("<OPTION VALUE=\"長崎県\">長崎県</OPTION>");
	
	if($row["pref"] == "熊本県")
		print("<OPTION VALUE=\"熊本県\" SELECTED>熊本県</OPTION>");
	else
		print("<OPTION VALUE=\"熊本県\">熊本県</OPTION>");

	if($row["pref"] == "大分県")
		print("<OPTION VALUE=\"大分県\" SELECTED>大分県</OPTION>");
	else
		print("<OPTION VALUE=\"大分県\">大分県</OPTION>");

	if($row["pref"] == "宮城県")
		print("<OPTION VALUE=\"宮城県\" SELECTED>宮城県</OPTION>");
	else
		print("<OPTION VALUE=\"宮城県\">宮城県</OPTION>");

	if($row["pref"] == "鹿児島県")
		print("<OPTION VALUE=\"鹿児島県\" SELECTED>鹿児島県</OPTION>");
	else
		print("<OPTION VALUE=\"鹿児島県\">鹿児島県</OPTION>");

	if($row["pref"] == "沖縄県")
		print("<OPTION VALUE=\"沖縄県\" SELECTED>沖縄県</OPTION>");
	else
		print("<OPTION VALUE=\"沖縄県\">沖縄県</OPTION>");

	print("</SELECT>");
	print("</td>");
	
	print("<td>県名　よみ</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"pref_read\" value= \"".$row["pref_read"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>酒蔵名検索用</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"sakagura_search\" value= \"".$row["sakagura_search"]."\"></td>");
	print("<td>郵便番号</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"postal_code\" value= \"".$row["postal_code"]."\" onkeydown=\"return key_down(event.keyCode)\"></td>");
	print("</tr>");

	print("<tr>");
	print("<td>住所</td>");
	print("<td colspan=\"3\"><input size=\"100\" type=\"text\" name=\"address\" value= \"".$row["address"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>電話番号</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"phone\" value= \"".$row["phone"]."\" onkeydown=\"return key_down(event.keyCode)\"></td>");
	print("<td>FAX番号</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"fax\" value= \"".$row["fax"]."\" onkeydown=\"return key_down(event.keyCode)\"></td>");
	print("</tr>");

	print("<tr>");
	print("<td>ウェブサイト</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"url\" value= \"".$row["url"]."\"></td>");
	print("<td>Email</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"email\" value= \"".$row["email"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>代表者</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"representative\" value= \"".$row["representative"]."\"></td>");
	print("<td>杜氏</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"touji\" value= \"".$row["touji"]."\"></td>");
	print("</tr>");

	print("<tr>");
	print("<td>創業</td>");
	print("<td><input type=\"hidden\" id=\"hidden_establishment\" value=\"" .$row["establishment"] ."\">");
  print("<SELECT id=\"year\" type=\"text\" name=\"establishment\">");
  print("<OPTION VALUE=\"\">創業年</OPTION>");
  print("<OPTION VALUE=2015>2015年　平成27年</OPTION>");
  print("<OPTION VALUE=2014>2014年　平成26年</OPTION>");
  print("<OPTION VALUE=2013>2013年　平成25年</OPTION>");
  print("<OPTION VALUE=2012>2012年　平成24年</OPTION>");
  print("<OPTION VALUE=2011>2011年　平成23年</OPTION>");
  print("<OPTION VALUE=2010>2010年　平成22年</OPTION>");
  print("<OPTION VALUE=2009>2009年　平成21年</OPTION>");
  print("<OPTION VALUE=2008>2008年　平成20年</OPTION>");
  print("<OPTION VALUE=2007>2007年　平成19年</OPTION>");
  print("<OPTION VALUE=2006>2006年　平成18年</OPTION>");
  print("<OPTION VALUE=2005>2005年　平成17年</OPTION>");
  print("<OPTION VALUE=2004>2004年　平成16年</OPTION>");
  print("<OPTION VALUE=2003>2003年　平成15年</OPTION>");
  print("<OPTION VALUE=2002>2002年　平成14年</OPTION>");
  print("<OPTION VALUE=2001>2001年　平成13年</OPTION>");
  print("<OPTION VALUE=2000>2000年　平成12年</OPTION>");
  print("<OPTION VALUE=1999>1999年　平成11年</OPTION>");
  print("<OPTION VALUE=1998>1998年　平成10年</OPTION>");
  print("<OPTION VALUE=1997>1997年　平成9年</OPTION>");
  print("<OPTION VALUE=1996>1996年　平成8年</OPTION>");
  print("<OPTION VALUE=1995>1995年　平成7年</OPTION>");
  print("<OPTION VALUE=1994>1994年　平成6年</OPTION>");
  print("<OPTION VALUE=1993>1993年　平成5年</OPTION>");
  print("<OPTION VALUE=1992>1992年　平成4年</OPTION>");
  print("<OPTION VALUE=1991>1991年　平成3年</OPTION>");
  print("<OPTION VALUE=1990>1990年　平成2年</OPTION>");
  print("<OPTION VALUE=1989>1989年　平成1年</OPTION>");
  print("<OPTION VALUE=1988>1988年　昭和63年</OPTION>");
  print("<OPTION VALUE=1987>1987年　昭和62年</OPTION>");
  print("<OPTION VALUE=1986>1986年　昭和61年</OPTION>");
  print("<OPTION VALUE=1985>1985年　昭和60年</OPTION>");
  print("<OPTION VALUE=1984>1984年　昭和59年</OPTION>");
  print("<OPTION VALUE=1983>1983年　昭和58年</OPTION>");
  print("<OPTION VALUE=1982>1982年　昭和57年</OPTION>");
  print("<OPTION VALUE=1981>1981年　昭和56年</OPTION>");
  print("<OPTION VALUE=1980>1980年　昭和55年</OPTION>");
  print("<OPTION VALUE=1979>1979年　昭和54年</OPTION>");
  print("<OPTION VALUE=1978>1978年　昭和53年</OPTION>");
  print("<OPTION VALUE=1977>1977年　昭和52年</OPTION>");
  print("<OPTION VALUE=1976>1976年　昭和51年</OPTION>");
  print("<OPTION VALUE=1975>1975年　昭和50年</OPTION>");
  print("<OPTION VALUE=1974>1974年　昭和49年</OPTION>");
  print("<OPTION VALUE=1973>1973年　昭和48年</OPTION>");
  print("<OPTION VALUE=1972>1972年　昭和47年</OPTION>");
  print("<OPTION VALUE=1971>1971年　昭和46年</OPTION>");
  print("<OPTION VALUE=1970>1970年　昭和45年</OPTION>");
  print("<OPTION VALUE=1969>1969年　昭和44年</OPTION>");
  print("<OPTION VALUE=1968>1968年　昭和43年</OPTION>");
  print("<OPTION VALUE=1967>1967年　昭和42年</OPTION>");
  print("<OPTION VALUE=1966>1966年　昭和41年</OPTION>");
  print("<OPTION VALUE=1965>1965年　昭和40年</OPTION>");
  print("<OPTION VALUE=1964>1964年　昭和39年</OPTION>");
  print("<OPTION VALUE=1963>1963年　昭和38年</OPTION>");
  print("<OPTION VALUE=1962>1962年　昭和37年</OPTION>");
  print("<OPTION VALUE=1961>1961年　昭和36年</OPTION>");
  print("<OPTION VALUE=1960>1960年　昭和35年</OPTION>");
  print("<OPTION VALUE=1959>1959年　昭和34年</OPTION>");
  print("<OPTION VALUE=1958>1958年　昭和33年</OPTION>");
  print("<OPTION VALUE=1957>1957年　昭和32年</OPTION>");
  print("<OPTION VALUE=1956>1956年　昭和31年</OPTION>");
  print("<OPTION VALUE=1955>1955年　昭和30年</OPTION>");
  print("<OPTION VALUE=1954>1954年　昭和29年</OPTION>");
  print("<OPTION VALUE=1953>1953年　昭和28年</OPTION>");
  print("<OPTION VALUE=1952>1952年　昭和27年</OPTION>");
  print("<OPTION VALUE=1951>1951年　昭和26年</OPTION>");
  print("<OPTION VALUE=1950>1950年　昭和25年</OPTION>");
  print("<OPTION VALUE=1949>1949年　昭和24年</OPTION>");
  print("<OPTION VALUE=1948>1948年　昭和23年</OPTION>");
  print("<OPTION VALUE=1947>1947年　昭和22年</OPTION>");
  print("<OPTION VALUE=1946>1946年　昭和21年</OPTION>");
  print("<OPTION VALUE=1945>1945年　昭和20年</OPTION>");
  print("<OPTION VALUE=1944>1944年　昭和19年</OPTION>");
  print("<OPTION VALUE=1943>1943年　昭和18年</OPTION>");
  print("<OPTION VALUE=1942>1942年　昭和17年</OPTION>");
  print("<OPTION VALUE=1941>1941年　昭和16年</OPTION>");
  print("<OPTION VALUE=1940>1940年　昭和15年</OPTION>");
  print("<OPTION VALUE=1939>1939年　昭和14年</OPTION>");
  print("<OPTION VALUE=1938>1938年　昭和13年</OPTION>");
  print("<OPTION VALUE=1937>1937年　昭和12年</OPTION>");
  print("<OPTION VALUE=1936>1936年　昭和11年</OPTION>");
  print("<OPTION VALUE=1935>1935年　昭和10年</OPTION>");
  print("<OPTION VALUE=1934>1934年　昭和9年</OPTION>");
  print("<OPTION VALUE=1933>1933年　昭和8年</OPTION>");
  print("<OPTION VALUE=1932>1932年　昭和7年</OPTION>");
  print("<OPTION VALUE=1931>1931年　昭和6年</OPTION>");
  print("<OPTION VALUE=1930>1930年　昭和5年</OPTION>");
  print("<OPTION VALUE=1929>1929年　昭和4年</OPTION>");
  print("<OPTION VALUE=1928>1928年　昭和3年</OPTION>");
  print("<OPTION VALUE=1927>1927年　昭和2年</OPTION>");
  print("<OPTION VALUE=1926>1926年　昭和1年</OPTION>");
  print("<OPTION VALUE=1925>1925年　昭和1年</OPTION>");
  print("<OPTION VALUE=1924>1924年　大正13年</OPTION>");
  print("<OPTION VALUE=1923>1923年　大正12年</OPTION>");
  print("<OPTION VALUE=1922>1922年　大正11年</OPTION>");
  print("<OPTION VALUE=1921>1921年　大正10年</OPTION>");
  print("<OPTION VALUE=1920>1920年　大正9年</OPTION>");
  print("<OPTION VALUE=1919>1919年　大正8年</OPTION>");
  print("<OPTION VALUE=1918>1918年　大正7年</OPTION>");
  print("<OPTION VALUE=1917>1917年　大正6年</OPTION>");
  print("<OPTION VALUE=1916>1916年　大正5年</OPTION>");
  print("<OPTION VALUE=1915>1915年　大正4年</OPTION>");
  print("<OPTION VALUE=1914>1914年　大正3年</OPTION>");
  print("<OPTION VALUE=1913>1913年　大正2年</OPTION>");
  print("<OPTION VALUE=1912>1912年　大正1年</OPTION>");
  print("<OPTION VALUE=1911>1911年　明治44年</OPTION>");
  print("<OPTION VALUE=1910>1910年　明治43年</OPTION>");
  print("<OPTION VALUE=1909>1909年　明治42年</OPTION>");
  print("<OPTION VALUE=1908>1908年　明治41年</OPTION>");
  print("<OPTION VALUE=1907>1907年　明治40年</OPTION>");
  print("<OPTION VALUE=1906>1906年　明治39年</OPTION>");
  print("<OPTION VALUE=1905>1905年　明治38年</OPTION>");
  print("<OPTION VALUE=1904>1904年　明治37年</OPTION>");
  print("<OPTION VALUE=1903>1903年　明治36年</OPTION>");
  print("<OPTION VALUE=1902>1902年　明治35年</OPTION>");
  print("<OPTION VALUE=1901>1901年　明治34年</OPTION>");
  print("<OPTION VALUE=1900>1900年　明治33年</OPTION>");
  print("</SELECT>");
  print("</td>");  

  print("<td>受賞歴</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"award_history\" value= \"".$row["award_history"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>蔵見学</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"observation\" value= \"".$row["observation"]."\"></td>");
	print("<td>蔵見学情報</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"observatory_info\" value= \"".$row["observatory_info"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>直販</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"direct_sale\" value= \"".$row["direct_sale"]."\"></td>");
	print("<td>購入方法</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"payment_method\" value= \"".$row["payment_method"]."\"></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td colspan=\"4\">メモ</td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td colspan=\"4\"><textarea name=\"memo\" rows=10 cols=100>".$row["memo"]."</textarea></td>");
	print("</tr>");

	print("<tr class=\"alt\">");
	print("<td>データソース</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"data_source\" value= \"".$row["data_source"]."\"></td>");
	print("<td>Last Contacted</td>");
	print("<td><input size=\"48\" type=\"text\" name=\"LastContacted\" value= \"".$row["LastContacted"]."\"></td>");
	print("</tr>");
}
?>

<tr class="alt">
<td colspan="4" align="center">
<input id="button" type="button" class="add_button" value="更新">
<button id="button_cancel" class="add_button" onclick="goBack()">キャンセル</button>
<a href="sake_search.php"><input id="button_cancel" type="button" class="add_button" value="検索画面に戻る"></a>
</td>
</tr>

</table>
</form>
<script type="text/javascript">

jQuery(document).ready(function(){
 
    if($("#hidden_establishment").val() != undefined)
    {
        $('#year option').each(function(){

            if(this.value == $("#hidden_establishment").val()) 
            {
                 $("#year").val($("#hidden_establishment").val());
                 return false;
            }
        });
    }  

    $(document).on('click','#button', function(){
		  var data = $("#form").serialize(); 

		  $.ajax({
				type: "post",
				url: "sakagura_update.php?id=<?php print($_GET['id']);?>",
				data: data,
		  }).done(function(xml){
			  var str = $(xml).find("str").text();
			  //alert("success");
      
			  if(str == "success")
				  window.open('sda_view.php?id=<?php print($_GET['id']);?>', '_self');
			  else
				  $("#sample1").text(str);
		  }).fail(function(data){
			  alert("This is Error");

			  $("#sample1").text('This is Error');
		  });
	  });
});

function goBack() {
	window.history.back();
}

function key_down(get_code){
	 if(get_code >= 48 && get_code <= 57  //数字キー
		|| get_code >= 96 && get_code <= 105 //テンキーの数字
		|| get_code == 189  // '-'		
		|| get_code == 8 //bs
		|| get_code == 37 // left
		|| get_code == 39 // right
		|| get_code == 190 // .
	 )
	   return true;
	 else
	   return false;
}

</script>
</body>
</html>
