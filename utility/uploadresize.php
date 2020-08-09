<html lang="ja">
<head>
<link rel="stylesheet" type="text/css" href="cgi.sakenomu.org/sakagura/css/header.css" />
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<style>

.navigate_button {
    background: #e3e3e3;
    border: 1px solid #ccc;
    color: #333;
    font-family: "Trebuchet MS", "Myriad Pro", sans-serif;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 0 2px;
    text-align: center;
    height: 20px;
    width: 100px;
    cursor:pointer;
    margin:2px 2px 2px 2px;
    text-shadow: 0px 1px 0px #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -moz-box-shadow: 0px 0px 2px #fff inset;
    -webkit-box-shadow: 0px 0px 2px #fff inset;
    box-shadow: 0px 0px 2px #fff inset;
}

.navigate_button:hover {
    background: #d9d9d9;
    -moz-box-shadow: 0px 0px 2px #eaeaea inset;
    -webkit-box-shadow: 0px 0px 2px #eaeaea inset;
    box-shadow: 0px 0px 2px #eaeaea inset;
    color: #222;
}

.update_button {
    background: #e3e3e3;
    border: 1px solid #ccc;
    color: #333;
    font-family: "Trebuchet MS", "Myriad Pro", sans-serif;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 0 2px;
    text-align: center;
    height: 20px;
    width: 100px;
    cursor:pointer;
    float:right;
    margin:2px 2px 2px 2px;
    text-shadow: 0px 1px 0px #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -moz-box-shadow: 0px 0px 2px #fff inset;
    -webkit-box-shadow: 0px 0px 2px #fff inset;
    box-shadow: 0px 0px 2px #fff inset;
}

.update_button:hover {
    background: #d9d9d9;
    -moz-box-shadow: 0px 0px 2px #eaeaea inset;
    -webkit-box-shadow: 0px 0px 2px #eaeaea inset;
    box-shadow: 0px 0px 2px #eaeaea inset;
    color: #222;
}

.update_button:active {
    background: #136899;
    /*box-shadow: 0 3px 1px #0f608c;*/
}

.delete_button {
    background: #e3e3e3;
    border: 1px solid #ccc;
    color: #333;
    font-family: "Trebuchet MS", "Myriad Pro", sans-serif;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 0 2px;
    text-align: center;
    height: 20px;
    width: 100px;
    cursor:pointer;
    float:right;
    margin:2px 2px 2px 2px;
    text-shadow: 0px 1px 0px #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -moz-box-shadow: 0px 0px 2px #fff inset;
    -webkit-box-shadow: 0px 0px 2px #fff inset;
    box-shadow: 0px 0px 2px #fff inset;
}

.delete_button:hover {
    background: #d9d9d9;
    -moz-box-shadow: 0px 0px 2px #eaeaea inset;
    -webkit-box-shadow: 0px 0px 2px #eaeaea inset;
    box-shadow: 0px 0px 2px #eaeaea inset;
    color: #222;
}

.delete_button:active {
    background: #136899;
    /*box-shadow: 0 3px 1px #0f608c;*/
}

.navi_wrapper input[type="button"] {
    border: none;
    background: #1e75aa;
    font-family: "メイリオ", "Myriad Pro", Arial, sans-serif;
    height: 20px;
    width: 100px;
    color: #ffffff;
    text-align: center;
    border-radius: 5px;
    margin:0px 4px 0px 0px;

    text-align: center;
    border-radius: 5px;
    margin:0px 4px 0px 0px;

      /*box-shadow: 0px 3px 1px #2075aa;*/
	    -webkit-transition: all 0.15s linear;
      -moz-transition: all 0.15s linear;
      transition: all 0.15s linear;
}

.navi_wrapper input[type="button"]:hover {
    background: #d9d9d9;
    -moz-box-shadow: 0px 0px 2px #eaeaea inset;
    -webkit-box-shadow: 0px 0px 2px #eaeaea inset;
    box-shadow: 0px 0px 2px #eaeaea inset;
    color: #222;
}

table, td, th {
    border: 1px solid black;
}

table {
    width: 200%;
    table-layout: fixed;
}

th {
    height: 30px;
}

#page {
    border: 0px solid black;
    font-family: "メイリオ", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#page td, #page th {
    font-size: 0.8em;
    border: 0px solid #626262;
    padding: 2px 2px 2px 2px;
}

#page th {
    color: #ffffff;
    background-color: #626262;
}

#page tr.alt td {
    color: #000000;
    background-color: #e3e3e3;
}

#customers {
    font-family: "メイリオ", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 0.8em;
    border: 0px solid #626262;
    padding: 3px 7px 2px 7px;
}

#customers th {
    color: #ffffff;
    background-color: #626262;
	text-align: left;
}

#customers tr.alt td {
    color: #000000;
    background-color: #e3e3e3;
}

nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    position: relative;
    float: right;
    background: #eee;
    border-bottom: 1px solid #fff;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;    
}

nav li {
  float: left;          
}

nav #login {
    border-right: 1px solid #ddd;
    -moz-box-shadow: 1px 0 0 #fff;
    -webkit-box-shadow: 1px 0 0 #fff;
    box-shadow: 1px 0 0 #fff;  
}

nav #login-trigger,
nav #signup a {
    display: inline-block;
    *display: inline;
    *zoom: 1;
    height: 25px;
    line-height: 25px;
    font-weight: bold;
    padding: 0 8px;
    text-decoration: none;
    color: #444;
    text-shadow: 0 1px 0 #fff; 
}

nav #signup a {
    -moz-border-radius: 0 3px 3px 0;
    -webkit-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;
}

nav #login-trigger {
    -moz-border-radius: 3px 0 0 3px;
    -webkit-border-radius: 3px 0 0 3px;
    border-radius: 3px 0 0 3px;
}

nav #login-trigger:hover,
nav #login .active,
nav #signup a:hover {
    background: #fff;
}

nav #login-content {
    display: none;
    position: absolute;
    top: 24px;
    right: 0;
    z-index: 999;    
    background: #fff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));
    background-image: -webkit-linear-gradient(top, #fff, #eee);
    background-image: -moz-linear-gradient(top, #fff, #eee);
    background-image: -ms-linear-gradient(top, #fff, #eee);
    background-image: -o-linear-gradient(top, #fff, #eee);
    background-image: linear-gradient(top, #fff, #eee);  
    padding: 15px;
    -moz-box-shadow: 0 2px 2px -1px rgba(0,0,0,.9);
    -webkit-box-shadow: 0 2px 2px -1px rgba(0,0,0,.9);
    box-shadow: 0 2px 2px -1px rgba(0,0,0,.9);
    -moz-border-radius: 3px 0 3px 3px;
    -webkit-border-radius: 3px 0 3px 3px;
    border-radius: 3px 0 3px 3px;
}

nav li #login-content {
    right: 0;
    width: 250px;  
}

</style>
<title>写真の追加</title></head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<body>

<div id="navi_wrapper" class="navi_wrapper">
<nav>
	<ul>
		<li id="home">
			<a href="sake_image.php?sake_id=<?php print($_GET['sake_id']);?>"><button class="update_button" id="return_to_home" style="width:100px;">前に戻る</button></a>
		</li>
		<li id="login">
			<a id="login-trigger" href="#">
				Log out <span>&#x25BC;</span>
			</a>
			<div id="login-content">
				<form>
					<fieldset id="inputs">
            <?php
              print("<input id=\"username\" type=\"email\" name=\"Email\" placeholder=\"Your email address\" required value=" .$_COOKIE['login_cookie'] .">");   
						  print("<input id=\"password\" type=\"password\" name=\"Password\" placeholder=\"Password\" required value=" .$_COOKIE['password_cookie'] .">");   
            ?>
          </fieldset>
					<fieldset id="actions">
						<input type="button" id="logout" value="Log out">
						<label><input type="checkbox" checked="checked"> Keep me signed in</label>
					</fieldset>
				</form>
			</div>                     
		</li>

		<li id="username">
			<?php print("<a href=\"user_view.php?username=".$_COOKIE['login_cookie']."\">".$_COOKIE['login_cookie']."</a>"); ?>
		</li>
	</ul>
</nav>
</div>
  
<?php

require_once("db_functions.php");

function convert_img($img_data) {
    $base64 = base64_encode($img_data);
    $mime = 'image/jpg';
    return 'data:'.$mime.';base64,'.$base64;
}

if(!$db = opendatabase("sake.db"))
{
   die("データベース接続エラー .<br />");
}

$updir = "/sakagura/images/";
$in_time = time();
$filename = $in_time.$_FILES['upfile']['name'];
$path = "/sakagura/images/".$filename;
    
if(move_uploaded_file($_FILES['upfile']['tmp_name'], $updir.$filename) == FALSE)
{
    print("Upload failed...");
    print($_FILES['upfile']['error']);
}
else 
{
    $sake_id = $_GET['sake_id'];
    $sql = "select sake_id from SAKE_IMAGE where sake_id = '$sake_id' and filename = '$filename'";
    $res = executequery($db, $sql);

    $row = getnextrow($res);

    if($row) 
    {
	      die("同じファイル名が存在します。登録できませんでした。<br><a href=\"sake_search.php\">検索画面に戻る</a><br></body></html>");
    }
    else
    {
        //header('Content-Type: image/jpeg');
        list($width, $height, $type) = getimagesize($path);
        print("<div>imagesize width:" .$width ." height:" .$height ."<br /></div>");
        
        if(($width > 1600 && $height > 1200) || ($height > 1600 && $width > 1200))
        {
            print("<div>ファイルのサイズが大きすぎます<br />縦:1200 x 横:1600 以下のイメージをアップしてください。</div><br /></body></html>");
		        $ret = unlink($path);	
            return 0;
        }
        else if(($width > 640 && $width > $height) && $type == IMAGETYPE_JPEG)
        {
            $newwidth = 640;
            $newheight = $height * ($newwidth / $width);
            
            $source = imagecreatefromjpeg($path);
            $dest = imagecreatetruecolor($newwidth, $newheight);
            
            imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($dest, $path);

            
            //header('Content-Type: image/jpeg');
            //print("<img alt=\"105x105\" class=\"img-responsive\" src=\"data:image/jpg;charset=utf8;base64", .imagejpeg($dest) ."\"/>");
            //imagejpeg($dest);


            echo('<img src="'.convert_img($dest).'">');
                       
            
            imagedestroy($dest);
            imagedestroy($source);
            print("<div>new imagesize width:" .$newwidth ." height:" .$newheight ."</div>");
        }
        else if(($height > 640 && $height > $width) && $type == IMAGETYPE_JPEG)
        {
            $newheight = 640;
            $newwidth = $width * ($newheight / $height);
            
            $source = imagecreatefromjpeg($path);
            $dest = imagecreatetruecolor($newwidth, $newheight);
            
            imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($dest, $path);

            imagedestroy($dest);
            imagedestroy($source);
            print("<div>new imagesize width:" .$newwidth ." height:" .$newheight ."</div>");
        }

        $sql = "INSERT INTO SAKE_IMAGE VALUES('$sake_id', '$filename')";

	      executequery($db, $sql)
		      or die("Insert登録できませんでした。この酒蔵IDはすでに登録されています。<br /><a href=\"sake_search.php\">検索画面に戻る</a><br /></body></html>");

        print("<div>" . $filename . "</b> uploaded!</div>");
        print("<div><img src=\"" .$path  ."\"></div>");
    }
}

?>
</body>
</html>
