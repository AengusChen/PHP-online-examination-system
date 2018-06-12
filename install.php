<center>
<?php
if(!isset($_POST["user"]))							//如果没有输入内容，显示表单
{
?>
<table border=1>
<form actioin="install.php" method="post">
<tr>
<td colspan="2" align="center">输入管理员信息</td>
</tr>
<tr>
<td>输入管理员名称：</td>
<td><input type="text" name="user"></td>
</tr>
<tr>
<td>输入管理员密码：</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="开始安装"></td>
</tr>
</from>
</table>
<?php
}
else										//如果有输入内容，执行建表操作
{
include "config.php";							//调用配置文件
$sql1="CREATE TABLE $test_user(
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `name` VARCHAR(12) NOT NULL DEFAULT '',
    `pass` VARCHAR(12) NOT NULL DEFAULT '',
    `admin` INT(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
$step1=$mysqli->query($sql1) or die($mysqli->error);
$sql2="CREATE TABLE $test_question(
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `content` VARCHAR(200) NOT NULL DEFAULT '',
    `type` INT(1) NOT NULL DEFAULT 0,
	`answer` INT(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
$step2=$mysqli->query($sql2) or die($mysqli->error);
$sql3="CREATE TABLE $test_answer(
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `content` VARCHAR(200) NOT NULL DEFAULT '',
    `question` INT(5) NOT NULL DEFAULT 0,
    `answer` INT(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
$step3=$mysqli->query($sql3) or die($mysqli->error);
$sql4="CREATE TABLE $test_exam(
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `name` VARCHAR(12) NOT NULL DEFAULT '',
    `score` INT(5) NOT NULL DEFAULT 0,
    `date` VARCHAR(20) NOT NULL DEFAULT ''
)ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
$step4=$mysqli->query($sql4) or die($mysqli->error);
$user=$_POST["user"];
$pass=$_POST["pass"];
$sql5="INSERT INTO $test_user (name,pass,admin) VALUES('$user','$pass',1)";
$step5=$mysqli->query($sql5) or die($mysqli_error);
	if($step1 and $step2 and $step3 and $step4 and $step5)
	{
		echo "成功安装<p>";
		echo "管理员名称为：$user";
		echo "点击<a href='index.php'>这里</a>进入系统 ";
	}
}
?>
