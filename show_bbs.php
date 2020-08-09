<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta content='width=device-width, initial-scale=1, user-scalable=0' name='viewport'/>  
<style>
</style>
<title>酒蔵情報</title>
</head>

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/sakenomu.js"></script>
<script src="js/sakenomuui.js"></script>
<body>

<p>hello world</p>

<?php

require_once("db_functions.php");
require_once("bbs_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

print('<div id="container">');

$sql = "SELECT name FROM sqlite_master WHERE type='table'";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
		//if(!strncmp($row["name"], "table_A" , 7))
		if(!strncmp($row["name"], "table_nonda" , 11))
		{
			 print('<div>'.$row["name"].'</div>');

			 //$sql = "alter table " .$row["name"] ." add column imagePaths VARCHAR(2048)";
			 $sql = "alter table " .$row["name"] ." add column tastes VARCHAR(64)";
			 $result = executequery($db, $sql);

			 if(!$result)
			 {
					print("<div>adding column failed:" .$row["name"] ." sql:" .$sql ."</div>");
			 }
			 else
			 {
					print("<div>success:" .$sql ."</div>");
			 }
		}

		/*
		else if(!strncmp($row["name"], "table_nonda" , 11))
		{
			 print('<div>'.$row["name"].'</div>');w

			 $sql = "alter table " .$row["name"] ." add column imagePaths VARCHAR(2048)";
			 $result = executequery($db, $sql);

			 if(!$result)
			 {
					print("<div>adding column failed:" .$row["name"] ." sql:" .$sql ."</div>");
			 }
			 else
			 {
					print("<div>success:" .$sql ."</div>");
			 }
		}
		*/
}

print("<div>finished</div>");
print("</div>"); // page
?>

</body>
</html>
