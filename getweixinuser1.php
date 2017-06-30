<?php
require("admin/config.php");

//获取当前微信用户
$api = $w3cview->select("siteset", "id='1'");
define("APPID", $api['appid']);
define("APPSECRET", $api['appsecret']);
$open = getopenid($_GET['code']);
$weixinuser = $open['openid'];
$member = $w3cview->select("member", "username='".$weixinuser."'");
$_SESSION['memberid'] = $member['id'];
$_SESSION['nickname'] = $member['nickname'];
header("Location:".$_GET['mod']);

function getopenid($code)
{
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code"); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$tmpInfo = curl_exec($ch); 
	if (curl_errno($ch)) {  
	  echo 'Errno'.curl_error($ch);
	}
	curl_close($ch); 
	$arr = json_decode($tmpInfo,true);
	return $arr;
}
?>