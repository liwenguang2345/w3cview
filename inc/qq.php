<?php
//应用的APPID
$app_id = $site_qqapp_id;
//应用的APPKEY
$app_secret = $site_qqapp_secret;
//成功授权后的回调地址
$my_url = "http://" . $_SERVER['SERVER_NAME'] . "/";
//成功授权后返回的access_token
$access_token = $site_qqaccess_token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$code = $_GET["code"];
$state = $_GET["state"];

//Step1：获取Authorization Code
if(empty($code))
{
   //state参数用于防止CSRF攻击，成功授权后回调时会原样带回
   //$_SESSION['state'] = md5(uniqid(rand(), TRUE)); 
   $_SESSION['state'] = 'leher';
   //拼接URL     
   $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="  . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state=" . $_SESSION['state'];
   echo "<script> top.location.href='" . $dialog_url . "'</script>";
}

//Step2：通过Authorization Code获取Access Token
if($_REQUEST['state'] == $_SESSION['state']) 
{
   //拼接URL   
   $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret=" . $app_secret . "&code=" . $code;
   curl_setopt($ch, CURLOPT_URL, $token_url);
   $response = curl_exec($ch);
   if (strpos($response, "access_token") >= 0)
   {
	   $access_token = str_replace("access_token=", "", substr($response, 0, strpos($response, "&")));
   }
   else echo "<script>location='" . changeurl('index.php', $site_rewrite) . "';</script>";
   

   //Step3：使用Access Token来获取用户的OpenID
   //拼接URL
   $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $access_token;
   curl_setopt($ch, CURLOPT_URL, $graph_url);
   $str = curl_exec($ch);
   if (strpos($str, "callback") >= 0)
   {
	  $lpos = strpos($str, "(");
	  $rpos = strrpos($str, ")");
	  $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
   }
   $users = json_decode($str);
   if (isset($users->error)) echo "<script>location='" . changeurl('index.php', $site_rewrite) . "';</script>";
   
   
   //Step4：调用get_user_info接口
   if($users->openid != "")
   {
	   //拼接URL
	   $getuser_url = "https://graph.qq.com/user/get_user_info?access_token=" . $access_token . "&oauth_consumer_key=" . $app_id . "&openid=" . $users->openid;
	   curl_setopt($ch, CURLOPT_URL, $getuser_url);
	   $getuser = curl_exec($ch);
	   if (strpos($getuser, "nickname") >= 0)
	   {
		  $user = json_decode($getuser);
		  
		  //验证数据库
		  $username = $user->nickname;
		  $sql = "SELECT id FROM " . $w3cview->prefix . "member WHERE username='" . "qq_" . $username . "'";
		  $query = $w3cview->query($sql);
		  $recordcount = mysql_num_rows($query); 
		  if($recordcount > 0){
			  setcookie('username', $username, time() + 3600, '/');
			  header("Location:" . changeurl('index.php', $site_rewrite));
		  }
		  else{
			  $sql = "insert into member set username='" . "qq_" . $username . "'";
			  if ($w3cview->query($sql)){
				  setcookie('username', $username, time() + 3600, '/');
			  	  header("Location:" . changeurl('index.php', $site_rewrite));
			  }
			else echo "<script>alert('用户登录失败');location='" . changeurl('index.php', $site_rewrite) . "';</script>";  
		  }
	   }
   }
   else echo "<script>location='" . changeurl('index.php', $site_rewrite) . "';</script>";
}
else 
{
   echo("The state does not match. You may be a victim of CSRF.");
}
?>