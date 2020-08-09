<?php
if($db = sqlite_open("sqlitedb", 0666, $err))
{
	sqlite_query($db,"CREATE TABLE book_table (bid INTEGER PRIMARY KEY, bisbn VARCHAR(20), btitle VARCHAR(20), bauth VARCHAR(20), bpub VARCHAR(20), bpubyear VARCHAR(4))");
}
else
{
 	die($err);
}
?>
