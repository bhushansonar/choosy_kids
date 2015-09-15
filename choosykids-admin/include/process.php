<?php
$pg=loadVariable("pg","");
$bLoggedIn=loadVariable("bLoggedIn","");
if($bLoggedIn==1) {
$pg="home";
$_SESSION["session_adminID"] = $rsUser[0]['AdminID'];
header("location:index.php?pg='".$pg."'");
}
else
{
switch ($p) {
	case 'login':
		$heading="Login";
		switch ($a) {
			case "login":
				if (loadVariable("UserName","")!=""&&loadVariable("Password","")!="") {
					// Get user details
					$SQL = "Select * from admin where UserName = '".loadVariable("UserName","")."' and Password = '".encodestring(loadVariable("Password",""))."'";
					$rsUser = $objDB->select($SQL);
					if(count($rsUser)<=0){
						$error.="Your username or password is invalid, please try again.<br>";
					}elseif($rsUser[0]["Status"]!=1){
						$error.="Your account is Inactive.<br>";
					}else if($rsUser[0]['Status']=='1'){
						$_SESSION["session_adminID"] = $rsUser[0]['AdminID'];
						$sql = "update admin set LastLogin = '".date('Y-m-d H:i:s')."' where AdminID = '".$_SESSION["session_adminID"]."'";
						$update = $objDB->sql_query($sql);
						header("Location: index.php?p=home");
					}else{
						$error.="Somthing Wrong.<br>";
					}			
				}
				break;
			case "logout":
				unset($_SESSION["session_adminID"]);
				$_SESSION['logout'] = 'Successfully Logout';
				header("Location:".$AbsoluteURLAdmin);
				exit;
			}
		break;
	case "user":
		$heading="Manage Users";
		break;
		
	case "siteStructure";
		$heading="Site Structure";
		break;
		
	case "pageDetails";
		$heading="Page Details";
		break;
}
}
?>