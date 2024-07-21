<?php
setcookie("stu_id","",time()-60*60);
setcookie("stu_pwd","",time()-60*60);
?>
<Script language="javascript">
	function checkform(){
     if(document.form1.stu_id.value==""){
	   alert("帳號欄位不可以空白喔!");
	   return false;
	 } 
     if(document.form1.stu_pwd.value==""){
	   alert("密碼欄位不可以空白喔!");
	   return false;
	 } 
    form1.submit();
   }
</script>

<?php
echo"<center><h1><font color=#0099FF>線上測驗系統(S)</font></h1></center>";
echo"<table align=center border=0 cellpadding=10 cellspacing=0>";
echo"<tr><td><h2><font color=#993333>學生登入</font></h2></td>";
echo"<td align=right><font size=-1><a href=tea_login.php>我是教師</a></font></td></tr>";
echo"<form name=form1 action=stu_main.php method=post>";
echo"<tr><td colspan=2>帳號：<input type=text name=stu_id>";
echo"<tr><td colspan=2>密碼：<input type=password name=stu_pwd>";
echo"<tr><td><font size=-1>沒帳號，點這裡 <a href=register.php>註冊</a></font></td>";
echo"<td align=right><input type=button value=登入 onClick=checkform()>";
echo"</table>";
echo"</form>";
?>
