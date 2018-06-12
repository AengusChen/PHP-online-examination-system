<center>
删除题目
<?php
header("Content-type: text/html; charset=gb2313"); 
include "check_admin.php";
if(!isset($_POST["id"]))			//如果没有POST值，显示表单，确认删除
{
	include "config.php";
	$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	echo "<table border='1'>\n";
	echo "<form action='".$_SERVER["PHP_SELF"]."' method='post'>\n";
	echo "<tr><td>题目内容：</td><td>";
	echo $row["content"];
	echo "</td></tr>\n";
	echo "<input type=hidden name='id' value='".$row["id"]."'>\n";
	echo "<input type=hidden name='type' value='".$row["type"]."'>\n";
	echo "<tr><td colspan='2' align='center'><input type='submit' value='确认删除'></td></tr>\n";
	echo "</form>\n";
	echo "</table>\n";
	echo "<p><a href=admin.php>返回</a>\n";
}
else
{
	include "config.php";
	$id=$_POST["id"];			//获取POST值
	$type=$_POST["type"];
	$sql="DELETE FROM $test_question WHERE id='$id'";
	$result=$mysqli->query($sql) or die($mysqli_error);
	if($type=="1")				//如果是选择题，还要删除所有选择项
	{
		$sql2="DELETE FROM $test_answer WHERE question='$id'";
		$result2=$mysqli->query($sql2) or die($mysqli->error);
	}
	if($result)
	{
		echo "<p>成功删除题库";
		echo "点击<a href=admin.php>这里</a>返回";
	}
	else echo "删除题库出错";
}
?>
</center>
