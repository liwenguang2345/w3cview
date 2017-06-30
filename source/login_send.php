<?php
$username = $w3cview->stopSql($_POST['username']);
$password = $w3cview->stopSql($_POST['password']);
$sql = "SELECT id FROM " . $w3cview->prefix . "member WHERE username='" . $username . "' and password='" . md5($password) . "'";
$query = $w3cview->query($sql);
$recordcount = mysql_num_rows($query); 
if($recordcount > 0)
{
	if($site_sappflag == 1)  //启用UCenter
	{
		list($uid, $username, $password, $email) = uc_user_login($username, $password);
		if($uid > 0)
		{
			setcookie('username', uc_authcode($uid . "\t" . $username, 'ENCODE'), time() + 3600, '/');
			$ucsynlogin = uc_user_synlogin($uid);
			header("Location:" . changeurl('index.php', $site_rewrite));
		}
		else
		{
			echo "<script>alert('用户名和密码输入错误，请重新登录');location='" . changeurl('index.php?mod=login', $site_rewrite) . "';</script>";
		}
	}
	else
	{
		setcookie('username', $username, time()+3600, '/');
		header("Location:" . changeurl('index.php', $site_rewrite));
	}
}
else
{
	echo "<script>alert('用户名和密码输入错误，请重新登录');location='" . changeurl('index.php?mod=login', $site_rewrite) . "';</script>";
}
?>