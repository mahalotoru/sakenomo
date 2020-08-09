<?php
require_once("db_functions.php");

$html_string = "<style>\n"
	."table, td, th {\n"
		."    border: 1px solid black;\n"
		."}\n"
		."\n"
	."table {\n"
		."width: 200%;\n"
		."table-layout: fixed;\n"
		."}\n"
		."\n"
		."th {\n"
		."height: 50px;\n"
	."}\n"
	."\n"
	."#customers {\n"
		."font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;\n"
		."width: 100%;\n"
		."border-collapse: collapse;\n"
	."}\n"
	."\n"
	."#customers td, #customers th {\n"
		."font-size: 1em;\n"
		."border: 1px solid #98bf21;\n"
		."padding: 3px 7px 2px 7px;\n"
	."}\n"
	."\n"
	."#customers th {\n"
    ."font-size: 1em;\n"
    ."text-align: left;\n"
    ."padding-top: 5px;\n"
    ."padding-bottom: 4px;\n"
    ."background-color: #A7C942;\n"
    ."color: #ffffff;\n"
	."}\n"
	."\n"
	."#customers tr.alt td {\n"
    ."color: #000000;\n"
    ."background-color: #EAF2D3;\n"
	."}\n"
	."</style>\n";

if(!$db = opendatabase("sake.db"))
{
   die("�f�[�^�x�[�X�ڑ��G���[ .<br />");
}

$sakeid = $_GET['sakeid'];
$sql = "SELECT * FROM SAKE_J WHERE sake_id = '$sakeid'";
$res = executequery($db, $sql);

function disp_html_header($p_title)
{
    $html_string = "<html lang=\"ja\">\n<head>\n<title>".$p_title."</title>\n"
		."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n"
		."<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">\n"
		."<meta http-equiv=\"Content-Script-Type\" content=\"text/javascript\">\n"
		."<style type=\"text/css\">\n"
		."<!--\n"
		."body{font-size:10pt;font-weight:normal;color:#000000;}\n"
		."ts{font-size:10pt;font-weight:normal;color:#00000;}\n"
		."th{font-size:10pt;font-weight:bold;color:#00000;}\n"
		.".title{font-size:14pt;font-weight:bold;color:#00000;}\n"
		.".red{font-weight:bold;color:#FF0033;}\n"
		."-->\n"
		."</style>"
		."</head><body>\n";
    print($html_string);
}

disp_html_header("sake");
print($html_string);

if($res)
{
	$row = getnextrow($res);
	$sql = "DELETE FROM SAKE_J WHERE sake_id = '$sakeid'";
	$stmt = executequery($db, $sql);

	if($stmt)
	{
		print("�폜���������܂���.<br />");
	
		print("<center>");
		print("<table id=\"customers\" border=\"1\" cellspacing=\"0\">");
		print("<tr class=\"alt\">");
		print("<td>������</td>");
		print("<td>".$row["sake_name"]."</td>");
		print("<td>����ID</td>");
		print("<td>".$row["sake_id"]."</td>");
		print("</tr>");
		print("</table>");
		print("<a href=\"sake_search.php\">������ʂɖ߂�</a>");
	}
}
?>
</center>
</body>
</html>
