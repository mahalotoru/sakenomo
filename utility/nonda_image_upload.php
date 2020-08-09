<?php

require_once("db_functions.php");
//ini_set('memory_limit', '64M');
//ini_set('memory_limit', '128M');
//ini_set('memory_limit', '1024M');
//ini_set('memory_limit', '256M');
ini_set('memory_limit', '512M');

$id = $_POST['id'];
$title = $_POST['title'];
$tablename = $_POST['tablename'];
$contributor = $_POST['contributor'];
$desc = $_POST['desc'];
$status = $_POST['status'];
$prefix = $_POST['prefix'];
$in_time = time();

$fileName = $prefix.$_FILES["file1"]["name"];  // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"];		// File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"];			// The type of file it is
$fileSize = $_FILES["file1"]["size"];			// File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"];		// 0 for false... and 1 for trueetur
$path = "images/original/$fileName";

if(!$db = opendatabase("sake.db")) {
	$return = "データベース接続エラー";
	echo '["' .$return .'", "upload failed"]';
	return 0;
}

$sql = "SELECT * FROM TABLE_NONDA WHERE sake_id = '$id' AND contributor = '$contributor'";
$res = executequery($db, $sql);

if(!$res) {
	$return = "ドラフトは作成されていません".$sql;
	echo '["' .$return .'", \"upload failed"]';
	return 0;
}

if(!($row = getnextrow($res))) {
	$return = "ドラフトは作成されていません:".$sql;
	echo '["' .$return .'", "upload failed"]';
	return 0;
}

if(!$fileTmpLoc) { // if file not chosen
	$return = "Please browse for a file before clicking the upload button";
	echo '["' .$return .'", "upload failed"]';
	return 0;
}

if(move_uploaded_file($fileTmpLoc, $path))
{
	$newpath  = "images/photo/$fileName";
	$thumbpath = "images/photo/thumb/$fileName";
    list($width, $height, $type) = getimagesize($path);

    ////////////////////////////////////////////////////////////
    // resize image 
    ////////////////////////////////////////////////////////////
    $newheight = 640;
    $newwidth = 640;
    
	$smallheight = 200;
    $smallwidth = 200;

	if($width > $height) {
        $newheight = $height * ($newwidth / $width);
        $smallheight = $height * ($smallwidth / $width);
	}
	else if($width < $height) {
        $newwidth = $width * ($newheight / $height);
        $smallwidth = $width * ($smallheight / $height);
	}

    $source = imagecreatefromjpeg($path);
    $dest1 = imagecreatetruecolor($newwidth, $newheight);
	$exif = exif_read_data($path);
	$orientation = $exif['Orientation'];
    $ret = imagecopyresampled($dest1, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	switch($orientation)
    {
    case 2: // horizontal flip
        break;
    case 3: // 180 rotate left
		$dest1 = imagerotate($dest1, 180, 0);
		break;
    case 4: // vertical flip
		break;
    case 5: // vertical flip + 90 rotate right
        $dest1 = imagerotate($dest1, -90, 0);
        break;
    case 6: // 90 rotate right
        $dest1 = imagerotate($dest1, -90, 0);
        break;
    case 7: // horizontal flip + 90 rotate right
		$dest1 = imagerotate($dest1, -90, 0);
		break;
    case 8: // 90 rotate left
		$dest1 = imagerotate($dest1, 90, 0);
	}

    imagejpeg($dest1, $newpath);

    $dest2 = imagecreatetruecolor($smallwidth, $smallheight);
    $ret = imagecopyresampled($dest2, $dest1, 0, 0, 0, 0, $smallwidth, $smallheight, $width, $height);

	switch($orientation)
    {
    case 2: // horizontal flip
        break;
    case 3: // 180 rotate left
		break;
    case 4: // vertical flip
		break;
    case 5: // vertical flip + 90 rotate right
        $dest2 = imagerotate($dest2, -90, 0);
        break;
    case 6: // 90 rotate right
        $dest2 = imagerotate($dest2, -90, 0);
        break;
    case 7: // horizontal flip + 90 rotate right
		$dest2 = imagerotate($dest2, -90, 0);
		break;
    case 8: // 90 rotate left
		$dest2 = imagerotate($dest2, 90, 0);
	}

    imagejpeg($dest2, $thumbpath);
    imagedestroy($dest1);
    imagedestroy($dest2);
    imagedestroy($source);

    ///////////////////////////////////////////////////////////
    // add path to table sake_image
    ///////////////////////////////////////////////////////////
    $sql = "INSERT INTO " .$tablename ."(sake_id, contributor, filename, added_date, desc, status) VALUES('$id', '$contributor', '$fileName', '$in_time', '$desc', '$status')";
    $ret = executequery($db, $sql);
    
    if(!$ret) {
		$return = '登録できません、このイメージはすでに登録されています、ID:' .$id .' filename:' .$fileName;
		echo '["' .$return .'", "upload failed"]';
		return 0;
	}

    echo '["' .$fileName .'", "upload is complete", "' .$id .'", "' .$sql .'", "' .$width .'", "' .$height .'"]';
	return 1;
} 
else 
{
    echo '["move_uploaded_file function failed"]';
	return 1;
}

