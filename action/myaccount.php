<?php
error_reporting(0);
$p=loadvariable("p","");
$firstname=loadvariable("firstname","");
$lastname=loadvariable("lastname","");
$gender=loadvariable("gender","");
$password=loadvariable("password","");
$email=loadvariable("email","");
$mobile=loadvariable("mobile","");
$date=loadvariable("date","");
$month=loadvariable("month","");
$year=loadvariable("year","");
$file=loadvariable("file","");

$bdate=$year."-".$month."-".$date;
$filenameold=$_SESSION["image"];
$filename=$_FILES["file"]["name"];
if($filename=="")
{
	$name1=$filenameold;
	
}
else
{
$tempfile= $_FILES["file"]["tmp_name"];
$name1=rand().$filename;
$uploadpath="uploaded/".$name1;
move_uploaded_file($tempfile,$uploadpath);
unlink("uploaded/".$filenameold);
}
		
		$sql="update user set  firstname='".$firstname."',lastname='".$lastname."', gender='".$gender."',bdate='".$bdate."',mobile='".$mobile."',pics='$name1' where email= '".$_SESSION["email"]."'";
		$objDB->sql_query($sql);
		
		header("location:index.php?p=myaccount");
		

?>
