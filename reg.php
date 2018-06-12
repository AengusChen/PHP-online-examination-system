 <?php
header("Content-type: text/html; charset=gb2313"); 
//echo '中文';
?>
<center>
<?php
if(!isset($_POST["user"]))									//如果没有输入内容显示表单
{
?>
<table border=1>
<form actioin="reg.php" method="post">
<tr>
<td colspan="2" align="center">用户注册</td>
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
<td colspan="2" align="center"><input type="submit" value="注册"></td>
</tr>
</from>
</table>
<p><a href=index.php>返回</a>
<?php
}
else													//如果有输入内容则进行后台操作
{
	include "config.php";
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$sql="SELECT * FROM $test_user WHERE name='$user'";
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num>0)
	{
		echo "用户名已经存在!<p>";
		echo "点击<a href='reg.php'>这里</a>重新注册 ";
	}
	else
	{
		$sql="INSERT INTO $test_user (name,pass,admin) VALUES('$user','$pass',0)";
		$result=$mysqli->query($sql) or die($mysql->error);
		if($result)
		{
			echo "成功注册<p>";
			echo "点击<a href='login.php'>这里</a>登录系统 ";
		}
	}
}
?>
</center>
