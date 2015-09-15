<?php
require_once('libs/mail/class.phpmailer.php');
$email = loadvariable("email", "");
$mail = new PHPMailer();
if ($user = $objDB->isUserExist($email)) {
    $display_name=$user[1];
    $code = generatePassword(5, 0, 1);
    $md5_code = md5($code);
    $sql = "update mn_user set mn_user_password='{$md5_code}' where mn_user_id={$user[0]}";
    $results = $objDB->edit($sql);
    if ($results) {
        $body = "Hi {$display_name},<br> 
            Your new password is {$code}. Please login with new password.";

        $subject = 'Missednote Reset Password';
        if (smtpmailer($email, 'bhushan@karmasource.net', 'Missed Notes', $subject, $body)) {
            header("Location:index.php?p=home&msg=reset-password");
            exit;
        } else {
            echo 'Error while sending mail. Contact Administrator.';
        }
    } else {
        echo 'Error While Inserting your Record. Please contact Administrator.';
    }
}

function smtpmailer($to, $from, $from_name, $subject, $body) {
    global $error;
    $username = "info@boom-tools.in"; //gautam@searchdrivenlabs.com
    $password = "admin123"; //gautam@searchdrivenlabs.com
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = 'rsb21.rhostbh.com';
    $mail->Port = 465;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->Priority = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = '8bit';
    $mail->ContentType = 'text/html; charset=utf-8\r\n';
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $mail->IsHTML(true);
    $mail->WordWrap = 900;
    $mail->SMTPKeepAlive = true;
    if (!$mail->Send()) {
        $error = 'Mail error: ' . $mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        $mail->SmtpClose();
        return true;
    }
}
?>