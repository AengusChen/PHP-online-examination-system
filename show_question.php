
<center>
�鿴��Ŀ����

<?php
include "check_admin.php";
include "config.php";
$sql="SELECT * FROM $test_question WHERE id='$_GET[id]'";
$result=$mysqli->query($sql);
$row=$result->fetch_array();
header("Content-type: text/html; charset=gb2313"); 
echo "<table border='1'>";
echo "<tr><td>��Ŀ���ͣ�</td><td>";
if($row["type"]==1) echo "ѡ����";
else echo "�ж���";
echo "</td></tr>";
echo "<tr><td>��Ŀ���ݣ�</td><td>";
echo $row["content"];
echo "</td></tr>";
echo "<tr><td>��Ŀ�𰸣�</td><td>";
if($row["type"]==1)
{
	$sql2="SELECT * FROM $test_answer WHERE question='$_GET[id]'";
	$result2=$mysqli->query($sql2);
	while($row2=$result2->fetch_array())
	{
		echo $row2["content"];
		if($row2["answer"]==1) echo "    ��ȷ";
		echo "<br>";
	}
}
else
{
	if($row["answer"]==1) echo "��ȷ";
	else echo "����";
}
echo "</td></tr>";
echo "</table>";
echo "<p><a href=admin.php>����</a>";
?>
</center>
