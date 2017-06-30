<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");
//about
$smarty->assign("about", $w3cview->getdata("select * from " . $w3cview->prefix . "infor where id=1"));
?>