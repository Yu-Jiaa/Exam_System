<?php
echo"<center><h1><font color=#0099FF>�u�W����t��(S)</font></h1>";

mysql_connect("127.0.0.1","root","takming");
mysql_select_db("data");
mysql_query("set names big5");
?>
<Script language="javascript">
	function checkform(){
     if(document.form1.stu_id.value==""){
	   alert("�b����줣�i�H�ťճ�!");
	   return false;
	 } 
     if(document.form1.stu_pwd.value==""){
	   alert("�K�X��줣�i�H�ťճ�!");
	   return false;
	 } 
     if(document.form1.stu_name.value==""){
	   alert("�m�W��줣�i�H�ťճ�!");
	   return false;
	 }
	 if(document.form1.stu_pwd.value != document.form1.stu_pwd2.value){
	   alert("�K�X��J���~!");
	   return false;
	 }
    form1.submit();
   }
</script>

<?php
if($submit<>"")
{
	$submit=$_POST["submit"];
	$stu_id=$_POST["stu_id"];
	$stu_pwd=$_POST["stu_pwd"];
	$stu_pwd2=$_POST["stu_pwd2"];
	$stu_name=$_POST["stu_name"];
	$stu_class=$_POST["stu_class"];
	if($submit=="���U")
	{
		if($stu_id=="" || $stu_name=="" || $stu_pwd=="")
			die(header("Location:register.php"));
		
		$result=mysql_query("select * from student where stu_id='$stu_id'");
		if(mysql_num_rows($result)<>0)
			die("<p><center>���b���w���H�ϥΡI<a href=register.php>�^�W�@��</a></center></p>");
		if($stu_pwd<>$stu_pwd2)
			die(header("Location:register.php"));
		mysql_query("insert into student values('$stu_class','$stu_name','$stu_id','$stu_pwd','$stu_pwd2')");
		echo"<p><center>���U���\�I</center></p>";
		echo"<form method=post action=stu_main.php>";
		echo"<center><input type=submit name=submit value=�^�D�e��>";
		echo"<input type=hidden name=stu_id value=$stu_id>";
		echo"<input type=hidden name=stu_pwd value=$stu_pwd>";
		echo"</form>";
	}
}
else
{
	echo"<a href=stu_login.php><font size=-1>��^�n�J�e��</font></a></center>";
	echo"<table align=center border=0 cellpadding=5 cellspacing=0>";
	echo"<tr><td><h2><font color=#993333>���U</font></h2></td>";
	echo"<td align=left><font size=-1>�аO<font color=red>*</font>������I</font></td></tr>";
	echo"<form name=form1 method=post action=register.php>";
	echo"<tr><td><font color=red>*</font>�b���G<input type=text name=stu_id size=12 maxlength=12>";
	echo"<td valign=bottom></td></tr>";
	echo"<tr><td><font color=red>*</font>�K�X�G<input type=password name=stu_pwd size=12 minlength=8 maxlength=12>";
	echo"<td><font size=-2>��J8 ~ 12�Ӧr</font></td></tr>";
	echo"<tr><td><font color=red>*</font>�K�X�G<input type=password name=stu_pwd2 size=12 minlength=8 maxlength=12>";
	echo"<td><font size=-2>�A��J�K�X</font></td></tr>";
	echo"<tr><td><font color=red>*</font>�m�W�G<input type=text name=stu_name size=12 maxlength=3></td></tr>";
	echo"<tr><td><font color=red>*</font>�Z�šG";
	echo"<select name=stu_class>";
		for($i=101;$i<=102;$i++)
		{
			echo"<option> $i </option>";
		}
	echo"</td></tr>";
	echo"<tr><td><input type=reset value=����></td>";
	echo"<td align=center><input type=submit name=submit value=���U onClick=checkform()></td></tr>";
	echo"</form>";
	echo"</table>";
}
?>