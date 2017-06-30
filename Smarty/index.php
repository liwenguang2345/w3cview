<?php
/*  定义服务器的绝对路径  */
define('BASE_PATH','d:\AppServ\www\\');
/*  定义Smarty目录的绝地你路径  */
define('SMARTY_PATH','tm\sl\28\\');
/*  加载Smarty类库文件  */
require BASE_PATH.SMARTY_PATH.'Smarty/Smarty.class.php';
/*  实例化一个Smarty对象  */
$smarty = new Smarty;
/*  
$smarty->template_dir = BASE_PATH.SMARTY_PATH.'Smarty/templates/';
$smarty->compile_dir = BASE_PATH.SMARTY_PATH.'Smarty/templates_c/';
$smarty->config_dir = BASE_PATH.SMARTY_PATH.'Smarty/configs/';
$smarty->cache_dir = BASE_PATH.SMARTY_PATH.'Smarty/cache/';
$smarty->assign('title','第一个Smarty程序');
$smarty->assign('content','Hello,Welcome to study \'Smarty\'!');
$smarty->display('01/index.tpl');
?>

