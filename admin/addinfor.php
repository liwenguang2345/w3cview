<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</HEAD>
<BODY>
<script language='JavaScript'>
function chk(theform)
{
 if (theform.title.value == "")
  {
    alert('请输入信息标题。');
    theform.title.focus();
    return (false);
  }
}
</script>
<script src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script>
KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="note"]', {
		cssPath : 'kindeditor/plugins/code/prettify.css',
		uploadJson : 'kindeditor/php/upload_json.php',
		fileManagerJson : 'kindeditor/php/file_manager_json.php',
		allowFileManager : true,
		afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=example]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=example]')[0].submit();
			});
		}
	});
});
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 添加信息</TD></TR>
</TABLE>
<form method='post' action='addinforsave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD width="10%" align=center>信息标题：</TD>
      <TD style="COLOR: #880000"><input type="text" name="title" id="title"></TD>
    </TR>
    <TR>
      <TD align=center>信息内容：</TD>
      <TD style="COLOR: #880000"><textarea id="note" name="note" style="width:100%;height:650px;visibility:hidden;"></textarea></TD>
    </TR>
    <TR>
      <TD colspan="2" align=center><input  type='submit' name='Submit' value=' 添 加 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>