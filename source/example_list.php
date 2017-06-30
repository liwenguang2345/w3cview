<?php
require_once("header.php");
require_once("footer.php");
require_once("left.php");

//example_list
$sql = "select * from " . $w3cview->prefix . "news where newsclass=1 order by timer desc";
$result = $w3cview->query($sql);
$totalnum = mysql_num_rows($result);
$pagesize = 4; 
if ($w3cview->stopSql($_GET["id"]) != "") $page = (int)$w3cview->stopSql($_GET["id"]); 
else $page = 1;
$begin = ($page - 1) * $pagesize;                
$totalpage = ceil($totalnum / $pagesize);
$query = $w3cview->query($sql . " limit " . $begin . "," . $pagesize);
$list = array();
while($arr = mysql_fetch_array($query))
{
	array_push($list, $arr);
}
$smarty->assign("list", $list);

//导航
$str = "共" . $totalnum . "个记录&nbsp;&nbsp;第" . $page . "/" . $totalpage . "页&nbsp;&nbsp;";
if ($page == 1)
{
	$str .= "首页&nbsp;上页&nbsp;";
}
else
{
	$prevpage = $page - 1;
	$str .= "<a href=".changeurl('index.php?mod=example&op=list&id=', $site_rewrite, '1').">首页</a>&nbsp;<a href=".changeurl('index.php?mod=example&op=list&id=', $site_rewrite, $prevpage).">上页</a>&nbsp;";
}
if ($page == $totalpage)
{
	$str .= "下页&nbsp;尾页";
}
else
{
	$nextpage = $page + 1;
	$str .= "<a href=".changeurl('index.php?mod=example&op=list&id=', $site_rewrite, $nextpage).">下页</a>&nbsp;<a href=".changeurl('index.php?mod=example&op=list&id=', $site_rewrite, $totalpage).">尾页</a>";
}
$smarty->assign("listnav", $str);
?>