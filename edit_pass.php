 <?php
header("Content-type: text/html; charset=gb2313"); 
//echo '中文';
?>
<?php
echo "<center>";
echo "欢迎使用在线考试系统！<p>";
if(!isset($_COOKIE["user"]))
{
	echo "你还没有登录！<p>";
	echo "<a href='login.php'>登录</a>&nbsp;&nbsp;&nbsp;<a href=reg.php>注册</a>";
}
else
{
	if(!isset($_POST["pass"]))				//如果没有POST值，显示前台表单
	{
		?>
<table border=1>
<form actioin="login.php" method="post">
<tr>
<td colspan="2" align="center">修改密码</td>
</tr>
<tr>
<td>用户名：</td>
<td><?php echo $_COOKIE["user"]?></td>
</tr>
<tr>
<td>输入旧密码：</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>输入新密码：</td>
<td><input type="password" name="new_pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="确认修改"></td>
</tr>
</from>
</table>
<a href="index.php">返回</a>
		<?php
	}
	else
	{
		$user=$_COOKIE["user"];				//获取输入内容
		$pass=$_POST["pass"];
		$new_pass=$_POST["new_pass"];
		include "config.php";
		$sql="SELECT COUNT(id) FROM $test_user WHERE name='$user' AND pass='$pass'";
		$result=$mysqli->query($sql);
		$num=$result->num_rows;
		if($num==0)						//判断原始密码是否正确
		{
			echo "用户名或者密码错误!<p>";
			echo "点击<a href='edit_pass.php'>这里</a>重新输入";
		}
		else								//如果正确则修改密码
		{
			$sql="UPDATE $test_user SET pass='$new_pass' WHERE name='$user' AND pass='$pass'";
			$result=$mysqli->query($sql);
			if($result)
			{
				echo "成功修改密码<p>";
				echo "点击<a href='index.php'>这里</a>返回";
			}
			else
			{
				echo "修改密码出错";
			}
		}
	}
}
?>
