<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta content='width=device-width, initial-scale=1' name='viewport'/>  
<head>
  <title>HTML5 でドラッグ＆ドロップ</title>
</head>

<body>
  <div id="droppable" style="border: gray solid 1em; padding: 2em;">ファイルをドロップしてください。</div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript">

  $(function() {
    var droppable = $("#droppable");

    // File API が使用できない場合は諦めます.
    if(!window.FileReader) {
      alert("File API がサポートされていません。");
      return false;
    }

    // イベントをキャンセルするハンドラです.
    var cancelEvent = function(event) {
        event.preventDefault();
        event.stopPropagation();
        return false;
    }

    // dragenter, dragover イベントのデフォルト処理をキャンセルします.
    droppable.bind("dragenter", cancelEvent);
    droppable.bind("dragover", cancelEvent);

    // ドロップ時のイベントハンドラを設定します.
    var handleDroppedFile = function(event) {

			alert("droppedfile");

      // ファイルは複数ドロップされる可能性がありますが, ここでは 1 つ目のファイルを扱います.
      var file = event.originalEvent.dataTransfer.files[0];

      // ファイルの内容は FileReader で読み込みます.
      var fileReader = new FileReader();
      
			fileReader.onload = function(event) {
        // event.target.result に読み込んだファイルの内容が入っています.
        // ドラッグ＆ドロップでファイルアップロードする場合は result の内容を Ajax でサーバに送信しましょう!
        $("#droppable").text("[" + file.name + "]" + event.target.result);
      }

      fileReader.readAsText(file);

      // デフォルトの処理をキャンセルします.
      cancelEvent(event);
      return false;
    }

    // ドロップ時のイベントハンドラを設定します.
    droppable.bind("drop", handleDroppedFile);
  });
</script>
</html>