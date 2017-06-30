<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

$oldpass = $w3cview->stopSql($_POST['oldpass']);
$password = $w3cview->stopSql($_POST['password']);
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
	
	$sql = "SELECT password FROM " . $w3cview->prefix . "member WHERE username='" . $username . "'";
	$query = $w3cview->query($sql);
	while($arr = mysql_fetch_array($query))
	{
		$old_pass = $arr['password'];
	}
	
	//更新密码
	if($old_pass == md5($oldpass))
	{
		$sql = "update " . $w3cview->prefix . "member set password='" . md5($password) . "' WHERE username='" . $username . "'";
		if($w3cview->query($sql)) echo "<script>alert('密码修改成功');location='" . changeurl('index.php', $site_rewrite) . "';</script>";
		else echo "<script>alert('密码修改失败');history.back();</script>";
	}
	else
	{
		echo "<script>alert('原密码输入错误，请重新输入');history.back();</script>";
	}
}
else
{
	echo "<script>alert('您没有登录，请登录后操作');location='" . changeurl('index.php?mod=login',$site_rewrite) . "';</script>";
}
?>