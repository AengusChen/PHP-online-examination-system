<?php
$host_name="localhost";									//��������
$host_user="root";										//���ӷ��������û���
$host_pass="";											//���ӷ�����������
$db_name="test";										//�������ϵĿ������ݿ�
$test_user="test_user";									//�û�������
$test_question="test_question";							//���������
$test_answer="test_answer";								//�𰸱�����
$test_exam="test_exam";									//�𰸱�����
$mysqli=new mysqli($host_name,$host_user,$host_pass,$db_name);//�������
$mysqli->query("set names 'gb2312'");						//���ñ���Ϊ���ġ�
?>
