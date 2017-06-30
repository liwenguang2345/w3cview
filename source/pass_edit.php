<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

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
	$sql = "SELECT id,email FROM " . $w3cview->prefix . "member WHERE username='" . $username . "'";
	$query = $w3cview->query($sql);
	while($arr = mysql_fetch_array($query))
	{
		$smarty->assign("id", $arr['id']);
		$smarty->assign("email", $arr['email']);
	}
}
else
{
	echo "<script>alert('您没有登录，请登录后操作');location='index.php?mod=login';</script>";
}

?>