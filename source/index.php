<?php
require_once("header.php");
require_once("footer.php");

//幻灯片
$smarty->assign("indextop", $w3cview->getdata("select * from " . $w3cview->prefix . "news where image is not null order by timer desc limit 0,5"));

//成功案例
$smarty->assign("example", $w3cview->getdata("select * from " . $w3cview->prefix . "news where newsclass=1 order by timer desc limit 0,4"));

//答疑解惑
$smarty->assign("ask", $w3cview->getdata("select * from " . $w3cview->prefix . "news where newsclass=2 order by timer desc limit 0,10"));
?>