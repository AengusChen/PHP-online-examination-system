 <?php
header("Content-type: text/html; charset=gb2313"); 
//echo '����';
?>
<?php     
echo "<center>";
include "check_admin.php";
echo "������<p>";
echo "<a href='add_question.php'>������</a><p>";
include "config.php";
$sql="SELECT * FROM $test_question";				//�������м�¼
$result=$mysqli->query($sql);
$num=$result->num_rows;					//��ȡ��¼����
if($num==0)
{
	echo "��û������¼";
}
else
{
	echo "����".$num."������¼";
	echo "<p>";
	echo "<table border='1'>";
	echo "<tr><td>���</td><td>��Ŀ</td><td>����</td><td>�鿴</td><td>�޸�</td><td>ɾ��</td></tr>";
	while($row=$result->fetch_array())		//ѭ����ʾ���м�¼
	{
		echo "<tr>";
		echo "<td>".$row["id"]."</td>";
		echo "<td>".$row["content"]."</td>";
		echo "<td>";
		if($row["type"]==1) echo "ѡ����";
		else echo "�ж���";
		echo "</td>";
		echo "<td><a href=show_question.php?id=".$row[0].">�鿴</a></td>";
		echo "<td><a href=edit_question.php?id=".$row[0].">�޸�</a></td>";
		echo "<td><a href=del_question.php?id=".$row[0].">ɾ��</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}
echo "<p><a href=index.php>����</a>\n";
echo "</center>";
?>
