
<?php
$email = $_POST['email']; // you must escape any input. Remember.

$query = "SELECT * FROM `user` WHERE `email` = '{$email}'";

$result = mysql_query($query);

if (mysql_num_rows($result) > 1) {

    /* Email already exists */

    echo 'That E Mail address already exists';
     
        exit;
     
    }
?>

//        $('#submit').click(function() {
//            var emailVal = $('#email').val(); // assuming this is a input text field
//
//            $.post('.php', {'email': emailVal}, function(data) {
//                if (data == 'exist') {
//                    alert("Email already exists. Please choose a different email");
//                    return false;
//                } else {
//                    $('#registration').submit();
//                }
//            });
//        });



