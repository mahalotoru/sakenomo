<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<body>

<form id="target" action="">
  <input type="text" value="Hello there">
  <input type="submit" value="Go">
</form>

<div id="other">
  Trigger the handler
</div>

<script type="text/javascript">

$( "#target" ).submit(function( event ) {
  alert( "Handler for .submit() called." );
  event.preventDefault();
});

$( "#other" ).click(function() {
  $( "#target" ).submit();
});

function check()
{
  var imgpath=document.getElementById('imgfile');

  if(!imgpath.value=="")
  {
      var img=imgpath.files[0].size;
      var imgsize=img/1024; 
      alert(imgsize);
  }
}

</script>  
</body>
</html>
