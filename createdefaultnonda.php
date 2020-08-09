<html lang="ja">
<head>
<link rel="stylesheet" type="text/css" href="cgi.sakenomu.org/sakagura/css/header.css" />
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>飲んだの追加</title></head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<body>

<div>converting</div>

<?php
	require_once("db_functions.php");

	if(!$db = opendatabase("sake.db"))
	{
		print('failed to open a database');
	}

	$sql = "create table if not exists temp_sake_has_image (sake_id varchar(256), sake_name varchar(256))";
	$res = executequery($db, $sql);

	if(!res)
	{
		print("<div>failed to execute sql:" + $sql ."</div>");
	}
	else
	{
		print("<div>successfully created temp_sake_has_image</div>");
	}

	$sql = "delete from temp_sake_has_image";
	$res = executequery($db, $sql);

	if(!res)
	{
		print("<div>failed to execute sql:" + $sql ."</div>");
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$sql = "select sake_j.sake_id, sake_j.sake_name from sake_j, sake_image where sake_j.sake_id = sake_image.sake_id";
	//$sql = "select sake_id, sake_name from temp_sake_has_image";
	$sql = "select sake_j.sake_id, sake_j.sake_name from sake_j where exists (select * from sake_image where sake_j.sake_id = sake_image.sake_id)";

	$res = executequery($db, $sql);

	if(!res)
	{
		header('Content-Type: application/json');
		return;
	}
	else
	{
		$count = 0;

		while($row = getnextrow($res))
		{
			//print('<div>value</div>');
			//print('<div><span>sake_id:' . $row["sake_id"] . ' </span><span>name:' . $row["sake_name"] . '</span></div>');

			$sake_id = $row["sake_id"];
			$sake_name = $row["sake_name"];

			$sql = "INSERT INTO temp_sake_has_image (sake_id, sake_name) VALUES( '$sake_id', '$sake_name') ";

			$result = executequery($db, $sql);

			if(!$result)
			{
				print("<div>failed to insert record to temp_sake_has_image</div>");
			}
			else
			{
				print('<div><span>Suucess:' .$count . ' sake_id:' . $row["sake_id"] . ' </span><span>name:' . $row["sake_name"] . '</span></div>');
			}

			$count++;
		}
	}

	$sql = "delete from table_nonda";
	$result2 = executequery($db, $sql);

	if(!$result2)
	{
		print("<div>failed to empty table_nonda, sql:" + $sql ."</div>");
	}
	else
	{
		print("<div>successfuly empty table_nonda</div>");
	}

	$sql = "SELECT * FROM temp_sake_has_image";
	$result3 = executequery($db, $sql);

	$count = 0;

	while($rd = getnextrow($result3))
	{
		$sake_id = $rd["sake_id"];
		$sake_name = $rd["sake_name"];
		$count++;
		//print('<div><span>temp_sake_has_image:' .$count . ' sake_id:' . $rd["sake_id"] . ' </span><span>name:' . $rd["sake_name"] . '</span></div>');

		$sql = "select sake_id, filename from sake_image where sake_id = '$sake_id'";
		$result4 = executequery($db, $sql);


		$added_paths = "";
		$contributor = "drinksake02"; 
		$subject = "飲んだとは";
		$rank = 3;
		$message = "飲んだに写真やコメント、テイスティングノートを投稿してシェアすることができます";						
		$committed = 1;
		$write_date = time();

		while($record = getnextrow($result4))
		{
			if($added_paths != "")
			{
				$added_paths .= ', ' .$record["filename"];
			}
			else
			{
				$added_paths = $record["filename"];
			}
		}

		//print("<div>added_path:" .$added_paths .'</div>');

		$sql = "INSERT INTO temp_sake_has_image (sake_id, sake_name) VALUES( '$sake_id', '$sake_name') ";
		$sql = "INSERT INTO TABLE_NONDA         (sake_id, contributor, subject, rank, message, added_paths, committed, write_date) VALUES ('$sake_id', '$contributor', '$subject', '$rank', '$message', '$added_paths', '$committed', '$write_date')";

		$result5 = executequery($db, $sql);

		if(!$result5)
		{
			print("<div>failed to inserting to table_nonda:" .$sake_id .',' .$contributor .',' .$subject .',' .$rank .',' .$message .',' .$committed .',' .$write_date ."</div>");
		}
		else
		{
			print('<div><span>Suucess:' .$count . ' sake_id:' . $sake_id . ' </span><span>added_paths:' . $added_paths . '</span></div>');
		}
	}

	print("<div>total records2:" .$count ."</div>");


	/*
	create table temp_table_nonda (
		sake_id varchar(256),
		contributor varchar(512),
		subject varchar(512),
		rank integer,
		message varchar(4012),
		added_paths varchar(2056),
		deleted_paths varchar(2056),
		flavor varchar(64),
		tastes vachar(64),
		committed integer,
		write_date integer
	);

	insert into table_nonda(sake_id, 
							contributor, 
							subject, 
							rank, 
							message, 
							added_paths, 
							deleted_paths, 
							flavor, 
							tastes, 
							committed, 
							write_date) 
					select sake_id,
						   sake_name 
					from temp_sake_has_image;
	*/

?>
</body>
</html>
