<?php
require("admin/config.php");
require_once("config_smarty.php");
require_once("config_site.php");
require_once("config_function.php");

//qq_api
if($site_qq == 1 && ($_GET['login'] == 'qq' || $_GET['code'] != '')) require_once("qq.php");

//ucenter
if($site_sappflag == 1)
{
	require_once("inc/config_ucenter.php");
	require_once("uc_client/client.php");
}
?>