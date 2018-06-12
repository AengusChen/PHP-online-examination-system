
<center>
查看题目详情

<?php
include "check_admin.php";
include "config.php";
$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
$result=$mysqli->query($sql);
$row=$result->fetch_array();
header("Content-type: text/html; charset=gb2313"); 
echo "<table border='1'>";
echo "<tr><td>题目类型：</td><td>";
if($row["type"]==1) echo "选择题";
else echo "判断题";
echo "</td></tr>";
echo "<tr><td>题目内容：</td><td>";
echo $row["content"];
echo "</td></tr>";
echo "<tr><td>题目答案：</td><td>";
if($row["type"]==1)
{
	$sql2="SELECT * FROM $test_answer WHERE question='$_GET[id]'";
	$result2=$mysqli->query($sql2);
	while($row2=$result2->fetch_array())
	{
		echo $row2["content"];
		if($row2["answer"]==1) echo "    正确";
		echo "<br>";
	}
}
else
{
	if($row["answer"]==1) echo "正确";
	else echo "错误";
}
echo "</td></tr>";
echo "</table>";
echo "<p><a href=admin.php>返回</a>";
?>
</center>
