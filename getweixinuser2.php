<?php
require("admin/config.php");

//获取当前微信用户
$api = $w3cview->select("siteset", "id='1'");
define("APPID", $api['appid']);
define("APPSECRET", $api['appsecret']);
$open = getopen($_GET['code']);
$openid = $open['openid'];
$user = curl_user($open['access_token'], $open['openid']);
if(!empty($user) && $user['nickname'] != "")
{
	$sql = "select id,nickname from " . $w3cview->prefix . "member where username='".$openid."'";
	$query = $w3cview->query($sql);
	if($arr = mysql_fetch_array($query))
	{
		$_SESSION['memberid'] = $arr['id'];
		$_SESSION['nickname'] = $arr['nickname'];
	}
	else{
		$w3cview->query("insert into " . $w3cview->prefix . "member set `username`='".$openid."',`nickname`='".$user['nickname']."',`logo`='".$user['headimgurl'].".jpg',`registertime`='".date("Y-m-d H:i:s")."'");
		$member = $w3cview->select("member", "username='".$openid."'");
		$_SESSION['memberid'] = $member['id'];
		$_SESSION['nickname'] = $member['nickname'];
	}
}
header("Location:".$_GET['mod']);

//获取access_token和openid
function getopen($code)
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

//获取用户信息
function curl_user($ACCESS_TOKEN, $OPENID)
{
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/userinfo?access_token=".$ACCESS_TOKEN."&openid=".$OPENID); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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