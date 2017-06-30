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
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 添加菜单</TD></TR>
</TABLE>
<form method='post' action='addmenusave.php' name='myform'>  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD align=center>上级菜单：</TD>
      <TD style="COLOR: #880000">
      <select name="parentid">
	  <option value="0">请选择上级菜单</option>
	  <?php
      $sql = "select * from " . $w3cview->prefix . "menu";
	  $result = $w3cview->query($sql);
	  while ($arr = mysql_fetch_array($result)){?>
		  <option value="<?php echo $arr['id'];?>"><?php echo $arr['title'];?></option>
	  <?php }?>
      </select>
    </TD>
    </TR>
    <TR>
      <TD align=center>菜单名称：</TD>
      <TD style="COLOR: #880000"><input type="text" name="title" id="title">
      </TD>
    </TR>
    <TR>
      <TD align=center>KEY值：</TD>
      <TD style="COLOR: #880000"><input type="text" name="key" id="key">
      </TD>
    </TR>
    <TR>
      <TD align=center>菜单链接：</TD>
      <TD style="COLOR: #880000"><textarea name="url" cols="80" rows="5" id="url"></textarea>
      </TD>
    </TR>
    <TR>
      <TD align=center>&nbsp;</TD>
      <TD style="COLOR: #880000"><input  type='submit' name='Submit' value=' 添 加 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>