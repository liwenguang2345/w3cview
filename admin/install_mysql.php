<?php
function checkwrite() {
	$flag=false;
	if(file_put_contents("../test.txt","test")){
		$flag=true;
		@unlink("../test.txt");
	}
	if(mkdir("../test",0777)){
		$flag=true;
		@rmdir("../test");
	}
	return $flag;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>W3CVIEW视野CMS系统</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 14px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/main_bg.gif);
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>

<body>
<script language="javascript">
function check()
{
    if (document.myform.machine.value=="")
	{
	    alert("请输入服务器");
		document.myform.machine.focus();
		return false;
	}
	if (document.myform.username.value=="")
	{
	    alert("请输入登陆用户");
		document.myform.username.focus();
		return false;
	}
	if (document.myform.password.value=="")
	{
	    alert("请输入登陆密码");
		document.myform.password.focus();
		return false;
	}
	if (document.myform.database.value=="")
	{
	    alert("请输入数据库名");
		document.myform.database.focus();
		return false;
	}
	if (document.myform.prefix.value=="")
	{
	    alert("请输入表前缀");
		document.myform.prefix.focus();
		return false;
	}
	if (document.myform.uname.value=="")
	{
	    alert("请输入管理员用户名");
		document.myform.uname.focus();
		return false;
	}
	if (document.myform.pword.value=="")
	{
	    alert("请输入管理员密码");
		document.myform.pword.focus();
		return false;
	}
}
</script>
<form name="myform" method="post" action="installok_mysql.php" onsubmit="return check();">
  <table width="503" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td height="19" colspan="2" align="center"><img src="images/logo.png" width="503" height="72" /></td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center"><strong>MYSQL数据库安装界面</strong></td>
    </tr>
     <tr>
      <td width="162" height="40" align="center">服务器：</td>
      <td width="342" align="left"><input name="machine" type="text" value="localhost" /></td>
    </tr>
    <tr>
      <td height="40" align="center">登陆用户：</td>
      <td align="left"><input name="username" type="text" /></td>
    </tr>
    <tr>
      <td height="40" align="center">登陆密码：</td>
      <td align="left"><input name="password" type="password" /></td>
    </tr>
    <tr>
      <td height="40" align="center">数据库名：</td>
      <td align="left"><input name="database" type="text" /></td>
    </tr>
    <tr>
      <td height="40" align="center">表前缀：</td>
      <td align="left"><input name="prefix" type="text" value="w3cview_" /></td>
    </tr>
	<tr>
      <td height="40" align="center">管理员用户名：</td>
      <td align="left"><input name="uname" type="text" /></td>
    </tr>
	<tr>
      <td height="40" align="center">管理员密码：</td>
      <td align="left"><input name="pword" type="password" /></td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center">	  
	  <input type="submit" name="Submit" value="安装" <?php if(!checkwrite()){?>disabled="disabled"<?php }?>>
	  <input type="reset" name="reset" value="重置"></td>
    </tr>
  </table>
</form>
<div align="center">版权所有 <a href="http://www.w3cview.com" target="_blank">W3CVIEW视野</a></div>
</body>
</html>
