<?php
require_once('config.php');
require_once('sessionuser.php');

//添加
if (substr_count($_GET['action'], "add")>0)
    {
    //添加大类
	 if ($_GET['action'] == "addbigsystem")
	    {
		   $couple = array("bigsystem"=>$_POST['bigsystem1']);
           $w3cview->addsystem("bigsystem", $couple);
		}
	  
    //添加中类
	if ($_GET['action'] == "addmiddlesystem")
	    {
		   $couple = array("bigsystem"=>$_POST['bigsystem2'], "middlesystem"=>$_POST['middlesystem2'], "link"=>$_POST['link2']);
           $w3cview->addsystem("middlesystem", $couple);
		}
	
    //添加小类
	if ($_GET['action'] == "addsmallsystem")
	    {
		   $couple = array("bigsystem"=>$_POST['bigsystem3'], "middlesystem"=>$_POST['middlesystem3'], "smallsystem"=>$_POST['smallsystem3'], "link"=>$_POST['link3']);
           $w3cview->addsystem("smallsystem", $couple);
		}
	}

//修改
if ($_GET['action'] == "modisystem")
	    {
		   $couple = array($_POST['systemtype']=>$_POST['systemname'], "link"=>$_POST['editlink']);
           $w3cview->editsystem($_POST['systemtype'], $couple, $_POST['id']);
		}

//删除
if ($_GET['action'] == "del") $w3cview->deletesystem($_GET['systemtype'], $_GET['id']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</HEAD>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" align=left background=images/title_bg2.jpg>当前位置: 系统设置</TD></TR>
</TABLE>
<?php if (substr_count($_GET['action'], "add")>0){?>

<table width='600' border='0' align='center' cellpadding='2' cellspacing='1' bgcolor="#0066FF">
        <tr align='center' height='22'>
          <td width="528" height="22" bgcolor="#FFFFFF"><strong>添加类别</strong></td>
    </tr>
        <tr align='center'>
          <td bgcolor="#FFFFFF">
		  <form method=post name=myform1 action="system_mysql.php?action=addbigsystem" style="border:0px;margin:0px">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="8%" align="center">大类：</td>
              <td width="92%" align="left">
                名称：
                <input name="bigsystem1" type="text" size="10" class="input">
              <input name="submit" type="submit" value="添加" class="Button"></td>
            </tr>
          </table>
		  </form>
		  </td>
    </tr>
		  
        <tr align='center'>
          <td bgcolor="#FFFFFF">
		  <form method=post name=myform2 action="system_mysql.php?action=addmiddlesystem" style="border:0px;margin:0px">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="8%" align="center">中类：		  </td>
              <td width="92%" align="left">
<?php
$sql = "select * from " . $w3cview->prefix . "bigsystem order by id asc";
if ($w3cview->getrecordcount($sql) > 0){
	$query = $w3cview->query($sql);
?>
   <select name="bigsystem2">
<?php while ($array = mysql_fetch_array($query)){?>
      <option value="<?php echo($array['id']);?>"><?php echo($array['bigsystem']);?></option>
	  <? 
	  }?>
      </select>
<? }?>
                名称：
                <input type="text" name="middlesystem2" size="10" class="input">
                链接：
				<input type="text" name="link2" size="20" class="input">
			  <input name="submit2" type="submit" value="添加" class="Button"></td>
            </tr>
          </table>
		  </form></td>
  </tr>
		  
        <tr align='center'>
          <td bgcolor="#FFFFFF">
		  <SCRIPT language=javascript>
function chkSlt()
{
	location="system_mysql.php?action=add&bigsystem3="+document.myform3.bigsystem3.options[document.myform3.bigsystem3.selectedIndex].value;
}
</SCRIPT>
		  <form method=post name=myform3 action="system_mysql.php?action=addsmallsystem" style="border:0px;margin:0px">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="8%" align="center">小类：		</td>
              <td width="92%" align="left">
<?php
$sql = "select * from " . $w3cview->prefix . "bigsystem order by id asc";
$query = $w3cview->query($sql);
if ($array = mysql_fetch_array($query)){ 
    $First = $array['id'];
	$query = $w3cview->query($sql);
?>
   <select name="bigsystem3" class="input" onChange=javascript:chkSlt();>
<?php while ($array = mysql_fetch_array($query)){?>
      <option value="<?php echo($array['id']);?>" <?php if ($_GET['bigsystem3'] == $array['id']){?>selected<?php }?>><?php echo($array['bigsystem']);?></option>
	  <?php 
	  }?>
      </select>
<?php }?>
			  
<?php
if ($_GET['bigsystem3'] != "")
{
    $sql = "select * from " . $w3cview->prefix . "middlesystem where bigsystem=" . $_GET['bigsystem3'];
}
else
{
    if ($First!="")
     {
        $sql = "select * from " . $w3cview->prefix . "middlesystem where bigsystem=" . $First;
     }
    else
     {
        $sql = "select * from " . $w3cview->prefix . "middlesystem";
     }
}
$query = $w3cview->query($sql);
if ($array = mysql_fetch_array($query)){
	$First = $array['id'];
	$query = $w3cview->query($sql);
?>
  <select name="middlesystem3" class="input">
<?php while ($array = mysql_fetch_array($query)){?>
      <option value="<?php echo($array['id']);?>"><?php echo($array['middlesystem']);?></option>
	  <?php 
	  }?>
      </select>
<?php }?>
                名称：
                <input type="text" name="smallsystem3" size="10" class="input">
                链接：
				<input type="text" name="link3" size="20" class="input">
              <input name="submit3" type="submit" value="添加" class="Button"></td>
            </tr>
          </table>
		  </form></td>
  </tr>
</table>





<?php }?> 
<br>
<p align="center">
<?php if ($_GET['action'] == "edit"){?>
<form method=post action="system_mysql.php?action=modisystem" name="editform">



<table width='600' border='0' align='center' cellpadding='2' cellspacing='1' bgcolor="#0066FF">  
  <tr align='center' height='22'>    <td height="22" colspan="2" align="center" bgcolor="#FFFFFF"><strong>修改类别</strong></td>    
</tr>
<tr align='center'>    
  <td align="center" bgcolor="#FFFFFF">
<?php
$sql = "select * from " . $w3cview->prefix . "" . $_GET['systemtype']." where id=" . $_GET['id'];
$query = $w3cview->query($sql);
if ($array = mysql_fetch_array($query)){
	$systemname = $array[$_GET['systemtype']];
    $link = $array['link'];
}?>
<?php if ($_GET['systemtype'] == "bigsystem"){?>大类：<?php }?>
<?php if ($_GET['systemtype'] == "middlesystem"){?>中类：<?php }?>
<?php if ($_GET['systemtype'] == "smallsystem"){?>小类：<?php }?>
  </td>
  <td align="left" bgcolor="#FFFFFF"><input type="hidden" name="systemtype" value="<?php echo($_GET['systemtype']);?>"><input type="hidden" name="id" value="<?php echo($_GET['id']);?>">
    名称：
    <input type="text" name="systemname" value="<?php echo($systemname);?>" size="15" System="input">
    <?php if ($_GET['systemtype'] != "bigsystem"){?>
    链接：<input type="text" name="editlink" value="<?php echo($link);?>" size="20" class="input">
  <?php }?>
  &nbsp;&nbsp;&nbsp;&nbsp;<input name="editsubmit" type="submit" value="修改" System="Button"></td>
</tr></table>



</form>
<?php }?>
</p>
<table width='600' border='0' align='center' cellpadding='2' cellspacing='1' bgcolor="#0066FF">  
  <tr align='center' height='22'>    <td height="22" align="center" bgcolor="#FFFFFF"><strong>类别结构</strong></td>    
</tr>
<tr align='center'>    
  <td align="left" bgcolor="#FFFFFF">
<?php
$sql = "select * from " . $w3cview->prefix . "bigsystem order by id asc";
$query = $w3cview->query($sql);
while ($array = mysql_fetch_array($query))
{?>
    <font color=red>大类</font>：<?php echo($array['bigsystem']);?>[<a href="system_mysql.php?action=edit&systemtype=bigsystem&id=<?php echo($array['id']);?>">修改</a>]&nbsp;[<a href="system_mysql.php?action=del&systemtype=bigsystem&id=<?php echo($array['id']);?>">删除</a>]
     <?php if($array['bigsystem'] != ""){
	    $sql2 = "select * from " . $w3cview->prefix . "middlesystem where bigsystem=" . $array['id'] . " order by id asc";
		$query2 = $w3cview->query($sql2);
        while ($array2=mysql_fetch_array($query2))
		{?>
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>中类</font>：
	 <?php echo($array2['middlesystem']);?><?php if($array2['link'] != ""){?>(<?php echo($array2['link']);?>)<?php }?>[<a href="system_mysql.php?action=edit&systemtype=middlesystem&id=<?php echo($array2['id']);?>">修改</a>]&nbsp;[<a href="system_mysql.php?action=del&systemtype=middlesystem&id=<?php echo($array2['id']);?>">删除</a>]
	          <?php if($array2['bigsystem'] != ""){
	                 $sql3 = "select * from " . $w3cview->prefix . "smallsystem where middlesystem=" . $array2['id'] . " order by id asc";
					 $query3 = $w3cview->query($sql3);
                     while ($array3 = mysql_fetch_array($query3))
					 {?>
		             <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>小类</font>：
	                <?php echo($array3['smallsystem']);?><?php if($array3['link'] != ""){?>(<?php echo($array3['link']);?>)<?php }?>[<a href="system_mysql.php?action=edit&systemtype=smallsystem&id=<?php echo($array3['id']);?>">修改</a>]&nbsp;[<a href="system_mysql.php?action=del&systemtype=smallsystem&id=<?php echo($array3['id']);?>">删除</a>]
	                <?php 
					}
				}
	     }
	  }?><br>	  
<?php }?>
</td>
  </tr>
  <tr>
<td bgcolor="#FFFFFF"><table width='500' border='0' align='center' cellpadding='2' cellspacing='1'>  
  <tr align='center' height='22'>    <td height="22" align="center"><strong><a href="system_mysql.php?action=add">添加类别</a></strong></td>    
</tr></table>  
</td>
</tr></table>
</BODY>
</HTML>