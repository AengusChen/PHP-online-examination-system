 <?php
header("Content-type: text/html; charset=gb2313"); 
//echo '����';
?>
<?php
echo "<center>";
echo "��ӭʹ�����߿���ϵͳ��<p>";

if(!isset($_COOKIE["user"]))
{
	echo "�㻹û�е�¼��<p>";
	echo "<a href='login.php'>��¼</a>&nbsp;&nbsp;&nbsp;<a href=reg.php>ע��</a>";
}
else
{
	$user=$_COOKIE["user"];
	echo "�鿴�û�".$user."����ʷ���Գɼ�<p>";
	include "config.php";
	$sql="SELECT * FROM $test_exam WHERE name='$user'";				//����ָ���û����Լ�¼
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num==0)
	{
		echo "��û���û�����ʷ���Լ�¼";
	}
	else															//����м�¼������ʾ���м�¼
	{
		echo "����".$num."����ʷ���Լ�¼";
		echo "<p>";
		echo "<table border='1'>";
		echo "<tr><td>���</td><td>�û�</td><td>�ɼ�</td><td>��������</td></tr>";
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
	echo "<a href=index.php>����</a>";
	echo "</center>";
}
?>
