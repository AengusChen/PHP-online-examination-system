<center>
�޸���Ŀ����
<?php
header("Content-type: text/html; charset=gb2313"); 
include "check_admin.php";
if(!isset($_POST["content"]))				//���û��POST���ݣ���ʾǰ̨��
{
	include "config.php";
	$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	echo "<table border='1'>\n";
	echo "<form action='".$_SERVER["PHP_SELF"]."' method='post'>\n";
	echo "<tr><td>��Ŀ���ͣ�</td><td>\n";
	if($row["type"]==1) echo "ѡ����";
	else echo "�ж���";
	echo "</td></tr>\n";
	echo "<tr><td>��Ŀ���ݣ�</td><td>";
	echo "<input type='text' name='content' value='".$row["content"]."' size='30'>";
	echo "</td></tr>\n";
	echo "<tr><td>��Ŀ�𰸣�</td><td>";
	if($row["type"]==1)				//��ʾѡ��������ѡ��������
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
	else							//��ʾ�ж�����ȷ�����
	{
		echo "<input type=radio value=1 name='answer'";
		if($row["answer"]==1) echo " checked ";
		echo ">��ȷ\n";
		echo "<input type=radio value=0 name='answer'";
		if($row["answer"]==2) echo " checked ";
		echo ">����\n";
	}
	echo "<input type=hidden name='id' value='".$row["id"]."'>\n";
	echo "<input type=hidden name='type' value='".$row["type"]."'>\n";
	echo "</td></tr>\n";
	echo "<tr><td colspan='2' align='center'><input type='submit' value='ȷ���޸�'></td></tr>\n";
	echo "</form>\n";
	echo "</table>\n";
	echo "<p><a href=admin.php>����</a>\n";
}
else
{
	$id=$_POST["id"];				//��ȡ��������
	$content=$_POST["content"];
	$type=$_POST["type"];
	$answer=$_POST["answer"];
	include "config.php";
	if($type==1)					//�����ѡ���⣬���˸�����Ŀ���ݻ�Ҫ�޸�ѡ��������
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
			echo "<p>�ɹ��޸����<p>";
			echo "���<a href=admin.php>����</a>����";
		}
		else echo "�޸�������";
	}
	else						//������ж��⣬ֻ��Ҫ�޸���Ŀ���ݼ���
	{
		$sql="UPDATE $test_question SET content='$content',answer='$answer' WHERE id='$id'";
		$result=$mysqli->query($sql) or die($mysqli_error);
		if($result)
		{
			echo "<p>�ɹ��޸����<p>";
			echo "���<a href=admin.php>����</a>����";
		}
		else echo "<p>�޸�������";
	}
}
?>
</center>
