<?php
require_once('config.php');
$w3cview->checklogin($_POST['username'], $_POST['password'], $_POST['code']);
?>