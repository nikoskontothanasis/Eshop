<?php 

function send_email($to,$body){
	require_once('phpmailer/class.phpmailer.php');
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->SMTPAuth=true;
	$mail->Username="nikos kontothanasis";
	$mail->Password="macuser1994";
	$mail->From="nikos.kontothanasis@gmail.com";
	$mail->FromName="user";
	$mail->AddAddress($to);
	$mail->WordWrap=70;
	$mail->IsHTML(true);
	$mail->Subject="Registration";
	$mail->Body=$body;
	if($mail->Send()){
		return true;
	}else{
		return false;
	}
}
include("mysql.php");
$name=$_POST["name"];
$lastname=$_POST["lastname"];
$username=$_POST["username"];
$email=$_POST["email"];
$pass1=$_POST["pass1"];
$pass2=$_POST["pass2"];
if($pass1!=$pass2)
	die("Passwords are not the same!");
$link=mysql_connect($host,$user,$pass);
mysql_select_db($db);
$sql="select * from users where username='$username'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0){
	echo "$username Already Exist!<br>";
}else{
	srand((int)((double)microtime()*1000003));
	$srandnumber=2+rand();
	$sql="insert into users(name,lastname,username,email,password,valid) values('$name','$lastname','$username','$email','$pass1','$randnumber')";
	mysql_query($sql);
	$sql="select * from users where username='$username'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	$code=$row["code"];
	$server_name=$_SERVER['SERVER_NAME'];
	$uri="/eshop/active.php";
	$mailbody="<h2> Welcome</h2><br><p>To activate the registration please click <a href=http://$server_name$uri?code&update=$randnumber><i>here</i></h2><br>Thank you!";
	$t=send_email($email,$mailbody);
	if(!$t){
		echo "Fail to sent email<br>";
	}else{
		echo "Check your inbox! ;) <br>";
	}
}
mysql_close($link);
?>