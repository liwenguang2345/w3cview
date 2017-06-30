<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

//ask_detail
$smarty->assign("details", $w3cview->getdata("select * from " . $w3cview->prefix . "news where id=" . $w3cview->stopSql($_GET['id'])));
?>