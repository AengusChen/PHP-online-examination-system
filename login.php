 <?php
header("Content-type: text/html; charset=gb2313"); 

//echo '����';
 
?>
<?php
if(!isset($_POST["user"]))								//���û������������ʾ��
{
	echo "<center>";
?>
<table border=1>
<form actioin="login.php" method="post">
<tr>
<td colspan="2" align="center">�û���¼</td>
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
<td colspan="2" align="center"><input type="submit" value="��¼"></td>
</tr>
</from>
</table>
<p><a href=index.php>������ҳ</a>
<?php
}
else												//�������������ִ�в���
{
	include "config.php";
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$sql="SELECT COUNT(id) FROM $test_user WHERE name='$user' AND pass='$pass'";
	$result=$mysqli->query($sql);
	$num=$result->num_rows;
	if($num==0)								//�ж��û������Ƿ���ȷ
	{
		echo "�û��������������!<p>";
		echo "���<a href='login.php'>����</a>���µ�¼ ";
	}
	else											//�����ȷ����COOKIE
	{
		setcookie("user",$user);
		echo "�ɹ���¼<p>";
		echo "���<a href='index.php'>����</a>����ϵͳ ";
	}
}
?>
</center>
