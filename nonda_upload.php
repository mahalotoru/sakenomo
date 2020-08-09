<?php

require_once("db_functions.php");

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

//ini_set('memory_limit', '64M');
ini_set('memory_limit', '128M');

$in_time = time();
$id = $_POST['id'];
$title = $_POST['title'];
$data_type = $_POST['data_type'];
$tablename = $data_type ."_image";
$fileErrorMsg = $_FILES["file1"]["error"];		// 0 for false... and 1 for true

//$count = count($_FILES['file1']);

$count = count($_FILES['file1']['name']);

//echo "[\"count:" .$count .", filename1:" .$_FILES["file1"]["name"][0] ." filename2:" .$_FILES["file1"]["name"][1] ."\", \"count is checked\", \"" .$id ."\", \"6.mp3\"]";
//return 0;

for($i = 0; $i < $count; $i++) {

    //echo 'Name: '.$_FILES['fileToUpload']['name'][$i].'<br/>';

	$fileTmpLoc = $_FILES["file1"]["tmp_name"][$i];		// File in the PHP tmp folder
	$fileName = $in_time.$_FILES["file1"]["name"][$i];  // The file name
	$fileType = $_FILES["file1"]["type"][$i];		    // The type of file it is
	$fileSize = $_FILES["file1"]["size"][$i];		    // File size in bytes
	$path = "images/original/$fileName";

	//echo "[\"" .$count ."\", \"count is checked\", \"" .$id ."\", \"6.mp3\"]";

	if(!$fileTmpLoc) { // if file not chosen
		echo "ERROR: Please browse for a file before clicking the upload button.";
		return 0;
	}

	if(move_uploaded_file($fileTmpLoc, $path))
	{
		$newpath  = "images/photo/resized_$fileName";
		$thumbpath = "images/photo/thumb/resized_$fileName";
		$newfileName = "resized_" .$fileName;

		if($data_type == "sakagura")
		{	
			$newpath  = "images/sakagura/resized_$fileName";
			$thumbpath = "images/sakagura/thumb/resized_$fileName";
			$newfileName = "resized_" .$fileName;
		}

		list($width, $height, $type) = getimagesize($path);
	   
		//echo "[\"count:" .$count .", " .$newfileName." width:".$width." height:".$height ."\", \"count is checked\", \"" .$id ."\", \"6.mp3\"]";
		//return 0;

		if($width > 640 && $width > $height)
		{
			/**********************************************************
			 * resize image 
			 **********************************************************/
			$newwidth = 640;
			$newheight = $height * ($newwidth / $width);

			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);

			$exif = exif_read_data($path);
			$orientation = $exif['Orientation'];

			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				//$this->ImageFlip($dimg);
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				//$this->ImageFlip($dimg);
				break;

			case 5: // vertical flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}
	 
			imagejpeg($dest, $newpath);
	        
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * thumb image 
			 **********************************************************/
			$newwidth = 200;
			$newheight = $height * ($newwidth / $width);
	        
			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);
			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				//$this->ImageFlip($dimg);
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				//$this->ImageFlip($dimg);
				break;

			case 5: // vertical flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}

			imagejpeg($dest, $thumbpath);
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * add path to database 
			 **********************************************************/
			$sql = "INSERT INTO " .$tablename ." VALUES('$id', '$newfileName')";

			executequery($db, $sql)
			  or die("登録できませんでした。この酒蔵IDはすでに登録されています");
		}
		else if($height > 640 && $height > $width)
		{
			/**********************************************************
			 * resize image 
			 **********************************************************/
			$newheight = 640;
			$newwidth = $width * ($newheight / $height);

			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);
			$exif = exif_read_data($path);
			$orientation = $exif['Orientation'];
			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				//$this->ImageFlip($dimg);
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				//$this->ImageFlip($dimg);
				break;

			case 5: // vertical flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				//$this->ImageFlip($dest);
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}

			imagejpeg($dest, $newpath);
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * thumb image 
			 **********************************************************/
			$newheight = 200;
			$newwidth = $width * ($newheight / $height);
	        
			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);
			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				break;

			case 5: // vertical flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}

			imagejpeg($dest, $thumbpath);
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * add path to database 
			 **********************************************************/
			$sql = "INSERT INTO " .$tablename ." VALUES('$id', '$newfileName')";

			executequery($db, $sql)
			  or die("登録できませんでした。この酒蔵IDはすでに登録されています");
		}
		else
		{
			/**********************************************************
			 * resize image 
			 **********************************************************/
			$newheight = 640;
			$newwidth = 640;

			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);
			$exif = exif_read_data($path);
			$orientation = $exif['Orientation'];
			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				break;

			case 5: // vertical flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}
	        
			imagejpeg($dest, $newpath);
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * thumb image 
			 **********************************************************/
			$newheight = 200;
			$newwidth = $width * ($newheight / $height);
	        
			$source = imagecreatefromjpeg($path);
			$dest = imagecreatetruecolor($newwidth, $newheight);
			$ret = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			switch($orientation)
			{
			case 2: // horizontal flip
				break;

			case 3: // 180 rotate left
				$dest = imagerotate($dest, 180, -1);
				break;

			case 4: // vertical flip
				break;

			case 5: // vertical flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 6: // 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 7: // horizontal flip + 90 rotate right
				$dest = imagerotate($dest, -90, -1);
				break;

			case 8: // 90 rotate left
				$dest = imagerotate($dest, 90, -1);
				break;
			}

			imagejpeg($dest, $thumbpath);
			imagedestroy($dest);
			imagedestroy($source);

			/**********************************************************
			 * add path to database 
			 **********************************************************/
			$sql = "INSERT INTO " .$tablename ." VALUES('$id', '$newfileName')";

			executequery($db, $sql)
			  or die("登録できませんでした。この酒蔵IDはすでに登録されています");
		}
	} 
	else 
	{
		echo "move_uploaded_file function failed";
		return 0;
	}

} // for loop

//echo "[\"" .$newfileName  ."\", \"upload is complete\", \"" .$id ."\", \"6.mp3\"]";
//echo "[\"" .$newfileName  ."\", \"upload is complete\", \"" .$id ."\", \"6.mp3\"]";
echo "[\"" .$tablename  ."\", \"upload is complete\", \"" .$id ."\", \"6.mp3\"]";

?>
