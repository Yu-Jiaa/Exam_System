<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
$result=mysql_query("select * from teacher where tea_id='$tea_id' and tea_pwd='$tea_pwd'");
$rows=mysql_num_rows($result);
echo"<center><h1><font color=#0099FF>�u�W����t��(T)</font></h1></center>";
if($rows==1)
{
	echo"<form method=post action=tea_main.php>";
	echo"<center><input type=submit name=submit value=�^�D�e��></center>";
	echo"<input type=hidden name=tea_id value=$tea_id>";
	echo"<input type=hidden name=tea_pwd value=$tea_pwd>";
	echo"</form>";
	$submit=$_POST["submit"];
	if($submit=="�ǥͦ��Z" || $submit=="��^")
	{
		$rowdata=mysql_fetch_array($result);
		$student=mysql_query("select * from student where stu_class=$rowdata[tea_class] order by stu_id Asc");
		echo"<table align=center border=0 cellpadding=10 cellspacing=0>";
		echo"<tr align=center><td align=center><font size=-1>�ǥͱb��</font></td><td><font size=-1>�ǥͦW�r</font></td><td><font size=-1>�ҸհO��</font></td></tr>";
		while($stu=mysql_fetch_array($student))
		{
			echo"<tr align=center><td><font size=-1>$stu[stu_id]</font></td><td>$stu[stu_name]</td>";
			echo"<form method=post action=tea_score.php>";
			echo"<td><input type=submit name=submit value=�d��></td></tr>";
			echo"<input type=hidden name=stu_id value=$stu[stu_id]>";
			echo"</form>";
		}
	}
	if($submit=="�d��")
	{
		$stu_id=$_POST["stu_id"];
		//echo $stu_id;
		$result1=mysql_query("select * from score where stu_id='$stu_id' order by examtime desc");
		$record=mysql_num_rows($result1);
		if($record==0)
			echo"<p><center><font size=+1 color=red> $record </font>�������A�|�����L����I</center><p>";
		else
		{
			echo"<p><center><font size=-1>��<font color=red> $record </font>�������I</font></center></p>";
			echo"<table align=center border=1 cellpadding=5 cellspacing=0>";
			echo"<tr align=center><td align=center><font size=-1>����</font></td><td><font size=-1>����ɶ�</font></td></tr>";
			while($rowdata=mysql_fetch_array($result1))
			{
				if($rowdata[scores]<60)
					echo"<tr align=center><td><font size=+1 color=red>$rowdata[scores]</font></td>";
				else
					echo"<tr align=center><td><font size=+1 color=blue>$rowdata[scores]</font></td>";
				echo"<td>$rowdata[examtime]</td></tr>";
			}
			echo"</table>";
		}
		echo"<form method=post action=tea_score.php>";
		echo"<p><center><input type=submit name=submit value=��^></center></p>";
		echo"</form>";
	}
}
else
{
	echo"<center>�z�|���n�J�A��<a href=tea_login.php>�n�J</a>�A���¡I</center>";
}
?>