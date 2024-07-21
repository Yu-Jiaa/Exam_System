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
	echo"</form>";

	$submit=$_POST["submit"];
	if($submit=="測驗評分")
	{	
		$num=$_POST["qus_num"];
		if(!empty($ans))
		{
			$ans=$_POST["ans"];
			$std=$_POST["std"];
			$qid=$_POST["qid"];
			echo"<form method=post action=test.php>";
			echo"<td><input type=submit name=submit value=重新測驗></td>";
			echo"<input type=hidden name=qus_num value=$num>";
			echo"</form>";
			echo"<form method=post action=score.php>";
			echo"<td><input type=submit name=submit value=歷史成績></td></tr>";
			echo"<input type=hidden name=stu_id value=$stu_id>";
			echo"</form>";
			echo"<tr align=center><td colspan=3><input type=radio checked><font size=-1>為你的答案，</font><font size=-1 color=red>紅字</font><font size=-1>為正確答案</font></td></tr>";
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
							$j++;//選擇，為答案
							echo"<td><input type=radio name=ans[$i] value=$j checked><font color=red>$rowdata[$j]</font>";
							$j--;}
						else{
							$j++;//未選，為答案
							echo"<td><input type=radio name=ans[$i] value=$j><font color=red>$rowdata[$j]</font>";
							$j--;}
					}
					else
					{
						if($j==$ans[$i]){
							$j++;//選擇，非答案
							echo"<td><input type=radio name=ans[$i] value=$j checked>$rowdata[$j]";
							$j--;}
						else{
							$j++;//未選，非答案
							echo"<td><input type=radio name=ans[$i] value=$j>$rowdata[$j]";
							$j--;}
					}
				}
				echo"</td></tr>";
			}
			echo"</table>";	
			$score=round((100/$num)*$right);
			echo"<center><p>答對 $right 題！";
			if($score<60)
				echo"<font size=+2 color=red> $score </font>分</p></center>";
			else
				echo"<font size=+2 color=blue> $score </font>分</p></center>";
			$examtime=date("Y/m/d  H:i:s",time()+8*60*60);
			$sql="insert into score(stu_id,scores,examtime) values('$stu_id','$score','$examtime')";
			mysql_query($sql);
		}
		else
		{
			echo"</tr><tr align=center height=50><td><font size=+1 color=red>您尚未作答！</td></tr>";
			echo"<form method=post action=test.php>";
			echo"<tr align=center height=50><td><input type=submit name=submit value=返回測驗></td></tr>";
			echo"<input type=hidden name=qus_num value=$num>";
			echo"</form>";
		}
	}
	else
	{
		echo"<form method=post action=score.php>";
		echo"<td><input type=submit name=submit value=歷史成績></td></tr>";
		echo"<input type=hidden name=stu_id value=$stu_id>";
		echo"</form>";
		$num=$_POST["qus_num"];	//選擇的題數
		$result=mysql_query("select * from question");
		$rows=mysql_num_rows($result);//題庫數
		for($i=0;$i<=$rows;$i++)
			$a[$i]=0;
		//以亂數自question資料表格中產生題目
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
		//顯示5道題組
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
		echo"<p><tr><td align=center colspan=6 height=50><input type=submit name=submit value=測驗評分></td></tr></p>";
		echo"</form></table>";
	}
}
else
{
	echo"<center>您尚未登入，請<a href=stu_login.php>登入</a>，謝謝！</center>";
}
?>