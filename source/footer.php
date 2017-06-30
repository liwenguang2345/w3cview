<?php
//footer
$smarty->assign("site_copyright", $site_copyright);
$smarty->assign("site_hits", $site_hits);

//hits++
$sql = "update " . $w3cview->prefix . "siteset set hits=hits+1";
@$w3cview->query($sql);
?>