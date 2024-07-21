<?php
echo"<center><h1><font color=#0099FF>線上測驗系統(S)</font></h1>";

mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
?>
<Script language="javascript">
	function checkform(){
     if(document.form1.stu_pwd.value==""){
	   alert("密碼欄位不可以空白喔!");
	   return false;
	 } 
     if(document.form1.stu_name.value==""){
	   alert("姓名欄位不可以空白喔!");
	   return false;
	 }
	 if(document.form1.stu_pwd.value != document.form1.stu_pwd2.value){
	   alert("密碼輸入錯誤!");
	   return false;
	 }
    form1.submit();
   }
</script>

<?php	
$submit=$_POST["submit"];
if($submit<>"")
{
	$stu_id=$_POST["stu_id"];
	$stu_pwd=$_POST["stu_pwd"];
	$stu_pwd2=$_POST["stu_pwd2"];
	$stu_name=$_POST["stu_name"];
	$stu_class=$_POST["stu_class"];
	//echo"$stu_id , $stu_name , $stu_pwd , $stu_class";
	if($submit=="修改")
	{
		if($stu_name=="" || $stu_pwd=="" || $stu_pwd2=="")
			die(header("Location:modify.php?stu_id=$stu_id"));
		if($stu_pwd<>$stu_pwd2)
			die(header("Location:modify.php?stu_id=$stu_id"));			
		mysql_query("update student set stu_class='$stu_class', stu_name='$stu_name', stu_pwd='$stu_pwd', stu_pwd2='$stu_pwd2' where stu_id='$stu_id'");
		echo"<p><center>修改成功！</center></p>";
		echo"<form method=post action=stu_main.php>";
		echo"<p><center><input type=submit name=submit value=回主畫面></center></p>";
		echo"<input type=hidden name=stu_id value=$stu_id>";
		echo"<input type=hidden name=stu_pwd value=$stu_pwd>";
		echo"</form>";

	}
}
else
{
	echo"<form method=post action=stu_main.php>";
	echo"<center><input type=submit name=submit value=回主畫面>";
	echo"<input type=hidden name=stu_id value=$stu_id>";
	echo"<input type=hidden name=stu_pwd value=$stu_pwd>";
	echo"</form>";
	$stu_id=$_GET["stu_id"];
	$result=mysql_query("select * from student where stu_id='$stu_id'");
	$rowdata=mysql_fetch_array($result);
	echo"<table align=center border=0 cellpadding=5 cellspacing=0>";
	echo"<tr><td><h2><font color=#993333>修改</font></h2></td>";
	echo"<td align=left><font size=-1>標記<font color=red>*</font>為必填！</font></td></tr>";
	echo"<form name=form1 method=post action=modify.php>";
	echo"<tr><td><font color=white>*</font>帳號：$rowdata[stu_id]</td>";
	echo"<input type=hidden name=stu_id value=$rowdata[stu_id]>";
	echo"<td></td></tr>";
	echo"<tr><td><font color=red>*</font>密碼：<input type=password name=stu_pwd size=12 minlength=8 maxlength=12>";
	echo"<td><font size=-2>輸入8 ~ 12個字</font></td></tr>";
	echo"<tr><td><font color=red>*</font>密碼：<input type=password name=stu_pwd2 size=12 minlength=8 maxlength=12>";
	echo"<td><font size=-2>再輸入密碼</font></td></tr>";
	echo"<tr><td><font color=red>*</font>姓名：<input type=text value=$rowdata[stu_name] name=stu_name size=12 maxlength=3></td></tr>";
	echo"<tr><td><font color=red>*</font>班級：";
	echo"<select name=stu_class>";
		for($i=101;$i<103;$i++)
		{
			if($rowdata[stu_class]==$i)
				echo"<option selected> $i </option>";
			else
				echo"<option> $i </option>";
		}
	echo"</td></tr>";
	echo"<tr><td></td>";
	echo"<td align=center><input type=submit name=submit value=修改 onClick=checkform()></td></tr>";
	echo"</form>";
	echo"</table>";
}
?>