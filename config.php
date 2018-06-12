<?php
$host_name="localhost";									//服务器名
$host_user="root";										//连接服务器的用户名
$host_pass="";											//连接服务器的密码
$db_name="test";										//服务器上的可用数据库
$test_user="test_user";									//用户表名称
$test_question="test_question";							//问题表名称
$test_answer="test_answer";								//答案表名称
$test_exam="test_exam";									//答案表名称
$mysqli=new mysqli($host_name,$host_user,$host_pass,$db_name);//定义对象
$mysqli->query("set names 'gb2312'");						//设置编码为中文。
?>
