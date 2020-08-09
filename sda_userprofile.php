<html>
<head>
<title>データの更新</title></head>
<body>
<h1>データの更新</h1>
<?php

$ssn = sqlite3::escapeString($_GET['ssn']);

if(!$db=sqlite_open("sqlitedb",　0666,　$err))
{
	die("データベース接続エラー<br />");
}

$item = "";

$fname = $_POST['fname'];

if($isbn != "")
{
    $fname = str_replace("%", "\%", sqlite3::escapeString($fname));
    $item = "bisbn='$fname'";
}

$minit = $_POST['minit'];

if($minit != "")
{
    $minit = str_replace("%", "\%", sqlite3::escapeString($minit));
    
	if($item == "")
	{
        $item = "bminit='$minit'";
    }
	else
	{
        $item .= ", bminit='$minit'";
    }
}

$lname = $_POST['lname'];

if($lname != "")
{
    $lname = str_replace("%", "\%", sqlite3::escapeString($lname));
    
	if($item == "")
	{
        $item = "blname='$lname'";
    }
	else
	{
        $item .= ", blname='$lname'";
    }
}

$bdate = $_POST['bdate'];

if($bdate != "")
{
    $bdate = str_replace("%", "\%", sqlite3::escapeString($bdate));

    if($item == "")
	{
        $item = "bbdate='$bdate'";
    }
	else
	{
        $item .= ", bbdate='$bdate'";
    }
}

$sql = "UPDATE EMPLOYEE SET ".$item." WHERE bid = '$id'";

sqlite_query($db, $sql)
    or die("更新できませんでした");

print("更新しました。<a href=\"sda_search_form.html\">sda_search_form.html</a>で確認してください。");
?>
</body>
</html>
