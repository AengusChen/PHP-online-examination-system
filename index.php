 <?php
header("Content-type: text/html; charset=gb2313"); 

//echo '����';
 
?>
<?php
echo "<center>";

echo "��ӭʹ�����߿���ϵͳ��<p>";
if(!isset($_COOKIE["user"]) or $_COOKIE["user"]=="")							//���û�е�¼
{
	echo "�㻹û�е�¼��<p>";
	echo "<a href='login.php'>��¼</a>&nbsp;&nbsp;&nbsp;<a href=reg.php>ע��</a>";
}
else
{
	echo "��ӭ����".$_COOKIE["user"];
	echo "<p>";
	include "config.php";
	$sql="SELECT admin FROM $test_user WHERE name='$_COOKIE[user]'";
	$result=$mysqli->query($sql);
	$admin=$result->fetch_array();
	if($admin[0]==0)								//�������ͨ�û�
	{
		echo "������ͨ�û�����<a href='test.php'>����</a>��ʼ����<p>";
		echo "��<a href='exam.php'>����</a>�鿴��ʷ���Գɼ�";
	}
	else											//����ǹ���Ա
	{
		echo "���ǹ���Ա����<a href='admin.php'>����</a>�������й���";
	}
	echo "<p>��<a href='edit_pass.php'>����</a>�޸�����<p>";
	echo "<p>��<a href='exit.php'>����</a>�˳���¼<p>";
}
?>
