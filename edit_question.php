<center>
修改题目内容
<?php
header("Content-type: text/html; charset=gb2313"); 
include "check_admin.php";
if(!isset($_POST["content"]))				//如果没有POST内容，显示前台表单
{
	include "config.php";
	$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	echo "<table border='1'>\n";
	echo "<form action='".$_SERVER["PHP_SELF"]."' method='post'>\n";
	echo "<tr><td>题目类型：</td><td>\n";
	if($row["type"]==1) echo "选择题";
	else echo "判断题";
	echo "</td></tr>\n";
	echo "<tr><td>题目内容：</td><td>";
	echo "<input type='text' name='content' value='".$row["content"]."' size='30'>";
	echo "</td></tr>\n";
	echo "<tr><td>题目答案：</td><td>";
	if($row["type"]==1)				//显示选择题所有选择项内容
	{
		$sql2="SELECT * FROM $test_answer WHERE question='$_GET[id]'";
		$result2=$mysqli->query($sql2);
		while($row2=$result2->fetch_array())
		{
			echo "<input type='text' name='answer[]' value='".$row2["content"]."'>\n";
			echo "<input type='hidden' name='answer_id[]'  value='".$row2["id"]."'>\n";
			echo "<input type=radio name='check' value=".$row2["id"];
			if($row2["answer"]==1) echo " checked ";
			echo ">\n";
			echo "<br>\n";
		}
	}
	else							//显示判断题正确与错误
	{
		echo "<input type=radio value=1 name='answer'";
		if($row["answer"]==1) echo " checked ";
		echo ">正确\n";
		echo "<input type=radio value=0 name='answer'";
		if($row["answer"]==2) echo " checked ";
		echo ">错误\n";
	}
	echo "<input type=hidden name='id' value='".$row["id"]."'>\n";
	echo "<input type=hidden name='type' value='".$row["type"]."'>\n";
	echo "</td></tr>\n";
	echo "<tr><td colspan='2' align='center'><input type='submit' value='确认修改'></td></tr>\n";
	echo "</form>\n";
	echo "</table>\n";
	echo "<p><a href=admin.php>返回</a>\n";
}
else
{
	$id=$_POST["id"];				//获取输入内容
	$content=$_POST["content"];
	$type=$_POST["type"];
	$answer=$_POST["answer"];
	include "config.php";
	if($type==1)					//如果是选择题，除了更新题目内容还要修改选择项内容
	{
		$check=$_POST["check"];
		$answer_id=$_POST["answer_id"];
		$sql="UPDATE $test_question SET content='$content' WHERE id='$id'";
		$result=$mysqli->query($sql) or die($mysqli->error);
		for($i=0;$i<4;$i+=1)
		{
			$s="UPDATE $test_answer SET content='$answer[$i]'";
			if($check==$answer_id[$i])
			{
				$s=$s.", answer=1";
			}
			else
			{
				$s=$s.", answer=0";
			}
			$s=$s." WHERE id='$answer_id[$i]'";
			$result=$mysqli->query($s) or die($mysqli->error);
		}
		if($result)
		{
			echo "<p>成功修改题库<p>";
			echo "点击<a href=admin.php>这里</a>返回";
		}
		else echo "修改题库出错";
	}
	else						//如果是判断题，只需要修改题目内容及答案
	{
		$sql="UPDATE $test_question SET content='$content',answer='$answer' WHERE id='$id'";
		$result=$mysqli->query($sql) or die($mysqli_error);
		if($result)
		{
			echo "<p>成功修改题库<p>";
			echo "点击<a href=admin.php>这里</a>返回";
		}
		else echo "<p>修改题库出错";
	}
}
?>
</center>
