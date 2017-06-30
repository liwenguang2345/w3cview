<?php
//guestbook
$title = $w3cview->stopSql($_POST['title']);
$note = $w3cview->stopSql($_POST['note']);
$sql = "insert into " . $w3cview->prefix . "guestbook set title='" . $title . "',timer='" . date("Y-m-d") . "',note='" . $note . "'";
if ($w3cview->query($sql)) echo "<script>alert('客户留言提交成功!');location='" . changeurl('index.php?mod=guestbook', $site_rewrite) . "';</script>";
else echo "<script>alert('客户留言提交失败!');history.back();</script>";
?>