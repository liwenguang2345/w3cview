<?php
require_once("../api/qq/qqConnectAPI.php");
$qc = new QC();
echo $qc->qq_callback();
echo $qc->get_openid();
