<?php
require_once('config.php');
require_once('sessionuser.php');

$api = $w3cview->select("siteset", "id='1'");
$token = $api['token'];
$appid = $api['appid'];
$appsecret = $api['appsecret'];

$keyword = array();
$sql = "select * from " . $w3cview->prefix . "menu where parentid='0' order by id asc";
$result = $w3cview->query($sql);
while($arr = mysql_fetch_array($result))
{
	$sqls = "select * from " . $w3cview->prefix . "menu where parentid='$arr[id]' order by id asc";
	if($w3cview->getrecordcount($sqls) > 0)
	{
		$results = $w3cview->query($sqls);
		while($arrs = mysql_fetch_array($results))
		{
			$kk[] = array('type'=>'view','name'=>urlencode($arrs['title']),'url'=>$arrs['url']); 
		}
		$keyword['button'][] = array('type'=>'click','name'=>urlencode($arr['title']),'sub_button'=>$kk);
		$kk = array();
	}
	else $keyword['button'][] = array('type'=>'click','name'=>urlencode($arr['title']),'key'=>$arr['key']);
}
$data = json_encode($keyword);
$ACCESS_LIST = curl($appid, $appsecret);//获取到的凭证
if($ACCESS_LIST['access_token']!='')
{
	$access_token = $ACCESS_LIST['access_token'];//获取到ACCESS_TOKEN
	$data = stripslashes(urldecode($data));
	$msg = curl_menu($access_token,$data);
	if($msg['errmsg'] == 'ok') echo '创建自定义菜单成功!';
	else echo '创建自定义菜单失败!';
        
}
else echo '创建失败,微信AppId或微信AppSecret填写错误';


function curl($appid, $appsecret)
{
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret); 
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
    
function curl_menu($ACCESS_TOKEN, $data)
{
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACCESS_TOKEN); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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