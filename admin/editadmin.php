<?php
require_once('config.php');
require_once('sessionuser.php');
$arr = $w3cview->select("admin", "username='".$_SESSION['username']."'");
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
 if (theform.password.value == "")
  {
    alert('请输入密码。');
    theform.password.focus();
    return (false);
  }
 if (theform.confpass.value == "")
  {
    alert('请输入确认密码。');
    theform.confpass.focus();
    return (false);
  }
 if (theform.password.value != theform.confpass.value)
  {
    alert('密码和确认密码不一致，请输入密码。');
    theform.password.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 修改用户</TD></TR>
</TABLE>
<form method='post' action='editadminsave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD width="10%" align=center>用户名：</TD>
      <TD style="COLOR: #880000"><?php echo $_SESSION['username'];?></TD>
    </TR>
    <TR>
      <TD align=center>密码：</TD>
      <TD style="COLOR: #880000"><input type="password" name="password" id="password"></TD>
    </TR>
    <TR>
      <TD align=center>确认密码：</TD>
      <TD style="COLOR: #880000"><input type="password" name="confpass" id="confpass"></TD>
    </TR>
    <TR>
      <TD width="10%" align=center>用户类型：</TD>
      <TD style="COLOR: #880000">
      <?php if($_SESSION['super'] == "1"){?>超级管理员<?php }?>
       <?php if($_SESSION['super'] == "0"){?>普通管理员<?php }?></TD>
    </TR>
    <TR>
      <TD align=center>&nbsp;</TD>
      <TD style="COLOR: #880000"><input  type='submit' name='Submit' value=' 修 改 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>