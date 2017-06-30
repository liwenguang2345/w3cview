<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

$email = $w3cview->stopSql($_POST['email']);
if(!empty($_COOKIE['username']))
{
	if($site_sappflag == 1)
	{
		list($uid, $username) = explode("\t", uc_authcode($_COOKIE['username'], 'DECODE'));
	}
	else
	{
		$username = $_COOKIE['username'];
	}
	$sql = "update " . $w3cview->prefix . "member set email='" . $email . "' WHERE username='" . $username . "'";
	if($w3cview->query($sql)) echo "<script>alert('资料修改成功');location='" . changeurl('index.php', $site_rewrite) . "';</script>";
	else echo "<script>alert('资料修改失败');history.back();</script>";
}
else
{
	echo "<script>alert('您没有登录，请登录后操作');location='" . changeurl('index.php?mod=login', $site_rewrite) . "';</script>";
}

?>