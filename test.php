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
	if(!isset($_POST["c"]))									//���û���ύ������ʾ��Ŀ
	{
	echo "��ӭ����".$_COOKIE["user"];
	echo "<p>���ڿ�ʼ����<p>\n";
	echo "</center>";
	include "config.php";
	echo "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
	echo "һ��ѡ���⣨ÿ��1�֣�<p>\n";
	$sql="SELECT * FROM $test_question WHERE type=1 order by rand() LIMIT 5";
	$result=$mysqli->query($sql);
	$i=1;
	while($row=$result->fetch_array())
	{
		echo $i."��";
		echo $row["content"];
		echo "<br>\n";
		$s="SELECT * FROM $test_answer WHERE question='$row[id]'";
		$r=$mysqli->query($s);
		$head=65;
		while($row2=$r->fetch_array())
		{
			echo chr($head).".";
			echo $row2["content"];
			echo "<input type='radio' name=c[".($i-1)."] value=".$row2["id"].">\n";
			echo "<br>\n";
			$head+=1;
		}
		$i+=1;
		echo "<p>\n";
	}
	echo "�����ж��⣨ÿ��1�֣�<p>\n";
	$sql="SELECT * FROM $test_question WHERE type=2  order by rand() LIMIT 5";
	$result=$mysqli->query($sql);
	$i=1;
	while($row=$result->fetch_array())
	{
		echo $i."��";
		echo $row["content"];
		echo "<br>\n";
		echo "��ȷ<input type='radio' name=d[".($i-1)."] value='1'>\n";
		echo "����<input type='radio' name=d[".($i-1)."] value='0'>\n";
		echo "<input type='hidden' name=s[] value=".$row["id"].">\n";
		$i+=1;
		echo "<p>\n";
	}
	echo "<p><input type='submit' value='��ɿ���'>";
	echo "</form>";
	}
	else											//����ύ�������ȡ���ݲ����в���
	{
		$c=$_POST["c"];
		$d=$_POST["d"];
		$s=$_POST["s"];
		$score=0;
		$num1=count($c);
		$num2=count($d);
		include "config.php";
		for($i=0;$i<$num1;$i++)
		{
			$sql="SELECT answer FROM $test_answer WHERE id='$c[$i]'";
			$result=$mysqli->query($sql);
			$a=$result->fetch_row();
			if($a[0]==1) $score+=1;
		}
		for($i=0;$i<$num2;$i++)
		{
			$sql="SELECT id FROM $test_question WHERE id='$s[$i]' AND answer='$d[$i]'";
			$result=$mysqli->query($sql);
			$num=$result->num_rows;
			if($num>0) $score+=1;
		}
		$date=date('Y-m-d H:i:s');
		echo "��ĵ÷�Ϊ��".$score;
		$sql="INSERT INTO $test_exam (name,score,date) VALUES('$_COOKIE[user]','$score','$date')";
		$result=$mysqli->query($sql);
		if($result)
		{
			echo "<p>�Ѿ����˴γɼ����<p>";
			echo "���<a href=index.php>����</a>����";
		}
		else
		{
			echo "<p>�ɼ���������<p>";
			echo "���<a href=index.php>����</a>����";
		}
	}
}
?>
