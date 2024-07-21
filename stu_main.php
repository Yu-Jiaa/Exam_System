<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
$stu_id=$_POST["stu_id"];
$stu_pwd=$_POST["stu_pwd"];
$result=mysql_query("select * from student where stu_id='$stu_id' and stu_pwd='$stu_pwd'");
$rows=mysql_num_rows($result);
echo"<center><h1><font color=#0099FF>線上測驗系統(S)</font></h1></center>";
if($rows==1)
{
	setcookie("stu_id", $stu_id, time()+24*60*60);
	setcookie("stu_pwd", $stu_pwd, time()+24*60*60);
	$stu_name=mysql_result($result,0,1);
	$stu_class=mysql_result($result,0,0);
	echo"<table align=center border=0 cellpadding=10 cellspacing=0>";
	echo"<tr><td align=right colspan=3><font size=-1><a href=modify.php?stu_id=$stu_id>修改資料</a>　<a href=stu_login.php>登出</font></td></tr>";
	echo"<tr><td align=center colspan=3>Hi！$stu_class 班 <font size=+2 color=blue> $stu_name </font> 同學</td></tr>";
	echo"<form method=post action=score.php>";
	echo"<tr align=center><td><input type=submit name=submit value=歷史成績></td>";
	echo"<input type=hidden name=stu_id value=$stu_id>";
	echo"</form>";
	echo"<form method=post action=test.php>";
	echo"<td>題數：<select name=qus_num>";
		for($i=10;$i<=20;$i+=5)
		{
			echo"<option> $i </option>";
		}
	echo"</td><td><input type=submit name=submit value=開始測驗></td></tr>";
	echo"</form>";

}
else
{
	echo"<center>登入錯誤，請返回<a href=stu_login.php>重新登入</a></center>";
}
?>