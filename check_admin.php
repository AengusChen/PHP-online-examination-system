<?php       
include "config.php";
$sql="SELECT COUNT(admin) FROM $test_user WHERE name='$_COOKIE[user]'";
$result=$mysqli->query($sql);
$admin=$result->fetch_row();			//检查登录用户是否为管理员
if($admin[0]==0)
{
  header("Content-type: text/html; charset=gb2313"); 
	echo "你不是管理员，不能执行该操作！";
	exit("");
}
?>
