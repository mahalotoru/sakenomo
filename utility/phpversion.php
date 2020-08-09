<html lang="ja">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
<meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta content='width=device-width, initial-scale=1' name='viewport'/>  

</head>
<title>php version</title>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
<body>

<p>Php version</p>

<?php
require_once("db_functions.php");

$version = SQLite3::version();
//$version = 10;

print("<div>");

$i = 0;


for($i = 0; $i < count($version); $i++)
{
    print($version[0]);
    print($version[1]);
    print($version[2]);
}

//print("count:" + count($version));
print("version[versionString]:" + $version[versionString]);
//print("version[versionNumber]:" + $version[versionNumber]);

print("</div>");

?>

<p>Php version</p>

</body>
</html>
