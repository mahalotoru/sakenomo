<?php
require_once("html_disp.php");
require_once("hamburger.php");
require_once("searchbar.php");
require_once("nonda.php");
?>

<!DOCTYPE html>

<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta content='width=device-width, initial-scale=1' name='viewport'/>
<title>Sakenomo</title>
<link rel="stylesheet" type="text/css" href="css/common.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" type="text/css" href="css/hamburger.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" type="text/css" href="css/searchbar.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" type="text/css" href="css/nonda.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" type="text/css" href="css/mail_registry_complete.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/sakenomuui.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
<script src="js/searchbar.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
<script src="js/nonda.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
<script src="js/hamburger.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
</head>

<body>

	<?php
		include_once('images/icons/svg_sprite.svg');
		write_side_menu();
		write_HamburgerLogo();
		write_search_bar();
		write_Nonda();

		$username = $_GET['username'];
	?>

	<div id="container">
		<div id="registry_user_container">
			<div class="registry_user_title">会員登録が完了しました</div>

			<div id="registry_user_content">
				<div class="row_container">
          <div class="column1_container">
            <div class="column1">マイページからプロフィールを編集することができます。</div>
          </div>
          <div class="column2">
            <?php print('<a href="user_view_config_profile.php?username=' .$username .'">プロフィール編集へ</a>'); ?>
          </div>
        </div>
			</div>

			<a class="top_link_button" href="sake_search.php"><span>Top Page</span></a>

		</div>
	</div>

	<?php
		writefooter();
	?>

</body>

<script type="text/javascript">

	jQuery(document).ready(function(){

		$("body").wrapInner('<div id="wrapper"></div>');

		$('#email').change(function() {
			var txt = $(this).val();
			var han = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});
			$(this).val(han);
		});

	}); // jQuery ready

</script>
</html>
