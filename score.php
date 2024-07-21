<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
echo"<center><h1><font color=#0099FF>線上測驗系統(S)</font></h1></center>";
$stu_id=$_COOKIE["stu_id"];
$stu_pwd=$_COOKIE["stu_pwd"];
$result=mysql_query("select * from student where stu_id='$stu_id' and stu_pwd='$stu_pwd'");
$rows=mysql_num_rows($result);
if($rows==1)
{
	echo"<table align=center border=0 cellpadding=10 cellspacing=0 width=350>";
	echo"<form method=post action=stu_main.php>";
	echo"<tr align=center><td><input type=submit name=submit value=回主畫面></td>";
	echo"<input type=hidden name=stu_id value=$stu_id>";
	echo"<input type=hidden name=stu_pwd value=$stu_pwd>";
	echo"</form></table>";
	$result1=mysql_query("select * from score where stu_id='$stu_id' order by examtime desc");
	$record=mysql_num_rows($result1);
	if($record==0)
		echo"<p><center><font size=+1 color=red> $record </font>筆紀錄，您尚未做過考試！</center><p>";
	else
	{
		echo"<p><center><font size=-1>有<font color=red> $record </font>筆紀錄！</font></center></p>";
		echo"<table align=center border=1 cellpadding=5 cellspacing=0>";
		echo"<tr align=center><td align=center><font size=-1>分數</font></td><td><font size=-1>測驗時間</font></td></tr>";
		while($rowdata=mysql_fetch_array($result1))
		{
			if($rowdata[scores]<60)
				echo"<tr align=center><td><font size=+1 color=red>$rowdata[scores]</font></td>";
			else
				echo"<tr align=center><td><font size=+1 color=blue>$rowdata[scores]</font></td>";
			echo"<td>$rowdata[examtime]</td></tr>";
		}
	}
}
else
{
	echo"<center>您尚未登入，請<a href=stu_login.php>登入</a>，謝謝！</center>";
}
?>