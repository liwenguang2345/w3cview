<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("default"=>$_POST['defaulturl'], "title"=>$_POST['title'], "keywords"=>$_POST['keywords'], "description"=>$_POST['description'], "secretapp"=>$_POST['secretapp'], "sappflag"=>$_POST['sappflag'], "api"=>$_POST['api'], "token"=>$_POST['token'], "appid"=>$_POST['appid'], "appsecret"=>$_POST['appsecret'], "account"=>$_POST['account'], "password"=>$_POST['password'], "ucserver"=>$_POST['ucserver'], "ucbase"=>$_POST['ucbase'], "ubasepre"=>$_POST['ubasepre'], "ucappid"=>$_POST['ucappid'], "ucip"=>$_POST['ucip'], "logo"=>$_POST['logo'], "copyright"=>$_POST['copyright'], "rewrite"=>$_POST['rewrite'], "qq"=>$_POST['qq'], "qqapp_id"=>$_POST['qqapp_id'], "qqapp_secret"=>$_POST['qqapp_secret'], "qqaccess_token"=>$_POST['qqaccess_token']);
if($w3cview->edit("siteset", $couple, "id='".$_POST['id']."'")) echo "<script>alert('站点信息修改成功');location='siteset.php';</script>";
else echo "<script>alert('站点信息修改失败');location='siteset.php';</script>";
?>