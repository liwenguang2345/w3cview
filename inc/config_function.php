<?php
//重定向地址转换函数
function changeurl($url, $site_rewrite, $id = "", $pid = "")
{
	extract($url);
	$url .= $id;
	if($pid != "") $url .= "&pid=" . $pid;
	if($site_rewrite == '1')
	{
		if (strpos($url, "?") > 0){
			$v = split("&", $url);
			$s = "";
			for($i = 0 ; $i < count($v) ; $i++)
			{
				if($i == 0) $s .= substr($v[$i] , strpos($v[$i],"=") + 1);
				else $s .= "/".substr($v[$i] , strpos($v[$i],"=") + 1);
			}
			return "/".$s;
		}
		else return "/".str_replace(".php","",$url);
	}
	else return $url;
}
?>