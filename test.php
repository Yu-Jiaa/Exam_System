<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
echo"<center><h1><font color=#0099FF>�u�W����t��(S)</font></h1></center>";
$stu_id=$_COOKIE["stu_id"];
$stu_pwd=$_COOKIE["stu_pwd"];
$result=mysql_query("select * from student where stu_id='$stu_id' and stu_pwd='$stu_pwd'");
$rows=mysql_num_rows($result);
if($rows==1)
{
	echo"<table align=center border=0 cellpadding=10 cellspacing=0 width=350>";
	echo"<form method=post action=stu_main.php>";
	echo"<tr align=center><td><input type=submit name=submit value=�^�D�e��></td>";
	echo"<input type=hidden name=stu_id value=$stu_id>";
	echo"<input type=hidden name=stu_pwd value=$stu_pwd>";
	echo"</form>";

	$submit=$_POST["submit"];
	if($submit=="�������")
	{	
		$num=$_POST["qus_num"];
		if(!empty($ans))
		{
			$ans=$_POST["ans"];
			$std=$_POST["std"];
			$qid=$_POST["qid"];
			echo"<form method=post action=test.php>";
			echo"<td><input type=submit name=submit value=���s����></td>";
			echo"<input type=hidden name=qus_num value=$num>";
			echo"</form>";
			echo"<form method=post action=score.php>";
			echo"<td><input type=submit name=submit value=���v���Z></td></tr>";
			echo"<input type=hidden name=stu_id value=$stu_id>";
			echo"</form>";
			echo"<tr align=center><td colspan=3><input type=radio checked><font size=-1>���A�����סA</font><font size=-1 color=red>���r</font><font size=-1>�����T����</font></td></tr>";
			echo"<table align=center border=0 cellpadding=5 cellspacing=0>";
			$right=0;
			for($i=1;$i<=$num;$i++)
			{
				if($ans[$i]==$std[$i])
					$right++;
				$sql="select * from question where qid=$qid[$i]";
				$rowdata=mysql_fetch_array(mysql_query($sql));
				echo"<tr><td><font color=#990000>$i.</font></td>";
				echo"<td><font color=#000099>$rowdata[qus]</font></td>";
				//echo"<td>";
				for($j=1;$j<=4;$j++)
				{
					if($j==$std[$i])
					{
						if($j==$ans[$i]){
							$j++;//��ܡA������
							echo"<td><input type=radio name=ans[$i] value=$j checked><font color=red>$rowdata[$j]</font>";
							$j--;}
						else{
							$j++;//����A������
							echo"<td><input type=radio name=ans[$i] value=$j><font color=red>$rowdata[$j]</font>";
							$j--;}
					}
					else
					{
						if($j==$ans[$i]){
							$j++;//��ܡA�D����
							echo"<td><input type=radio name=ans[$i] value=$j checked>$rowdata[$j]";
							$j--;}
						else{
							$j++;//����A�D����
							echo"<td><input type=radio name=ans[$i] value=$j>$rowdata[$j]";
							$j--;}
					}
				}
				echo"</td></tr>";
			}
			echo"</table>";	
			$score=round((100/$num)*$right);
			echo"<center><p>���� $right �D�I";
			if($score<60)
				echo"<font size=+2 color=red> $score </font>��</p></center>";
			else
				echo"<font size=+2 color=blue> $score </font>��</p></center>";
			$examtime=date("Y/m/d  H:i:s",time()+8*60*60);
			$sql="insert into score(stu_id,scores,examtime) values('$stu_id','$score','$examtime')";
			mysql_query($sql);
		}
		else
		{
			echo"</tr><tr align=center height=50><td><font size=+1 color=red>�z�|���@���I</td></tr>";
			echo"<form method=post action=test.php>";
			echo"<tr align=center height=50><td><input type=submit name=submit value=��^����></td></tr>";
			echo"<input type=hidden name=qus_num value=$num>";
			echo"</form>";
		}
	}
	else
	{
		echo"<form method=post action=score.php>";
		echo"<td><input type=submit name=submit value=���v���Z></td></tr>";
		echo"<input type=hidden name=stu_id value=$stu_id>";
		echo"</form>";
		$num=$_POST["qus_num"];	//��ܪ��D��
		$result=mysql_query("select * from question");
		$rows=mysql_num_rows($result);//�D�w��
		for($i=0;$i<=$rows;$i++)
			$a[$i]=0;
		//�H�üƦ�question��ƪ�椤�����D��
		for($i=1;$i<=$num;)
		{
			$x=rand(1,$rows);
			if($a[$x]==0)
			{
				$b[$i]=$x;
				$a[$x]=1;
				$i++;
			}
		}
		echo"<form action='' method=post name=form1>";
		//���5�D�D��
		echo"<table width=500 align=center border=0 cellpadding=5 cellspacing=0>";
		for($i=1;$i<=$num;$i++)
		{
			$sql="select * from question where qid=$b[$i]";
			$rowdata=mysql_fetch_array(mysql_query($sql));
			echo"<tr><td width=10><font color=#990000>$i.</font></td>";
			echo"<td colspan=5><font color=#000099>$rowdata[qus]</font></td></tr>";
			echo"<tr bgcolor=#FFCCCC><td width=10><td width=10><td><input type=radio name=ans[$i] value=1>$rowdata[op1]</td>";
			echo"<td><input type=radio name=ans[$i] value=2>$rowdata[op2]</td>";
			echo"<td><input type=radio name=ans[$i] value=3>$rowdata[op3]</td>";
			echo"<td><input type=radio name=ans[$i] value=4>$rowdata[op4]</td></tr>";
			echo"<input type=hidden name=std[$i] value=$rowdata[ans]>";
			echo"<input type=hidden name=qid[$i] value=$rowdata[qid]>";
			echo"<input type=hidden name=qus_num value=$num>";
		}
		echo"<p><tr><td align=center colspan=6 height=50><input type=submit name=submit value=�������></td></tr></p>";
		echo"</form></table>";
	}
}
else
{
	echo"<center>�z�|���n�J�A��<a href=stu_login.php>�n�J</a>�A���¡I</center>";
}
?>