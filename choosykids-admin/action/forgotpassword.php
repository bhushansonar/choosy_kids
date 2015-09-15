<?php
	$p = loadVariable("p","");
	$a = loadVariable("a","");
	$email = loadVariable("email","");
	
	$sql="select * from admin where Email='".$email."'";
	$rsEmail=$objDB->select($sql);
	
	echo count($rsEmail); 
	if(count($rsEmail)>0){
		$headers = "From:".EMAIL_FROM."\r\n".
			'X-Mailer: PHP/' . phpversion() . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/html; charset=utf-8\r\n" .
			"Content-Transfer-Encoding: 8bit\r\n";
	
	$message .='<html>
					<body>
					<table widht="100%" border="0">';
					
	$message .='<tr>
					<td>Thank you for using services.</td>
				</tr>
				
				<tr>
					<td>Your UserName and Password is below.</td>
				</tr>
				<tr hignt="5"><td></td></tr>
				<tr>
					<td>UserName : '.$rsEmail[0]['UserName'].'</td>
				</tr>
				<tr>
					<td>Password : '.decodestring($rsEmail[0]['Password']).'</td>
				</tr>';
	
	$message .=	'	</body>
				</html>';
		$Subject = "Recover Password";	
		$_SESSION['Success'] = "Username and Password Sent on your email address.";
		mail($email,$Subject,$message,$headers);
		header("Location:".$AbsoluteURLAdmin."index.php?p=login&#forgot");
		exit;
	}else{
		$_SESSION['WrongMsg']= "Email address is not correct.";
		header("location:".$AbsoluteURLAdmin."index.php?p=login&#forgot");
		exit;
	}
?>