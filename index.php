 <?php
header("Content-type: text/html; charset=gb2313"); 

//echo '中文';
 
?>
<?php
echo "<center>";

echo "欢迎使用在线考试系统！<p>";
if(!isset($_COOKIE["user"]) or $_COOKIE["user"]=="")							//如果没有登录
{
	echo "你还没有登录！<p>";
	echo "<a href='login.php'>登录</a>&nbsp;&nbsp;&nbsp;<a href=reg.php>注册</a>";
}
else
{
	echo "欢迎您：".$_COOKIE["user"];
	echo "<p>";
	include "config.php";
	$sql="SELECT admin FROM $test_user WHERE name='$_COOKIE[user]'";
	$result=$mysqli->query($sql);
	$admin=$result->fetch_array();
	if($admin[0]==0)								//如果是普通用户
	{
		echo "你是普通用户，点<a href='test.php'>这里</a>开始考试<p>";
		echo "点<a href='exam.php'>这里</a>查看历史测试成绩";
	}
	else											//如果是管理员
	{
		echo "你是管理员，点<a href='admin.php'>这里</a>对题库进行管理";
	}
	echo "<p>点<a href='edit_pass.php'>这里</a>修改密码<p>";
	echo "<p>点<a href='exit.php'>这里</a>退出登录<p>";
}
?>
