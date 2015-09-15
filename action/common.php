<?php

$a = loadVariable("a", '');
$p = loadVariable("p", "");
$email = loadVariable("email", "");
switch ($a) {
    case 'check':
        $query = "SELECT * FROM `user` WHERE `email` = '{$email}'";
        $result = mysql_query($query);
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $valid = "false";
        } else {
            $valid = "true";
        }
        echo $valid;
        break;
}
?>
