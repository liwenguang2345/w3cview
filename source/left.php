<?php
//成功案例
$smarty->assign("homeexample", $w3cview->getdata("select * from " . $w3cview->prefix . "news where newsclass=1 order by timer desc limit 0,4"));
?>