<?php       
include "config.php";
$sql="SELECT COUNT(admin) FROM $test_user WHERE name='$_COOKIE[user]'";
$result=$mysqli->query($sql);
$admin=$result->fetch_row();			//����¼�û��Ƿ�Ϊ����Ա
if($admin[0]==0)
{
  header("Content-type: text/html; charset=gb2313"); 
	echo "�㲻�ǹ���Ա������ִ�иò�����";
	exit("");
}
?>
