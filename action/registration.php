<?php
error_reporting(0);
$p = loadvariable("p", "");
$username = loadvariable("username", "");
$firstname = loadvariable("firstname", "");
$lastname = loadvariable("lastname", "");
//$gender=loadvariable("gender","");
$gender = loadvariable("gender", "");
$email = loadvariable("email", "");
$password = loadvariable("password", "");
$country=loadvariable("country","");
$state=loadvariable("state","");
$city=loadvariable("city","");
$pincode=loadvariable("pincode","");
$address = loadvariable("address", "");
$Status = loadvariable("Status", "1");


$flag = 0;
// check for user name....
$sql = "select email from user ";
$rsemail = $objDB->select($sql);
//$result=mysql_query($sql);

for ($i = 0; $i < count($rsemail); $i++) {
    $email1 = $rsemail[$i]['email'];

    if ($email == $email1) {
        $flag = 1;
    }
}
if ($flag == 1) {
    $_SESSION["uname"] = "Unavailable UserName";
    header("location:index.php?p=registration");
    exit;
} else {
    $sql = "insert into user(username,firstname,lastname,gender,email,password,country,state,city,pincode,address,Status) values ('" . $username . "','" . $firstname . "','" . $lastname . "','" . $gender . "','" . $email . "','" . $password . "','" . $country . "','" . $state . "','" . $city . "','" . $pincode . "','" . $address . "','" . $Status . "')";
    $objDB->insert($sql);

    $sql1 = "select * from user where (email='" . $email . "'OR username='" . $username . "')";
    $rslogin = $objDB->select($sql1);
    $result1 = mysql_query($sql1);
     

    for ($i = 0; $i < count($rslogin); $i++) {

        $firstname = $rslogin[$i]['firstname'];
        $userid = $rslogin[$i]['UserId'];
        $_SESSION["username"] = $firstname;
        $_SESSION["userid"] = $userid;
    }


    $sql2 = "SELECT * FROM user WHERE (email='" . $email . "'OR username='" . $username . "') and password='$password'";
    //$rslogin1=$objDB->select($sql1);
    $result = mysql_query($sql2);
    $count = mysql_num_rows($result);
    echo $count;

    if ($count == 1) {
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
        echo $sql = "update user set LastLogin = '" . date('Y-m-d H:i:s') . "' where UserId = '" . $_SESSION["userid"] . "'";
        $update = $objDB->sql_query($sql);

        header("Location:" . $AbsoluteURL . "index.php");
    } else {

        header("Location:" . $AbsoluteURL . "index.php?p=" .$p);
    }
}
?>
