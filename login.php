 <?php
header("Content-type: text/html; charset=gb2313"); 

//echo '中文';
 
?>
<?php
if(!isset($_POST["user"]))								//如果没有输入内容显示表单
{
	echo "<center>";
?>
<table border=1>
<form actioin="login.php" method="post">
<tr>
<td colspan="2" align="center">用户登录</td>
</tr>
<tr>
<td>输入用户名：</td>
<td><input type="text" name="user"></td>
</tr>
<tr>
<td>输入密码：</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="登录"></td>
</tr>
</from>
</table>
<p><a href=index.php>返回首页</a>
<?php
}
else												//如果有输入内容执行操作
{
	include "config.php";
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$sql="SELECT COUNT(id) FROM $test_user WHERE name='$user' AND pass='$pass'";
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num==0)								//判断用户密码是否正确
	{
		echo "用户名或者密码错误!<p>";
		echo "点击<a href='login.php'>这里</a>重新登录 ";
	}
	else											//如果正确定义COOKIE
	{
		setcookie("user",$user);
		echo "成功登录<p>";
		echo "点击<a href='index.php'>这里</a>进入系统 ";
	}
}
?>
</center>
