 <?php
header("Content-type: text/html; charset=gb2313"); 
//echo '����';
?>
<center>
<?php
if(!isset($_POST["user"]))									//���û������������ʾ��
{
?>
<table border=1>
<form actioin="reg.php" method="post">
<tr>
<td colspan="2" align="center">�û�ע��</td>
</tr>
<tr>
<td>�����û�����</td>
<td><input type="text" name="user"></td>
</tr>
<tr>
<td>�������룺</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="ע��"></td>
</tr>
</from>
</table>
<p><a href=index.php>����</a>
<?php
}
else													//�����������������к�̨����
{
	include "config.php";
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$sql="SELECT * FROM $test_user WHERE name='$user'";
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num>0)
	{
		echo "�û����Ѿ�����!<p>";
		echo "���<a href='reg.php'>����</a>����ע�� ";
	}
	else
	{
		$sql="INSERT INTO $test_user (name,pass,admin) VALUES('$user','$pass',0)";
		$result=$mysqli->query($sql) or die($mysql->error);
		if($result)
		{
			echo "�ɹ�ע��<p>";
			echo "���<a href='login.php'>����</a>��¼ϵͳ ";
		}
	}
}
?>
</center>
