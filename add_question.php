<?php
header("Content-type: text/html; charset=gb2313"); 
echo "<center>";
include "check_admin.php";
echo "������<p>\n";
if(!isset($_POST["type"]))				//���û������������ʾǰ̨��
{
	?>
	<table border="1">
	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
	<tr><td colspan="2" align="center">��ѡ����Ŀ����</td></tr>
	<tr>
	<td>��Ŀ����</td>
	<td>
	<select size="1" name="type">
	<option value="1">ѡ����</option>
	<option value="2">�ж���</option>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	<input type="submit" value="��һ��">
	</td>
	</tr>
	</form>
	</table>
<?php
}
else if(!isset($_POST["content"]))			//�ڶ�������ʾ��������Ŀ����
{
	?>
	<table border="1">
	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
	<tr>
	<td>��Ŀ���ͣ�</td>
	<td><?php
	if($_POST["type"]==1) echo "ѡ����";
	else echo "�ж���";
	?>
	</td></tr>
	<tr>
	<td>��������Ŀ����</td>
	<td><input type="text" name="content" size="30"></td>
	<tr>
	<tr>
	<td>������/ѡ������</td>
	<td>
	<?php
		if($_POST["type"]==1)
		{
		for($i=0;$i<4;$i++)
		{
			echo ($i+1).".<input type=text name='answer[]'>\n";
			echo "<input type=radio name='check' value=".$i."><br>\n";
		}
	}
	else
	{
		echo "<input type=radio value=1 name='answer'>��ȷ\n";
		echo "<input type=radio value=2 name='answer'>����\n<p>";
	}
	echo "��ѡ����Ϊ��ȷ��";
	?>
	</td>
	<tr>

	</tr>
	<td colspan="2" align="center">
	<input type="hidden" name="type" value="<?php echo $_POST["type"]?>">
	<input type="button" value="��һ��"; onclick="history.go(-1)"><input type="submit" value="��һ��">
	</td>
	</tr>
	</form>
	</table>
<?php
}
else					//��ȡ�����������ݣ�������¼�������
{
	$type=$_POST["type"];
	$content=$_POST["content"];
	$answer=$_POST["answer"];
	include "config.php";
	if($type==2)
	{
		$sql="INSERT INTO $test_question(content,type,answer) VALUES('$content','$type','$answer')";
		$result=$mysqli->query($sql) or die($mysqli->error);
		if($result)
		{
			echo "�ɹ�������";
			echo "���<a href=admin.php>����</a>����";
		}
		else echo "���������";
	}
	else
	{
		$check=$_POST["check"];
		$sql="INSERT INTO $test_question(content,type) VALUES('$content','$type')";
		$result=$mysqli->query($sql) or die($mysqli->error);
		$question_id=$mysqli->insert_id;
		$sql2="INSERT INTO $test_answer(content,question,answer) VALUES";
		for($i=0;$i<4;$i++)
		{
			$sql2=$sql2."(";
			$sql2=$sql2."'".$answer[$i]."',";
			$sql2=$sql2.$question_id.",";
			if($check==$i) $sql2=$sql2."1)";
			else $sql2=$sql2."0)";
			if($i<3) $sql2=$sql2.",";
		}
		$result2=$mysqli->query($sql2) or die($mysqli->error);
		if($result and $result2)
		{
			echo "�ɹ�������";
			echo "���<a href=admin.php>����</a>����";
		}
		else echo "���������";
	}
}
echo "</center>";
?>
