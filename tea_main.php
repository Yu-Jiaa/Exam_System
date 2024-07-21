<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
$tea_id=$_POST["tea_id"];
$tea_pwd=$_POST["tea_pwd"];
$result=mysql_query("select * from teacher where tea_id='$tea_id' and tea_pwd='$tea_pwd'");
$rows=mysql_num_rows($result);
echo"<center><h1><font color=#0099FF>線上測驗系統(T)</font></h1></center>";
if($rows==1)
{
	setcookie("tea_id", $tea_id, time()+24*60*60);
	setcookie("tea_pwd", $tea_pwd, time()+24*60*60);
	$tea_name=mysql_result($result,0,1);
	$tea_class=mysql_result($result,0,0);
	echo"<table align=center border=0 cellpadding=10 cellspacing=0>";
	echo"<tr><td align=right colspan=3><font size=-1><a href=tea_login.php>登出</font></td></tr>";
	echo"<tr><td align=center colspan=3>Hi！$tea_class 班 <font size=+2 color=blue> $tea_name </font> 老師</td></tr>";
	echo"<form method=post action=tea_score.php>";
	echo"<tr align=center><td><input type=submit name=submit value=學生成績></td>";
	echo"</form>";
	echo"<form method=post action=question.php>";
	echo"</td><td><input type=submit value=查看題庫></td></tr>";
	echo"</form>";

}
else
{
	echo"<center>登入錯誤，請返回<a href=tea_login.php>重新登入</a></center>";
}
?>