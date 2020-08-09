<html lang="ja">
<head>
<link rel="stylesheet" type="text/css" href="cgi.sakenomu.org/sakagura/css/header.css" />
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
</head>
<body>


<?php
require_once("db_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

print('<div>hello</div>');

$sql = "select name from sqlite_master where type='table'";
$res = executequery($db, $sql);

while($row = getnextrow($res)) 
{
    $tablename = $row["name"];

	if(!strncmp($tablename, 'table_', 6))
	{ 
		/*
		print('<div>$sql = "drop table ' .$tablename .'</div>');

		//$sql = "DELETE FROM '$tablename'";
		$sql = "DELETE FROM " .$tablename;
		$result1 = executequery($db, $sql);

		if(!$result1)
			print('<div>delete failed:' .$tablename .'</div>');
					
		if(!$result1)
		{
			$sql = ""drop table ".$tablename;
			$result2 = executequery($db, $sql);

			if(!$result2)
			{
				print('<div>failed:' .$tablename .'</div>');
			}
		}
		*/
	}
	else
	{
		print("<div>not equal:".$tablename."</div>");
	}
}

print('<div>done</div>');

?>

</body>
</html>
