<?php

/* wrapper for sqlite3 */
class Init_class {
	var $db_object;
	var $decode_key = "abcdefg";
	var $db_user  = "usr";
	var $db_pass  = "passwd";
	var $db_host  = "localhost";
	var $db_name  = "kisop";
	var $bbs_name = "キソピー掲示板";

	function Init_class($dbpath)
	{
		$this->db_object = 0; //new DB_class($dbpath);
	}

	function max_length_check($p_string, $p_length, $p_name)
	{
		if(strlen($p_string) > $p_length)
		{
		    $this->disp_err_message($p_name."が長すぎます(最低半角".$p_length."文字)");
		}
	}

	function min_length_check($p_string, $p_length, $p_name)
	{
		if(strlen($p_string) < $p_length)
		{
		$this->disp_err_message($p_name."が短すぎます(最低半角".$p_length."文字)");
		}
	}
    
	function indi_check($p_string,$p_name)
	{
		if(strlen($p_string) == 0)
			{
		    $this->disp_err_message($p_name."は必ず入力してください");
		}
	}
    
	function mail_check($p_string)
	{
		if(strlen($p_string) != 0 && !ereg("^[a-zA-Z0-9_\.\-]+@(([a-zA-Z0-9_\-]+\.)+[a-zA-Z0-9]+$)", $p_string))
			{
		    $this->disp_err_message("メールアドレスを正しく入力してください。");
		}
	}
    
	function uri_check($p_string)
	{
		if(strlen($p_string) != 0 && !ereg("^http://+($|[a-zA-Z0-9_~\.\-\/])+$",$p_string))
		{
		$this->disp_err_message("URLを正しく入力してください｡ ");
		}
	}
    
	function disp_err_message($p_message)
	{
		disp_html_header("エラー");
		$html_string ="<div class = \"title\">".$p_message."</div><hr /><br /><a href=\"#\" onClick=\"history.back(); return false;\">前へ戻る</a>";
		print($html_string);
		$this->db_object->disconnect();
		disp_html_footer();
		return;
    	}
    
	function get_decode_key()
	{
        return $this->decode_key;
    }
}
?>
