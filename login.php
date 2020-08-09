<html lang="ja">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
<meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta content='width=device-width, initial-scale=1' name='viewport'/>  
</head>

<title>sakenomu login</title>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />

<body>
<div class="wrapper">
	<center>
	<h1>管理人用ログイン</h1>
	</center>
	<div class="content">
		<div id="form_wrapper" class="form_wrapper">
			<form class="register">
				<h3>Register</h3>
				<div class="column">
					<div>
						<label>First Name:</label>
						<input type="text" />
						<span class="error">This is an error</span>
					</div>
					<div>
						<label>Last Name:</label>
						<input type="text" />
						<span class="error">This is an error</span>
					</div>
					<div>
						<label>Website:</label>
						<input type="text" value="http://"/>
						<span class="error">This is an error</span>
					</div>
				</div>
				<div class="column">
					<div>
						<label>Username:</label>
						<input type="text"/>
						<span class="error">This is an error</span>
					</div>
					<div>
						<label>Email:</label>
						<input type="text" />
						<span class="error">This is an error</span>
					</div>
					<div>
						<label>Password:</label>
						<input type="password" />
						<span class="error">This is an error</span>
					</div>
				</div>
				<div class="bottom">
					<div class="remember">
						<input type="checkbox" />
						<span>Send me updates</span>
					</div>
					<input type="button" id="button" value="登録">

					<a href="index.html" rel="login" class="linkform">戻る</a>
					<div class="clear"></div>
				</div>
			</form>

			<form class="login active" id="form" name="form" method="post">
				<h3 style="color:#fff">Login</h3>
				<div>
					<label>ユーザー名</label>
					<input type="text" name="username" />
					<span class="error">This is an error</span>
				</div>
				<div>
					<label>パスワード <a href="forgot_password.html" rel="forgot_password" class="forgot linkform">Forgot your password?</a></label>
					<input type="password" name="pw" />
					<p id="sample1">入力してください。</p>
					<span class="error">This is an error</span>
				</div>
				<div class="bottom">
					<div class="remember"><input type="checkbox" /><span>Keep me logged in</span></div>
					<input type="button" id="button" value="ログイン">
					<a href="user_add_form.php" rel="register">新規登録 sakenomo</a>
					<a href="#register" rel="register" class="linkform">新規登録トランスフォーム</a>
					<div class="clear"></div>
				</div>
			</form>
			
			<form class="forgot_password">
				<h3>Forgot Password</h3>
				<div>
					<label>Username or Email:</label>
					<input type="text" />
					<span class="error">This is an error</span>
				</div>
				<div class="bottom">
					<input type="button" id="button" value="Send reminder">
					<a href="index.html" rel="login" class="linkform">Suddenly remebered? Log in here</a>
					<div class="clear"></div>
				</div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>


<!-- The JavaScript -->
<script type="text/javascript">

$(function() {
		//the form wrapper (includes all forms)
	var $form_wrapper	= $('#form_wrapper'),
		//the current form is the one with class active
		$currentForm	= $form_wrapper.children('form.active'),
		//the change form links
		$linkform		= $form_wrapper.find('.linkform');
			
	//get width and height of each form and store them for later						
	$form_wrapper.children('form').each(function(i){
		var $theForm = $(this);
		//solve the inline display none problem when using fadeIn fadeOut
		if(!$theForm.hasClass('active'))
			$theForm.hide();
		$theForm.data({
			width	: $theForm.width(),
			height	: $theForm.height()
		});
	});
	
	//set width and height of wrapper (same of current form)
	setWrapperWidth();
	
	/*
	clicking a link (change form event) in the form
	makes the current form hide.
	The wrapper animates its width and height to the 
	width and height of the new current form.
	After the animation, the new form is shown
	*/

	$linkform.bind('click', function(e){
		var $link	= $(this);
		var target	= $link.attr('rel');
		$currentForm.fadeOut(400, function(){
			//remove class active from current form
			$currentForm.removeClass('active');
			//new current form
			$currentForm= $form_wrapper.children('form.'+target);
			//animate the wrapper
			$form_wrapper.stop()
						 .animate({
								width	: $currentForm.data('width') + 'px',
								height	: $currentForm.data('height') + 'px'
						 },500,function(){
								//new form gets class active
								$currentForm.addClass('active');
								//show the new form
								$currentForm.fadeIn(400);
						 });
		});
		e.preventDefault();
	});
	
	function setWrapperWidth(){
		$form_wrapper.css({
			width	: $currentForm.data('width') + 'px',
			height	: $currentForm.data('height') + 'px'
		});
	}
});

jQuery(document).ready(function(){
  $(document).on('click','#button', function(){
	var data = $("#form").serialize(); //<form id="form"...から送信される値をシリアライズ
	 
	  $.ajax({
			type: "post",
			url: "http://drinksake.xsrv.jp/toru/user_login.php",
			data: data,
	  }).done(function(xml){
		  var str = $(xml).find("str").text();
  
		  if(str == "success")
			  window.open('http://drinksake.xsrv.jp/toru/sake_search.php', '_self');
		  else
			  $("#sample1").text('パスワードが違います');
	  }).fail(function(data){
		  alert(str);				 
		  $("#sample1").text('This is Error');
	  });
  });
});


</script>
</body>
</html>
