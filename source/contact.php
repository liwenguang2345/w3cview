<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

//contact
$smarty->assign("contact", $w3cview->getdata("select * from " . $w3cview->prefix . "infor where id=2"));
?>