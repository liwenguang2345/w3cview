<?php
require_once('config.php');
require_once('sessionuser.php');
$arr = $w3cview->select("newsclass", "id='".$_GET['id']."'");
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
    alert('请输入类别名称。');
    theform.title.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 修改栏目</TD></TR>
</TABLE>
<form method='post' action='editnewsclasssave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD align=center>类别名称：</TD>
      <TD style="COLOR: #880000"><input type="text" name="title" id="title" value="<?php echo $arr['title'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>&nbsp;</TD>
      <TD style="COLOR: #880000"><input  type='submit' name='Submit' value=' 修 改 ' style='cursor:hand;'>
      <input name="id" type="hidden" id="id" value="<?php echo $arr['id'];?>">
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>