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
	if(!isset($_POST["pass"]))				//���û��POSTֵ����ʾǰ̨��
	{
		?>
<table border=1>
<form actioin="login.php" method="post">
<tr>
<td colspan="2" align="center">�޸�����</td>
</tr>
<tr>
<td>�û�����</td>
<td><?php echo $_COOKIE["user"]?></td>
</tr>
<tr>
<td>��������룺</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>���������룺</td>
<td><input type="password" name="new_pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="ȷ���޸�"></td>
</tr>
</from>
</table>
<a href="index.php">����</a>
		<?php
	}
	else
	{
		$user=$_COOKIE["user"];				//��ȡ��������
		$pass=$_POST["pass"];
		$new_pass=$_POST["new_pass"];
		include "config.php";
		$sql="SELECT COUNT(id) FROM $test_user WHERE name='$user' AND pass='$pass'";
		$result=$mysqli->query($sql);
		$num=$result->num_rows;
		if($num==0)						//�ж�ԭʼ�����Ƿ���ȷ
		{
			echo "�û��������������!<p>";
			echo "���<a href='edit_pass.php'>����</a>��������";
		}
		else								//�����ȷ���޸�����
		{
			$sql="UPDATE $test_user SET pass='$new_pass' WHERE name='$user' AND pass='$pass'";
			$result=$mysqli->query($sql);
			if($result)
			{
				echo "�ɹ��޸�����<p>";
				echo "���<a href='index.php'>����</a>����";
			}
			else
			{
				echo "�޸��������";
			}
		}
	}
}
?>
