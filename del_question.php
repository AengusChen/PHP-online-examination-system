<center>
ɾ����Ŀ
<?php
header("Content-type: text/html; charset=gb2313"); 
include "check_admin.php";
if(!isset($_POST["id"]))			//���û��POSTֵ����ʾ����ȷ��ɾ��
{
	include "config.php";
	$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	echo "<table border='1'>\n";
	echo "<form action='".$_SERVER["PHP_SELF"]."' method='post'>\n";
	echo "<tr><td>��Ŀ���ݣ�</td><td>";
	echo $row["content"];
	echo "</td></tr>\n";
	echo "<input type=hidden name='id' value='".$row["id"]."'>\n";
	echo "<input type=hidden name='type' value='".$row["type"]."'>\n";
	echo "<tr><td colspan='2' align='center'><input type='submit' value='ȷ��ɾ��'></td></tr>\n";
	echo "</form>\n";
	echo "</table>\n";
	echo "<p><a href=admin.php>����</a>\n";
}
else
{
	include "config.php";
	$id=$_POST["id"];			//��ȡPOSTֵ
	$type=$_POST["type"];
	$sql="DELETE FROM $test_question WHERE id='$id'";
	$result=$mysqli->query($sql) or die($mysqli_error);
	if($type=="1")				//�����ѡ���⣬��Ҫɾ������ѡ����
	{
		$sql2="DELETE FROM $test_answer WHERE question='$id'";
		$result2=$mysqli->query($sql2) or die($mysqli->error);
	}
	if($result)
	{
		echo "<p>�ɹ�ɾ�����";
		echo "���<a href=admin.php>����</a>����";
	}
	else echo "ɾ��������";
}
?>
</center>
