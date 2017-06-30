<style type="text/css">
<!--
body,td,th {
	font-size: 14px;
	line-height:120%;
}
body {
	background-image: url(images/main_bg.gif);
}

-->
</style>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td height="19" align="center"><img src="images/logo.png" width="503" height="72" /></td>
    </tr>
    <tr>
      <td align="left" style="padding-left:10px;">
<?php
//服务器
$machine=$_POST['machine'];
//登陆用户
$username=$_POST['username'];
//登陆密码
$password=$_POST['password'];
//数据库名
$database=$_POST['database'];
//表前缀
$prefix=$_POST['prefix'];
//管理员用户名
$uname=$_POST['uname'];
//管理员密码
$pword=$_POST['pword'];

//连接数据库服务器
$conn=@mysql_connect($machine,$username,$password);
$success = true;
if(!$conn)
{
	$success = false;
	echo "<script>alert('数据库用户名和密码错误，请重新安装');location='install_mysql.php'</script>";
}

//安装开始
echo "<h4>W3civew程序安装进度:</h4>";

//创建上传文件文件夹
if (!file_exists("../upload")){
	@mkdir("../upload", 0777);
	echo "上传文件文件夹: <strong>upload</strong> 创建成功!<br><br>";
}

//数据库安装开始
echo "数据库 <strong>" . $database . "</strong> 安装进度:<br>";

//1.安装数据库
@mysql_query("set names utf8");
insdatabase($database);
mysql_select_db($database, $conn);

//2.安装表

//bigsystem表
$sql = "create table `" . $prefix . "bigsystem` (
  `id` int(10) not null auto_increment,
  `bigsystem` varchar(100) default null,
  `link` varchar(100) default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "bigsystem");
$sql = "INSERT INTO `" . $prefix . "bigsystem` SET `bigsystem`='项目管理'";
insert($sql, "" . $prefix . "bigsystem");
$sql = "INSERT INTO `" . $prefix . "bigsystem` SET `bigsystem`='类别管理'";
insert($sql, "" . $prefix . "bigsystem");
$sql = "INSERT INTO `" . $prefix . "bigsystem` SET `bigsystem`='信息管理'";
insert($sql, "" . $prefix . "bigsystem");
$sql = "INSERT INTO `" . $prefix . "bigsystem` SET `bigsystem`='会员管理'";
insert($sql, "" . $prefix . "bigsystem");
$sql = "INSERT INTO `" . $prefix . "bigsystem` SET `bigsystem`='留言管理'";
insert($sql, "" . $prefix . "bigsystem", 1);

//middlesystem表
$sql = "create table `" . $prefix . "middlesystem` (
  `id` int(10) not null auto_increment,
  `middlesystem` varchar(100) default null,
  `bigsystem` int(10) default null,
  `link` varchar(100) default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='添加项目',`bigsystem`='1', `link`='addinfor.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='项目管理',`bigsystem`='1', `link`='infor.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='添加类别',`bigsystem`='2', `link`='addnewsclass.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='类别管理',`bigsystem`='2', `link`='newsclass.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='添加信息',`bigsystem`='3', `link`='addnews.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='信息管理',`bigsystem`='3', `link`='news.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='查看会员',`bigsystem`='4', `link`='member.php'";
insert($sql, "" . $prefix . "middlesystem");
$sql = "INSERT INTO `" . $prefix . "middlesystem` SET `middlesystem`='查看留言',`bigsystem`='5', `link`='guestbook.php'";
insert($sql, "" . $prefix . "middlesystem", 1);

//smallsystem表
$sql = "create table `" . $prefix . "smallsystem` (
  `id` int(10) not null auto_increment,
  `smallsystem` varchar(100) default null,
  `middlesystem` varchar(10) default null,
  `bigsystem` varchar(10) default null,
  `link` varchar(100) default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "smallsystem");

//guestbook表
$sql = "create table `" . $prefix . "guestbook` (
  `id` int(10) not null auto_increment,
  `title` varchar(100) default null,
  `timer` date default null,
  `note` text,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "guestbook");

//infor表
$sql = "create table `" . $prefix . "infor` (
  `id` int(10) not null auto_increment,
  `title` varchar(100) default null,
  `timer` date default null,
  `note` text,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "infor");
$sql = "INSERT INTO `" . $prefix . "infor` SET `title`='关于我们',`note`='W3CVIEW视野CMS系统是由W3CVIEW创作小组开发的，小组除对系统的持续更新外还承接PHP、NET和ASP软件开发项目。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "infor");
$sql = "INSERT INTO `" . $prefix . "infor` SET `title`='联系我们',`note`='W3CVIEW系统支持,承接软件项目。QQ：120753561，402458137', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "infor");
$sql = "INSERT INTO `" . $prefix . "infor` SET `title`='服务支持',`note`='W3CVIEW创作小组致力于W3CVIEW视野CMS系统的开发和持续更新计划，同时还承接PHP、NET和ASP软件开发项目。<br>联系QQ：120753561，402458137', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "infor", 1);

//member表
$sql = "create table `" . $prefix . "member` (
  `id` int(10) not null auto_increment,
  `username` varchar(100) default null,
  `password` varchar(100) default null,
  `email` varchar(100) default null,
  `logo` varchar(100) default null,
  `nickname` varchar(100) default null,
  `registertime` datetime default null,
  `join` int(11) DEFAULT 0,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "member");
$sql = "INSERT INTO `" . $prefix . "member` SET `username`='$uname',`password`='" . md5($pword) . "'";
insert($sql, "" . $prefix . "member", 1);


//menuset表
$sql = "CREATE TABLE `" . $prefix . "menuset` (
  `id` int(10) NOT NULL auto_increment,
  `parent` int(10) default '0',
  `title` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `sorts` int(10) default '0',
  PRIMARY KEY  (`id`)
)";
instable($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='首页',`url`='index.php',`sorts`='1'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='关于我们',`url`='index.php?mod=about',`sorts`='2'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='成功案例',`url`='index.php?mod=example&op=list',`sorts`='3'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='答疑解惑',`url`='index.php?mod=ask&op=list',`sorts`='4'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='客户留言',`url`='index.php?mod=guestbook',`sorts`='5'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='服务支持',`url`='index.php?mod=service',`sorts`='6'";
insert($sql, "" . $prefix . "menuset");
$sql = "INSERT INTO `" . $prefix . "menuset` SET `parent`='0',`title`='联系我们',`url`='index.php?mod=contact',`sorts`='7'";
insert($sql, "" . $prefix . "menuset", 1);

//newsclass表
$sql = "create table `" . $prefix . "newsclass` (
  `id` int(10) not null auto_increment,
  `parent` varchar(100) default '0',
  `title` varchar(100) default null,
  `timer` date default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "newsclass");
$sql = "INSERT INTO `" . $prefix . "newsclass` SET `parent`='0',`title`='成功案例', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "newsclass");
$sql = "INSERT INTO `" . $prefix . "newsclass` SET `parent`='0',`title`='答疑解惑', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "newsclass", 1);

//news表
$sql = "create table `" . $prefix . "news` (
  `id` int(10) not null auto_increment,
  `newsclass` varchar(10) default null,
  `title` varchar(100) default null,
  `keywords` varchar(100) default null,
  `description` text,
  `image` varchar(100) default null,
  `note` text,
  `timer` date default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='脑胶质瘤网',`keywords`='PHP,脑胶质瘤网', `description`='脑胶质瘤网站是W3cview创作小组使用PHP+MYSQL开发的一个针对脑胶质瘤基因组图谱的展示性网站', `image`='/template/images/jzl.jpg', `note`='脑胶质瘤网站是W3cview创作小组使用PHP+MYSQL开发的一个针对脑胶质瘤基因组图谱的展示性网站。该网站除基本行业信息展示外还有数据上传下载、生成EXCEL数据文件、图表展示、语言翻译等功能。网站网址为http://www.cgga.org.cn。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='健康体检管理系统',`keywords`='C#.NET,健康体检管理系统', `description`='健康体检管理系统是W3cview创作小组成员为天士力集团有限公司健康管理中心开发的一套管理系统', `image`='/template/images/jkgl.jpg', `note`='健康体检管理系统是W3cview创作小组成员为天士力集团有限公司健康管理中心开发的一套管理系统。该系统使用C#.NET语言开发，含非接触式IC卡和身份证读卡器读取、Word模板调用、EXCEL导入导出、会员数据管理、使用配置文件调用各体检设备等功能。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='天津金管家财务管理咨询服务有限公司',`keywords`='PHP,天津金管家财务管理咨询服务有限公司网站', `description`='天津金管家财务管理咨询服务有限公司网站是W3cview创作小组使用W3civewCMS系统开发的第一个成功案例', `image`='/template/images/jinguanjia.jpg', `note`='天津金管家财务管理咨询服务有限公司网站是W3cview创作小组使用W3civewCMS系统开发的第一个成功案例，该网站使用真静态优化功能，优化功能强，在百度、google搜引擎上搜索时都位居前列。网站网址http://www.xindicheng.com。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='南开大学现代远程教育学院',`keywords`='PHP,南开大学现代远程教育学院网站', `description`='Joomla!是一套在国外相当知名的内容管理系统', `image`='/template/images/nankaijiaoyu.jpg', `note`='南开大学现代远程教育学院网站是W3cview创作小组在基于PHP+MYSQL语言和smarty自架架构的基础上开发的一套远程教育网站软件，该网站含资讯展示、在线随机答题、成绩统计、发送短信等功能区。网站网址http://weo.nankai.edu.cn。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='天津演出网',`keywords`='ASP.NET,天津演出网', `description`=' 天津演出网是W3cview创作小组采用ASP.NET开发的第一个成功作品', `image`='/template/images/022show.jpg', `note`='天津演出网是W3cview创作小组采用ASP.NET开发的第一个成功作品。该网站制作于2006年，除了最新天津影视资讯外还有在线订票、艺人展示、场馆建设、演艺圈等等信息展示。网站网址为http://www.022show.com。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='发送邮件系统',`keywords`='C#.NET,发送邮件系统', `description`='邮件发送系统是W3cview创作小组成员为天士力集团有限公司大健康网开发的一套系统', `image`='/template/images/sendemail.jpg', `note`='邮件发送系统是W3cview创作小组成员为天士力集团有限公司大健康网开发的一套系统。该系统使用C#.NET语言，含EXCEL导入导出、使用配置文件调用邮件服务器等功能。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='唐山渤亚渗锌有限公司网站',`keywords`='PHP,唐山渤亚渗锌有限公司网站', `description`='唐山渤亚渗锌公司网站是W3cview创作小组在PHP+MySQL的技术架构上开发的一个公司展示性网站', `image`='/template/images/bysx.jpg', `note`='唐山渤亚渗锌公司网站是W3cview创作小组在PHP+MySQL的技术架构上开发的一个公司展示性网站。网站网址http://www.tsbysx.com。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='天津市金耀集团网站',`keywords`='ASP,天津市金耀集团总公司及其各子公司网站', `description`='W3cview创作小组在ASP+SQLServer基础上开发了天津市金耀集团总公司及其各子公司网站', `image`='/template/images/jinyao.jpg', `note`='W3cview创作小组在ASP+SQLServer基础上设计开发了天津市金耀集团总公司及其各子公司网站。网站网址http://www.tjpc.com.cn。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='天津舒泊花园大酒店网站',`keywords`='ASP,天津舒泊花园大酒店网站', `description`='W3cview创作小组使用ASP+SQLServer语言设计开发了天津舒泊花园大酒店网站', `image`='/template/images/shubo.jpg', `note`='W3cview创作小组使用ASP+SQLServer语言设计开发了天津舒泊花园大酒店网站，是该酒店运营宣传的网络窗口。网站网址http://www.supergardenhotel.com。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='1',`title`='宁津县通用建筑吊篮厂',`keywords`='PHP,宁津县通用建筑吊篮厂', `description`='W3cview创作小组使用PHP+MySQL语言设计开发了宁津县通用建筑吊篮厂网站', `image`='/template/images/njtydl.jpg', `note`='W3cview创作小组使用PHP+MySQL语言设计开发了宁津县通用建筑吊篮厂网站，是该网站网络宣传窗口。网站网址http://www.njtydl.com。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='2',`title`='W3cviewCMS系统怎么安装',`keywords`='W3cviewCMS系统,安装', `description`='W3cviewCMS系统怎么安装', `image`='/template/images/shubo.jpg', `note`='W3cviewCMS系统是基于PHP+MYSQL语言架构的，所有在安装时必须要有PHP、MYSQL及Web服务器环境，安装时假如服务器地址是http://localhost，同时安装文件夹upload存在站点根目录下(upload文件夹名称不修改)，则可以在浏览器中输入安装路径http://localhost/upload即可进入安装界面。此后按安装进程进行安装即可。注意安装时要输入正确的MYSQL数据库用户名和密码。详细安装过程请参见安装文档。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='2',`title`='W3cviewCMS系统默认模板的功能',`keywords`='W3cviewCMS系统,默认模板', `description`='W3cviewCMS系统默认模板有什么功能', `image`='/template/images/shubo.jpg', `note`='W3cviewCMS系统默认安装模板是一个简单的企业介绍性模板，该模板含关于我们、成功案例、答疑解惑、客户留言、服务支持、联系我们等模块。在默认模板中缺少会员注册登录等功能，会员注册登录的具体功能可参见默认模板2。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news");

$sql = "INSERT INTO `" . $prefix . "news` SET `newsclass`='2',`title`='W3cviewCMS系统有什么特色功能',`keywords`='W3cviewCMS系统,特色', `description`='W3cviewCMS系统有什么特色功能', `image`='/template/images/shubo.jpg', `note`='W3cviewCMS系统除CMS系统常用功能外还包含了W3cview创作小组自己研究的利用PHP数组组织架构数据库操作命令、模板标签定义及调用、自定义后台管理系统菜单栏目、生成真静态页面等特色功能。', `timer`='" . date("Y-m-d") . "'";
insert($sql, "" . $prefix . "news", 1);

//admin表
$sql = "create table `" . $prefix . "admin` (
  `id` int(10) not null auto_increment,
  `username` varchar(100) default null,
  `password` varchar(100) default null,
  `super` int(10) default '0',
  `regtime` date default null,
  `loginnum` int(10) default '0',
  `logintime` date default null,
  `loginip` varchar(10) default null,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "admin");
$sql =  "insert into `" . $prefix . "admin` set username='$uname',password='" . md5($pword) . "',super='1',regtime='" . date("Y-m-d") . "',loginnum='0',logintime='" . date("Y-m-d") . "',loginip='" . $_SERVER['REMOTE_ADDR'] . "'";
insert($sql, "" . $prefix . "admin", 1);

//siteset表
$sql =  "CREATE TABLE `" . $prefix . "siteset` (
  `id` int(10) NOT NULL auto_increment,
  `default` varchar(50) default NULL,
  `logo` varchar(50) default NULL,
  `title` text,
  `keywords` text,
  `description` text,
  `api` varchar(50) default NULL,
  `token` varchar(50) default NULL,
  `appid` varchar(50) default NULL,
  `appsecret` varchar(50) default NULL,
  `account` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `secretapp` varchar(50) default NULL,
  `sappflag` int(10) default '0',
  `qq` int(10) default '0',
  `qqapp_id` varchar(100) default NULL,
  `qqapp_secret` varchar(100) default NULL,
  `qqaccess_token` varchar(100) default NULL,
  `ucserver` varchar(100) default NULL,
  `ucbase` varchar(50) default NULL,
  `ubasepre` varchar(50) default NULL,
  `ucip` varchar(50) default NULL,
  `ucappid` int(10) default '0',
  `copyright` text,
  `hits` int(10) default '0',
  `rewrite` int(10) default '0',
  PRIMARY KEY  (`id`)
)";
instable($sql, "" . $prefix . "siteset");
$sql = "INSERT INTO `" . $prefix . "siteset` SET `default`='index.php',`logo`='/template/images/logo.png',`title`='W3CVIEW视野CMS系统',`keywords`='W3CVIEW视野CMS系统',`description`='W3CVIEW视野CMS系统',`secretapp`='w3cviewcms',`sappflag`='0',`copyright`='本系统版权归W3CVIEW所有',`qq`='0',`qqapp_id`='',`qqapp_secret`='',`qqaccess_token`='',`ucserver`='http://localhost/uc_server',`ucbase`='ultrax',`ubasepre`='pre_ucenter_',`ucappid`='1',`ucip`='',`hits`='0',`rewrite`='0'";
insert($sql, "" . $prefix . "siteset", 1);


//menu表---微信
$sql = "create table `" . $prefix . "menu` (
  `id` int(11) NOT NULL auto_increment,
  `parentid` int(11) default '0',
  `title` varchar(100) default NULL,
  `key` varchar(100) default NULL,
  `url` text,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "menu");


//message表---微信
$sql = "create table `" . $prefix . "message` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `description` text,
  `picurl` varchar(100) default NULL,
  `url` text,
  `timer` datetime default NULL,
  `note` text,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "message");


//returninfor表---微信
$sql = "create table `" . $prefix . "returninfor` (
  `id` int(11) NOT NULL auto_increment,
  `keyword` varchar(100) default NULL,
  `title` varchar(100) default NULL,
  `description` text,
  `picurl` varchar(100) default NULL,
  `url` text,
  `timer` datetime default NULL,
  `note` text,
  primary key  (`id`)
)";
instable($sql, "" . $prefix . "returninfor");


//3.写入配置文件config_mysql.php
$fc = @fopen("config_mysql.php", "r");
$content = fread($fc, filesize("config_mysql.php"));
fclose($fc);

$file = @fopen("config.php","w+");
$content = str_replace('$machine = ' . "''",'$machine = ' . "'$machine'", $content);
$content = str_replace('$username = ' . "''",'$username = ' . "'$username'", $content);
$content = str_replace('$password = ' . "''",'$password = ' . "'$password'", $content);
$content = str_replace('$database = ' . "''",'$database = ' . "'$database'", $content);
$content = str_replace('$prefix = ' . "''",'$prefix = ' . "'$prefix'", $content);
fwrite($file, $content);
fclose($file);

//4.备份安装文件
if ($success)
{
	//备份mysql安装文件
	@rename("config_mysql.php", "config_mysql.bak");
	@rename("install_mysql.php", "install_mysql.bak");
	@rename("installok_mysql.php", "installok_mysql.bak");
	@unlink("../index.php");
	@rename("../inc/index.do", "../index.php");
}

//5.安装完成
echo "<br>数据库 <strong><font color=red>" . $database . "</font></strong> 安装成功!<br>";
echo "管理员用户名: <strong><font color=red>" . $uname . "</font></strong>,密码: <strong><font color=red>" . $pword . "</font></strong><br>";
echo "<div align='center'><a href=login.php>进入管理界面&gt;&gt;</a></div>";


//安装数据库
function insdatabase($database)
{
    @mysql_query("drop database $database");
	$sql =  "create database $database";
	if(mysql_query($sql))
	   echo "数据库 <strong>" . $database . "</strong> 创建成功!<br><br>";
    else
       echo "<span color=red>数据库 <strong>" . $database . "</strong> 创建失败!</span><br><br>";
}
function instable($sql, $tablename)
{
    @mysql_query("drop table if exists $tablename");
	if(mysql_query($sql))
	   echo "数据库表 <strong>" . $tablename . "</strong> 创建成功!<br>";
	else
	   echo "<span color=red>数据库表 <strong>" . $tablename . "</strong> 创建失败!</span><br>";
}
function insert($sql, $tablename, $print = 0)
{
    if(mysql_query($sql)){
		if($print == 1) echo "数据库表 <strong>" . $tablename . "</strong> 内容写入成功!<br>";
	}
	else echo "<span color=red>数据库表 <strong>" . $tablename . "</strong> 内容写入失败!</span><br>";
}
?>
</td>
    </tr>
  </table>
<div align="center">版权所有 <a href="http://www.w3cview.com" target="_blank">W3CVIEW视野</a></div>
