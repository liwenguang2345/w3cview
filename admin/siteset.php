<?php
require_once('config.php');
require_once('sessionuser.php');
$arr = $w3cview->select("siteset", "id='1'");
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
    alert('请输入网站名称。');
    theform.title.focus();
    return (false);
  }
  if (theform.keywords.value == "")
  {
    alert('请输入网站关键字。');
    theform.keywords.focus();
    return (false);
  }
  if (theform.description.value == "")
  {
    alert('请输入网站描述。');
    theform.description.focus();
    return (false);
  }
  if (theform.copyright.value == "")
  {
    alert('请输入版权说明。');
    theform.copyright.focus();
    return (false);
  }
  if (theform.defaulturl.value == "")
  {
    alert('请输入默认首页。');
    theform.defaulturl.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 站点信息</TD></TR>
</TABLE>
<form method='post' action='sitesetsave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD align=center>网站名称title：</TD>
      <TD style="COLOR: #880000"><textarea name="title" cols="60" rows="3"><?php echo $arr['title'];?></textarea></TD>
    </TR>
    <TR>
      <TD align=center>网站关键字Keyword：</TD>
      <TD style="COLOR: #880000"><textarea name="keywords" cols="60" rows="3"><?php echo $arr['keywords'];?></textarea></TD>
    </TR>
    <TR>
      <TD align=center>网站描述Description：</TD>
      <TD style="COLOR: #880000"><textarea name="description" cols="60" rows="3"><?php echo $arr['description'];?></textarea></TD>
    </TR>
    <TR>
      <TD align=center>版权说明copyright：</TD>
      <TD style="COLOR: #880000"><input name="copyright" type=text value="<?php echo $arr['copyright'];?>" size="40"></TD>
    </TR>
    <TR>
      <TD align=center>默认首页：</TD>
      <TD style="COLOR: #880000"><input name="defaulturl" type=text value="<?php echo $arr['default'];?>" size="40"></TD>
    </TR>
    <TR>
      <TD align=center>网站logo：</TD>
      <TD style="COLOR: #880000">
      <input name="logo" id="logo" style='width:300px;' value="<?php echo $arr['logo'];?>">
    <iframe name=I1 frameborder=0 width=300 height=30 scrolling=no src="uploadfile.php?input=logo"></iframe>
    </TD>
    </TR>
    <TR>
      <TD align=center>是否启用伪静态：</TD>
      <TD style="COLOR: #880000"><input name="rewrite" type="checkbox" value="1" <?php if($arr['rewrite'] == 1){?>checked<?php }?>></TD>
    </TR>
    <TR>
      <TD align=center>微信接口地址：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:300px;" name="api" id="api" value="<?php echo $arr['api'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>微信接口token：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:200px;" name="token" id="token" value="<?php echo $arr['token'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>微信AppId：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:200px;" name="appid" id="appid" value="<?php echo $arr['appid'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>微信AppSecret：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:300px;" name="appsecret" id="appsecret" value="<?php echo $arr['appsecret'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>微信公众平台登录帐号：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:200px;" name="account" id="account" value="<?php echo $arr['account'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>微信公众平台登录密码：</TD>
      <TD style="COLOR: #880000"><input type="text" style="width:200px;" name="password" id="password" value="<?php echo $arr['password'];?>"></TD>
    </TR>
    <TR>
      <TD align=center>是否集成QQ登录：</TD>
      <TD style="COLOR: #880000"><input name="qq" type="checkbox" value="1" <?php if($arr['qq'] == 1){?>checked<?php }?>></TD>
    </TR>
    <TR>
      <TD align=center>QQ登录app_id：</TD>
      <TD style="COLOR: #880000"><input name="qqapp_id" type=text value="<?php echo $arr['qqapp_id'];?>" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>QQ登录app_secret：</TD>
      <TD style="COLOR: #880000"><input name="qqapp_secret" type=text value="<?php echo $arr['qqapp_secret'];?>" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>QQ登录access_token：</TD>
      <TD style="COLOR: #880000"><input name="qqaccess_token" type=text value="<?php echo $arr['qqaccess_token'];?>" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>是否启用UCenter：</TD>
      <TD style="COLOR: #880000"><input name="sappflag" type="checkbox" value="1" <?php if($arr['sappflag'] == 1){?>checked<?php }?>></TD>
    </TR>
    <TR>
      <TD align=center>UCenter应用ID：</TD>
      <TD style="COLOR: #880000"><input name="ucappid" type=text value="<?php echo $arr['ucappid'];?>" size="10"></TD>
    </TR>
    <TR>
      <TD align=center>UCenter的IP地址：</TD>
      <TD style="COLOR: #880000"><input name="ucip" type=text value="<?php echo $arr['ucip'];?>" size="40"></TD>
    </TR>
    <TR>
      <TD align=center>UCenter的URL地址：</TD>
      <TD style="COLOR: #880000"><input name="ucserver" type=text value="<?php echo $arr['ucserver'];?>" size="60"></TD>
    </TR>
    <TR>
      <TD align=center>UCenter密钥：</TD>
      <TD style="COLOR: #880000"><input name="secretapp" type=text value="<?php echo $arr['secretapp'];?>" size="40"></TD>
    </TR>
    <TR>
      <TD align=center>UCenter数据库名：</TD>
      <TD style="COLOR: #880000"><input name="ucbase" type=text value="<?php echo $arr['ucbase'];?>" size="40"></TD>
    </TR>
    <TR>
      <TD align=center>UCenter数据库表前缀：</TD>
      <TD style="COLOR: #880000"><input name="ubasepre" type=text value="<?php echo $arr['ubasepre'];?>" size="40"></TD>
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