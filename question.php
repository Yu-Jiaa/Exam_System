<?php
mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
$tea_id=$_COOKIE["tea_id"];
$tea_pwd=$_COOKIE["tea_pwd"];
echo"<center><h1><font color=#0099FF>線上測驗系統(T)</font></h1></center>";
$result=mysql_query("select * from teacher where tea_id='$tea_id' and tea_pwd='$tea_pwd'");
$rows=mysql_num_rows($result);
if($rows==1)
{	
	echo"<form method=post action=tea_main.php>";
	echo"<center><input type=submit name=submit value=回主畫面></center>";
	echo"<input type=hidden name=tea_id value=$tea_id>";
	echo"<input type=hidden name=tea_pwd value=$tea_pwd>";
	echo"</form>";
	$submit=$_POST["submit"];
	$submit2=$_POST["submit2"];
	if($submit=="" || $submit2=="取消")
	{	
		$sql=mysql_query("select * from question");
		$qus_num=mysql_num_rows($sql);
		echo"<table align=center border=0 cellpadding=7 cellspacing=0 width=550>";
		for($i=1;$i<=$qus_num;$i++)
		{
			$sql=mysql_query("select * from question where qid=$i");
			$rowdata=mysql_fetch_array($sql);
			if($i%2==1)
			{
				echo"<tr><td colspan=4><font color=#990000>$i.</font><font color=#000099> $rowdata[qus] </font></td>";
				echo"<form method=post action=question.php>";
				echo"<td rowspan=2 align=center><input type=submit name=submit value=修改><br>";
				echo"<input type=submit name=submit value=刪除></td></tr>";
				echo"<input type=hidden name=qid value=$rowdata[qid]>";
				echo"</form>";
				echo"<tr>";
				for($j=1;$j<=4;$j++)
				{
					if($j==$rowdata[ans])
					{
						$j++;
						echo"<td><input type=radio checked> $rowdata[$j]";
						$j--;
					}
					else
					{
						$j++;
						echo"<td><input type=radio> $rowdata[$j]";
						$j--;
					}
				}
				echo"</td></tr>";
			}
			else
			{
				echo"<tr bgcolor=#FFCCCC><td colspan=4><font color=#990000>$i.</font><font color=#000099> $rowdata[qus] </font></td>";
				echo"<form method=post action=question.php>";
				echo"<td rowspan=2 align=center><input type=submit name=submit value=修改><br>";
				echo"<input type=submit name=submit value=刪除></td></tr>";
				echo"<input type=hidden name=qid value=$rowdata[qid]>";	
				echo"</form>";
				echo"<tr bgcolor=#FFCCCC>";
				for($j=1;$j<=4;$j++)
				{
					if($j==$rowdata[ans])
					{
						$j++;
						echo"<td><input type=radio checked> $rowdata[$j]";
						$j--;
					}
					else
					{
						$j++;
						echo"<td><input type=radio> $rowdata[$j]";
						$j--;
					}
				}
				echo"</td></tr>";
			}
		}
		echo"</table>";
		echo"<form method=post action=question.php>";
		echo"<p><center><input type=submit name=submit value=新增題目><center></p>";
		echo"</form>";
	}
	else
	{
		if($submit=="修改" || $submit=="返回修改")
		{
			$qid=$_POST["qid"];
			$result=mysql_query("select * from question where qid=$qid");
			$rowdata=mysql_fetch_array($result);
			echo"<table align=center border=0 cellpadding=5 cellspacing=0 width=300>";
			echo"<form method=post action=question.php>";
			echo"<tr><td colspan=8><h2><font color=#993333>修改</font></h2></td></tr>";
			echo"<tr><td colspan=8>Q: <input type=text value=$rowdata[qus] name=qus size=45></td>";
			echo"<tr>";
			for($j=1;$j<=4;$j++)
			{
				if($j==$rowdata[ans])
				{
					$i=$j;
					$j++;
					echo"<td><input type=radio name=ans_radio value=$i checked></td><td><input type=text name=op[$i] value=$rowdata[$j] size=3></td>";
					$j--;
				}
				else
				{
					$i=$j;
					$j++;
					echo"<td><input type=radio name=ans_radio value=$i></td><td><input type=text name=op[$i] value=$rowdata[$j] size=3></td>";
					$j--;
				}
			}
			echo"</td></tr>";
			echo"<tr><td colspan=4 align=center><input type=submit name=submit2 value=取消></td>";
			echo"<td colspan=4 align=center><input type=submit name=submit value=確認修改></td></tr></table>";
			echo"<input type=hidden name=qid value=$qid>";
			echo"</form>";
		}
		if($submit=="刪除")
		{
			$qid=$_POST["qid"];
			echo $qid;
			mysql_query("delete from question where qid=$qid");
			$sqq=mysql_query("select MAX(qid) from question");
			$max=mysql_fetch_array($sqq);
			for($i=$qid+1;$i<=$max[0];$i++)
			{
				mysql_query("update question set qid=$i-1 where qid=$i");
			}
			header("Location:question.php");
		}

		if($submit=="新增題目" || $submit=="返回新增")
		{
			echo"<table align=center border=0 cellpadding=5 cellspacing=0 width=300>";
			echo"<form method=post action=question.php>";
			echo"<tr><td colspan=8><h2><font color=#993333>新增</font></h2></td></tr>";
			echo"<tr><td colspan=8>Q: <input type=text name=qus size=45></td>";
			echo"<tr>";
			for($j=1;$j<=4;$j++)
			{
				echo"<td><input type=radio name=ans_radio value=$j></td><td><input type=text name=op[$j] size=3></td>";
			}
			echo"<tr><td colspan=4 align=center><input type=submit name=submit2 value=取消></td>";
			echo"<td colspan=4 align=center><input type=submit name=submit value=確認新增></td></tr></table>";
			echo"</form>";
		}
		if($submit=="確認修改")
		{
			$qid=$_POST["qid"];
			$qus=$_POST["qus"];
			$ans=$_POST["ans_radio"];
			$op=$_POST["op"];
			//echo"qid $qid, qus $qus, ans $ans, op $op[1] $op[2] $op[3] $op[4]";
			if($qus=="" || $ans=="" || $op[1]=="" || $op[2]=="" || $op[3]=="" || $op[4]=="")
			{
				echo"<center><p><font size=+1 color=red>不能有空白哦！</p>";
				echo"<form method=post action=question.php>";
				echo"<p><tr align=center height=50><td><input type=submit name=submit value=返回修改></p></center>";
				echo"<input type=hidden name=qid value=$qid>";
				echo"</form>";
			}
			else
			{
				mysql_query("update question set qus='$qus', op1='$op[1]', op2='$op[2]', op3='$op[3]', op4='$op[4]', ans='$ans' where qid=$qid");
				header("Location:question.php");
			}
		}
		if($submit=="確認新增")
		{
			$qus=$_POST["qus"];
			$ans=$_POST["ans_radio"];
			$op=$_POST["op"];
			$result=mysql_query("select * from question");
			$qid=mysql_num_rows($result)+1;
			//echo"qid $qid, qus $qus, ans $ans, op $op[1] $op[2] $op[3] $op[4]";
			if($qus=="" || $ans=="" || $op[1]=="" || $op[2]=="" || $op[3]=="" || $op[4]=="")
			{
				echo"<center><p><font size=+1 color=red>不能有空白哦！</p>";
				echo"<form method=post action=question.php>";
				echo"<p><tr align=center height=50><td><input type=submit name=submit value=返回新增></p></center>";
				echo"</form>";
			}
			else
			{
				mysql_query("insert into question values($qid, '$qus', '$op[1]', '$op[2]', '$op[3]', '$op[4]', '$ans')");
				header("Location:question.php");
			}
		}
	}
}
else
{
	echo"<center>您尚未登入，請<a href=tea_login.php>登入</a>，謝謝！</center>";
}
?>