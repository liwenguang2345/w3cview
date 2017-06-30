<?php
//header
$smarty->assign("site_logo", $site_logo);

if(!empty($_COOKIE['username']))
{
	if($site_sappflag == 1)
	{
		list($uid, $username) = explode("\t", uc_authcode($_COOKIE['username']), 'DECODE');
		$smarty->assign("username", $username);
	}
	else
	{
		$smarty->assign("username", $_COOKIE['username']);
	}
}

//menu
$smarty->assign("menu", $w3cview->getdata("select * from " . $w3cview->prefix . "menuset order by sorts asc"));
?>