<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>W3CVIEW视野CMS系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</HEAD>
<BODY>
<TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%" bgColor=#002779 
border=0>
  <TR>
    <TD align=middle>
      <TABLE width=468 border=0 align="center" cellPadding=0 cellSpacing=0>
        <TR>
          <TD><IMG height=23 src="images/login_1.jpg" 
          width=468></TD></TR>
        <TR>
          <TD><IMG height=147 src="images/login_2.jpg" 
            width=468></TD></TR></TABLE>
      <TABLE width=468 border=0 align="center" cellPadding=0 cellSpacing=0 bgColor=#ffffff>
        <TR>
          <TD width=16 background="images/login_3.jpg"></TD>
          <TD align=center>
            <TABLE cellSpacing=0 cellPadding=0 width=230 border=0>
             <script language="javascript">
			function checkform()
			{
			     if(document.myform.username.value=="")
				 {
				      alert("请输入用户名");
					  document.myform.username.focus();
					  return false;
				 }
				 if(document.myform.password.value=="")
				 {
				      alert("请输入用户密码");
					  document.myform.password.focus();
					  return false;
				 }
			}
			</script>
		      <form action="checklogin.php" name="myform" method=post onSubmit="return checkform();">
              <TR height=5>
                <TD width=5></TD>
                <TD width=56></TD>
                <TD></TD></TR>
              <TR height=36>
                <TD></TD>
                <TD height="35">用户名</TD>
                <TD><INPUT name=username id="username" 
                  style="BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid" size=24></TD></TR>
              <TR height=36>
                <TD>&nbsp; </TD>
                <TD height="35">口　令</TD>
                <TD><INPUT 
                name=password 
                  type=password id="password" 
                  style="BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid" size=24></TD></TR>
                  <TR height=36>
                <TD>&nbsp; </TD>
                <TD height="35">验证码</TD>
                <TD><INPUT name=code type=text id="code" style="BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid" size=12>
                <img src="getcode.php" alt="验证码看不清楚？请点击刷新验证码" height="16" style="cursor : pointer;" onClick="this.src='getcode.php'"></TD></TR>
              <TR height=5>
                <TD colSpan=3></TD></TR>
              <TR>
                <TD>&nbsp;</TD>
                <TD height="35" colspan="2" align="center"><INPUT type=image height=18 width=70 src="images/bt_login.gif"></TD>
                </TR></FORM></TABLE></TD>
          <TD width=16 background="images/login_4.jpg"></TD></TR></TABLE>
      <TABLE width=468 border=0 align="center" cellPadding=0 cellSpacing=0>
        <TR>
          <TD><IMG height=16 src="images/login_5.jpg" 
          width=468></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>
