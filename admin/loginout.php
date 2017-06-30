<?php
require_once('config.php');
require_once('sessionuser.php');
session_destroy();
echo "<script>location='login.php';</script>";
?>