<?php
require_once('config.php');
require_once('sessionuser.php');
$filename = "../template/" . $_GET['name'] . ".html";
$note = file_get_contents($filename);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加模板</title>
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</head>
<body leftmargin='2' topmargin='0' marginwidth='0' marginheight='0'>
<script language='Javascript'>
function chk(theform)
{
 if (theform.filename.value == "")
  {
    alert('请输入文件名。');
    theform.filename.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 修改模板文件</TD></TR>
</TABLE>
<form method='post' action='edittemplatesave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD width="10%" align=center>文件名：</TD>
      <TD style="COLOR: #880000"><input type="text" name="filename" id="filename" value="<?php echo $_GET['name'];?>">.html</TD>
    </TR>
    <TR>
      <TD align=center>模板内容：</TD>
      <TD style="COLOR: #880000"><textarea name="note" style="width:100%" rows="30"><?php echo $note;?></textarea></TD>
    </TR>
    <TR>
      <TD colspan="2" align=center><input  type='submit' name='Submit' value=' 修 改 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</body>
</html>
