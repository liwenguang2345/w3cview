<?php
setcookie('username', '', -86400);
if($site_sappflag == 1) uc_user_synlogout();
header("Location:" . changeurl('index.php', $site_rewrite));
?>