<?php
define('UC_CONNECT', 'mysql');

//数据库相关
define('UC_DBHOST', $w3cview->machine);
define('UC_DBUSER', $w3cview->username);
define('UC_DBPW', $w3cview->password);
define('UC_DBNAME', $site_ucbase);
define('UC_DBTABLEPRE', $site_ucbase.'.'.$site_ubasepre);
define('UC_DBCHARSET', 'gbk');

//通信相关
define('UC_KEY', $site_secretapp);
define('UC_API', $site_ucserver);
define('UC_APPID', $site_ucappid);
define('UC_IP', $site_ucip);
define('UC_CHARSET', 'gbk');

//用到的应用程序数据库连接参数
$dbhost = $w3cview->machine;
$dbuser = $w3cview->username;
$dbpw = $w3cview->password;
$dbname = $w3cview->database;
$pconnect = 0;
$dbcharset = 'gbk';

//同步登录 Cookie 设置
$cookiedomain = '';
$cookiepath = '/';
