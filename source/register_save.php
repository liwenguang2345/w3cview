<?php
$username = $w3cview->stopSql($_POST['username']);
$password = $w3cview->stopSql($_POST['password']);
$email = $w3cview->stopSql($_POST['email']);
$sql = "SELECT id FROM " . $w3cview->prefix . "member WHERE username='" . $username . "'";
$query = $w3cview->query($sql);
$recordcount = mysql_num_rows($query); 
if ($recordcount > 0) echo "<script>alert('该用户已存在，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
else
{
	if($site_sappflag == 1)  //启用ucenter注册
	{
		$uid = uc_user_register($username, $password, $email);
		if($uid <= 0) {
			if($uid == -1) echo "<script>alert('用户名不合法');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			elseif($uid == -2) echo "<script>alert('用户名包含要允许注册的词语');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			elseif($uid == -3) echo "<script>alert('该用户已存在，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			elseif($uid == -4) echo "<script>alert('用户名格式错误，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			elseif($uid == -5) echo "<script>alert('用户名不允许注册，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			elseif($uid == -6) echo "<script>alert('该用户名已存在，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			else echo "<script>alert('用户注册失败，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
		}
		else
		{
			$w3cview->open();
			$sql = "insert into " . $w3cview->prefix . "member(`username`,`password`,`email`) values ('" . $username . "','" . md5($password) . "','" . $email . "')";
			if ($w3cview->query($sql))
			{
				setcookie('username', uc_authcode($uid . "\t" . $username, 'ENCODE'), time() + 3600, '/');
				echo "<script>alert('用户注册成功！');location='" . changeurl('index.php', $site_rewrite) . "';</script>";
			}
			else
			{
				echo "<script>alert('用户注册失败，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
			}
		}
	}
	else
	{
		$sql = "insert into " . $w3cview->prefix . "member(`username`,`password`,`email`) values ('" . $username . "','" . md5($password) . "','" . $email . "')";
		if ($w3cview->query($sql))
		{
			setcookie('username', $username, time() + 3600, '/');
			echo "<script>alert('用户注册成功！');location='" . changeurl('index.php', $site_rewrite) . "';</script>";
		}
		else
		{
			echo "<script>alert('用户注册失败，请重新注册');location='" . changeurl('index.php?mod=register', $site_rewrite) . "';</script>";
		}
	}
}
?>