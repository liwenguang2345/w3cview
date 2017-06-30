<?php
require_once("inc/config.php");
if ($_GET['mod'] != "")
{
	if ($_GET['op'] != "") $var = strtolower($_GET['mod']) . "_" . strtolower($_GET['op']);
	else $var = strtolower($_GET['mod']);
	
	require_once("source/" . $var . '.php');   //功能页面
	$smarty->display($var . '.html');        //显示模板
}
else
{
	if(strtolower($site_default) != "index.php")
	{
		header("Location:".$site_default);
	}
	else
	{
		require_once('source/index.php');
		$smarty->display('index.html');
	}
}
?>