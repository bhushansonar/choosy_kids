<?php
/* * ********************************************************
  DoExpressCheckoutPayment.php

  This functionality is called to complete the payment with
  PayPal and display the result to the buyer.

  The code constructs and sends the DoExpressCheckoutPayment
  request string to the PayPal server.

  Called by GetExpressCheckoutDetails.php.

  Calls CallerService.php and APIError.php.

 * ******************************************************** */

require_once 'CallerService.php';

session_start();



ini_set('session.bug_compat_42', 0);
ini_set('session.bug_compat_warn', 0);

/* Gather the information to make the final call to
  finalize the PayPal payment.  The variable nvpstr
  holds the name value pairs
 */
$token = urlencode($_SESSION['token']);
$paymentAmount = urlencode($_SESSION['TotalAmount']);
$paymentType = urlencode($_SESSION['paymentType']);
$currCodeType = urlencode($_SESSION['currCodeType']);
$payerID = urlencode($_SESSION['payer_id']);
$serverName = urlencode($_SERVER['SERVER_NAME']);

$nvpstr = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTACTION=' . $paymentType . '&AMT=' . $paymentAmount . '&CURRENCYCODE=' . $currCodeType . '&IPADDRESS=' . $serverName;



/* Make the call to PayPal to finalize payment
  If an error occured, show the resulting errors
 */
$resArray = hash_call("DoExpressCheckoutPayment", $nvpstr);

/* Display the API response back to the browser.
  If the response from PayPal was a success, display the response parameters'
  If the response was an error, display the errors received using APIError.php.
 */
$ack = strtoupper($resArray["ACK"]);


if ($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING') {
    $_SESSION['reshash'] = $resArray;
    $location = "index.php?p=APIError";
    header("Location: $location");
}
?>
<html>
    <head>
        <title>PayPal PHP SDK - DoExpressCheckoutPayment API</title>
        <link href="sdk.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <br>
        <div class="content" style="margin: 0 auto;overflow: hidden;">
            <div class="h_line1"></div>
            <div class="heading">DoExpressCheckoutPage</div>
            <div class="h_line1"></div>

            <div class="gallery_box" >
                <div class="responce_box">
                    <b style="text-align: center; margin-left: 519px;">Order Processed! Thank you for your payment!</b></font>


                    <table width =400 style="">

                        <?php
                        require_once 'ShowAllResponse.php';
                        ?>
                    </table>
                </div>
            </div>
        </div>