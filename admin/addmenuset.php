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
    alert('请输入栏目名称。');
    theform.title.focus();
    return (false);
  }
 if (theform.url.value == "")
  {
    alert('请输入栏目链接。');
    theform.url.focus();
    return (false);
  }
 if (theform.sorts.value == "")
  {
    alert('请输入栏目序号。');
    theform.sorts.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 添加  <a href="addmenuset.php?grade=1" style="FONT-WEIGHT: bold; COLOR: #ffffff" >一级栏目</a> <a href="addmenuset.php?grade=2" style="FONT-WEIGHT: bold; COLOR: #ffffff" >二级栏目</a></TD></TR>
</TABLE>
<form method='post' action='addmenusetsave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <?php if($_GET["grade"]=="2"){?>
    <TR>
      <TD width="10%" align=center>上级栏目：</TD>
      <TD style="COLOR: #880000">
      <select name="parent" id="parent">
      <?php
	  $query = $w3cview->query("select * from " . $w3cview->prefix . "menuset where parent=0");
	  while($arr = mysql_fetch_array($query)){
	  ?>
      <option value="<?php echo $arr["id"];?>"><?php echo $arr["title"];?></option>
      <?php
	  }?>
      </select>
      </TD>
      </TR>
    <?php
	}
	else{?>
    <input type="hidden" name="parent" id="parent" value="0">
    <?php
	  }?>
    <TR>
      <TD width="10%" align=center>栏目名称：</TD>
      <TD style="COLOR: #880000"><input type="text" name="title" id="title"></TD>
    </TR>
    <TR>
      <TD align=center>栏目链接：</TD>
      <TD style="COLOR: #880000"><input name="url" type="text" id="url" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>栏目序号：</TD>
      <TD style="COLOR: #880000"><input type="text" name="sorts" id="sorts" onKeyUp="value=value.replace(/[^\d]/g,'')"></TD>
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