<?php
/*  ����������ľ���·��  */
define('BASE_PATH','d:\AppServ\www\\');
/*  ����SmartyĿ¼�ľ�����·��  */
define('SMARTY_PATH','tm\sl\28\\');
/*  ����Smarty����ļ�  */
require BASE_PATH.SMARTY_PATH.'Smarty/Smarty.class.php';
/*  ʵ����һ��Smarty����  */
$smarty = new Smarty;
/*  
$smarty->template_dir = BASE_PATH.SMARTY_PATH.'Smarty/templates/';
$smarty->compile_dir = BASE_PATH.SMARTY_PATH.'Smarty/templates_c/';
$smarty->config_dir = BASE_PATH.SMARTY_PATH.'Smarty/configs/';
$smarty->cache_dir = BASE_PATH.SMARTY_PATH.'Smarty/cache/';
$smarty->assign('title','��һ��Smarty����');
$smarty->assign('content','Hello,Welcome to study \'Smarty\'!');
$smarty->display('01/index.tpl');
?>

