<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>追加フォーム</title>
</head>
<p>file information</p>
  
<?php
if($handle = opendir("images/"))
{
    while(false !== ($file = readdir($handle))) 
    {
        if($file != "." && $file != "..") 
        {
            $path = "images/".$file;
            $thumbpath = "/sake/images/photo/thumb/".$file;

            echo "$path\n";
            list($width, $height, $type) = getimagesize($path);
            print("<div>imagesize width:" .$width ." height:" .$height ."<br /></div>");

            if(($width > 200 && $width > $height) && $type == IMAGETYPE_JPEG)
            {
                $newwidth = 200;
                $newheight = $height * ($newwidth / $width);
                
                $source = imagecreatefromjpeg($path);
                $dest = imagecreatetruecolor($newwidth, $newheight);
                
                //imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($dest, $thumbpath);

                imagedestroy($dest);
                imagedestroy($source);
                print("<div>thumbpath:" .$thumbpath ." new imagesize width:" .$newwidth ." height:" .$newheight ."</div>");
            }
            else if(($height > 200 && $height > $width) && $type == IMAGETYPE_JPEG)
            {
                $newheight = 200;
                $newwidth = $width * ($newheight / $height);
                
                $source = imagecreatefromjpeg($path);
                $dest = imagecreatetruecolor($newwidth, $newheight);
                
                //imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($dest, $thumbpath);

                imagedestroy($dest);
                imagedestroy($source);
                print("<div>thumbpath:" .$thumbpath ." new imagesize width:" .$newwidth ." height:" .$newheight ."</div>");
            }
            else if(($height > 200 && $height == $width) && $type == IMAGETYPE_JPEG)
            {
                $newheight = 200;
                $newwidth = $newheight;
                
                $source = imagecreatefromjpeg($path);
                $dest = imagecreatetruecolor($newwidth, $newheight);
                
                imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($dest, $thumbpath);

                imagedestroy($dest);
                imagedestroy($source);
                print("<div>thumbpath:" .$thumbpath ." new imagesize width:" .$newwidth ." height:" .$newheight ."</div>");
            }
            else
            {
                print("<div>unknown:" .$path ." imagesize width:" .$width ." height:" .$height ."</div>");
            }
            
            echo "<br />";
        }
    }
    closedir($handle);
}
?>

<p>done</p>
</body>
</html>