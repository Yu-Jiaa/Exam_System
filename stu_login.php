<?php
setcookie("stu_id","",time()-60*60);
setcookie("stu_pwd","",time()-60*60);
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
    form1.submit();
   }
</script>

<?php
echo"<center><h1><font color=#0099FF>�u�W����t��(S)</font></h1></center>";
echo"<table align=center border=0 cellpadding=10 cellspacing=0>";
echo"<tr><td><h2><font color=#993333>�ǥ͵n�J</font></h2></td>";
echo"<td align=right><font size=-1><a href=tea_login.php>�ڬO�Юv</a></font></td></tr>";
echo"<form name=form1 action=stu_main.php method=post>";
echo"<tr><td colspan=2>�b���G<input type=text name=stu_id>";
echo"<tr><td colspan=2>�K�X�G<input type=password name=stu_pwd>";
echo"<tr><td><font size=-1>�S�b���A�I�o�� <a href=register.php>���U</a></font></td>";
echo"<td align=right><input type=button value=�n�J onClick=checkform()>";
echo"</table>";
echo"</form>";
?>
