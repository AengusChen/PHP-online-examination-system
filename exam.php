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
	$user=$_COOKIE["user"];
	echo "查看用户".$user."的历史考试成绩<p>";
	include "config.php";
	$sql="SELECT * FROM $test_exam WHERE name='$user'";				//遍历指定用户考试记录
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num==0)
	{
		echo "还没有用户的历史考试记录";
	}
	else															//如果有记录，则显示所有记录
	{
		echo "共有".$num."条历史考试记录";
		echo "<p>";
		echo "<table border='1'>";
		echo "<tr><td>序号</td><td>用户</td><td>成绩</td><td>考试日期</td></tr>";
		while($row=$result->fetch_array())
		{
			echo "<tr>";
			echo "<td>".$row["id"]."</td>";
			echo "<td>".$row["name"]."</td>";
			echo "<td>".$row["score"]."</td>";
			echo "<td>".$row["date"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	echo "<a href=index.php>返回</a>";
	echo "</center>";
}
?>
