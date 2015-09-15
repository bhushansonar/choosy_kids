<?php
echo $p = loadVariable("p","");
echo $a = loadVariable("a","");
echo $email=loadVariable("email","");
echo $password=loadVariable("password","");
$username=loadVariable("username","");
$firstname=loadVariable("firstname","");
$lastname=loadVariable("lastname","");
$gender=loadVariable("gender","");
$date=loadVariable("date","");
$month=loadVariable("month","");
$year=loadVariable("year","");
$mobile=loadVariable("mobile","");
$address=loadVariable("address","");
$country=loadVariable("country","");
$state=loadVariable("state","");
$city=loadVariable("city","");
$pincode=loadVariable("pincode","");
$bdate=$year."-".$month."-".$date;
$flag=0;	

if($p == "checkout")
{
	if($a == "newuser")
	{
		// check for user name....
		$sql="select email from user";
		$rsemail=$objDB->select($sql);
		//$result=mysql_query($sql);
		for($i=0;$i<count($rsemail);$i++)
	
			{
				$email1=$rsemail[$i]['email'];
				if($email==$email1)
				{
					$flag=1;
				}
			}
		if($flag==1)
		{
			$_SESSION["uname"]="E-mail Id Already exits";
			header("location:index.php?p=checkout&a=newuser");
			exit;
		}
		else
		{
			$sql="insert into user(username,firstname,lastname,gender,email,password,address,country,state,city,pincode,Status) values ('".$username."','".$firstname."','".$lastname."','".$gender."','".$email."','".$password."','".$address."','".$country."','".$state."','".$city."','".$pincode."','1')";
			
			$objDB->insert($sql);
			
			$sql1="select * from user where email='".$email."'";
			$rslogin=$objDB->select($sql1);
			$result1=mysql_query($sql1);
			for($i=0;$i<count($rslogin);$i++)
				{
					$firstname=$rslogin[$i]['firstname'];
					$userid=$rslogin[$i]['UserId'];
					$_SESSION["username"]=$firstname;
					$_SESSION["userid"]=$userid;
					$sql = "update user set LastLogin = '".date('Y-m-d H:i:s')."' where UserId = '".$_SESSION["userid"]."'";
					$update = $objDB->sql_query($sql);
				}
			$sql3="select * from shoppingcart where UserId='".$_COOKIE['PHPSESSID']."'";
			$rscart=$objDB->select($sql3);
			$result2=mysql_query($sql3);
			for($c=0;$c<count($rscart);$c++)
				{
					
					$cartid=$rscart[$c]['CartId'];
					echo $userid;
					echo $sql3;
					echo $cartid;
				
			$sql2="update shoppingcart set UserId='".$_SESSION["userid"]."' where CartId='".$cartid."'";
			mysql_query($sql2);
		}
			$_SESSION["email"]=$email;
			
			header("location:index.php?p=SetExpressCheckout");
			
		}
	}
	
}

?>	
