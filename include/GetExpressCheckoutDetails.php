<style>
    table
    {
        border-collapse:collapse;
    }
    table, td, th
    {
        border:1px solid black;
    }
</style>    
<?php
/* * ******************************************************
  GetExpressCheckoutDetails.php

  This functionality is called after the buyer returns from
  PayPal and has authorized the payment.

  Displays the payer details returned by the
  GetExpressCheckoutDetails response and calls
  DoExpressCheckoutPayment.php to complete the payment
  authorization.

  Called by ReviewOrder.php.

  Calls DoExpressCheckoutPayment.php and APIError.php.

 * ****************************************************** */

session_start();

/* Collect the necessary information to complete the
  authorization for the PayPal payment
 */

$_SESSION['token'] = $_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount'] = $_REQUEST['paymentAmount'];
$_SESSION['currCodeType'] = $_REQUEST['currencyCodeType'];
$_SESSION['paymentType'] = $_REQUEST['paymentType'];

$resArray = $_SESSION['reshash'];
$_SESSION['TotalAmount'] = $resArray['AMT'] + $resArray['SHIPDISCAMT'];

/* Display the  API response back to the browser .
  If the response from PayPal was a success, display the response parameters
 */
?>




<form action="index.php?p=DoExpressCheckoutPayment" method="POST">
    <div class="contain" style="margin:0 auto; overflow: hidden">
        <div class="h_line1"></div>
        <div class="heading">Step 3: DoExpressCheckoutPayment</div>
        <div class="h_line1"></div>
        <div class="gallery_box">
            <div class="login_box">
                <table width =270 style="color:#000000; float: left; margin-bottom: 10px;">
                    <tr>
                        <td><b>Order Total:</b></td>
                        <td>
                            <?php echo $_REQUEST['currencyCodeType'];
                            echo $resArray['AMT'] + $resArray['SHIPDISCAMT']
                            ?></td>
                    </tr>
                    <?php
                    if (isset($_SESSION["userid"]) != "") {
                        $uid = $_SESSION["userid"];
                    }
                    if (isset($_SESSION["email"]) != "") {
                        $email = $_SESSION["email"];
                    }
                    ?>
                    <tr>
                        <td>TOKEN</td><td><?php echo $resArray['TOKEN']; ?></td></tr>
                    <tr><td>CHECKOUTSTATUS</td><td><?php echo $resArray['CHECKOUTSTATUS']; ?></td></tr> 
                    <tr><td>TIMESTAMP</td><td><?php echo $resArray['TIMESTAMP']; ?></td></tr> 
                    <tr><td>ACK</td><td><?php echo $resArray['ACK']; ?></td> </tr>
                    <tr><td>PAYERID</td><td><?php echo $resArray['PAYERID']; ?></td></tr> 
                    <tr><td>PAYERSTATUS</td><td><?php echo $resArray['PAYERSTATUS']; ?></td> </tr>
                    <?php
                    $sql = "select * from user Where email='" . $email . "' and UserId='" . $uid . "'";
                    $user = $objDB->select($sql);
                    for ($u = 0; $u < count($user); $u++) {
                        ?>
                        <tr><td>E-Mail</td><td><?php echo $user[$u]['email']; ?></td></tr>
                        <tr><td>FIRSTNAME</td><td><?php echo $user[$u]['firstname']; ?></td> </tr>
                        <tr><td>LASTNAME</td><td><?php echo $user[$u]['lastname']; ?></td> </tr>
                        <tr><td>SHIPTOSTREET</td><td><?php echo $user[$u]['Ship_Address']; ?></td> </tr>
                        <tr><td>SHIPTOCITY</td><td><?php echo $user[$u]['Ship_City']; ?></td> </tr>
                        <tr><td>SHIPTOSTATE</td><td><?php echo $user[$u]['Ship_State']; ?></td> </tr>
                        <tr><td>SHIPTOCOUNTRYCODE</td><td><?php echo $user[$u]['Ship_Country']; ?></td></tr>
                        <tr><td>SHIPTOZIP</td><td><?php echo $user[$u]['Ship_Zip']; ?></td> </tr>
<?php } ?>
                    <tr><td>COUNTRYCODE</td><td><?php echo $resArray['COUNTRYCODE']; ?></td></tr> 
                    <tr><td>CURRENCYCODE</td><td><?php echo $resArray['CURRENCYCODE']; ?></td> </tr>
                </table>
                <table style="float: right; margin-right: 218px;">
                    <tr>
                        <th>Product_NAME</th>
                        <th>Product_Quantity</th>
                        <th>Product_Amount</th>
                    </tr>
                    <?php
                    $sql1 = "select * from shoppingcart where UserId='" . $uid . "'";
                    $cart = $objDB->select($sql1);
                    for ($c = 0; $c < count($cart); $c++) {
                        $pid = $cart[$c]['ProductId'];
                        $sql2 = "select * from product where ProductId='" . $pid . "'";
                        $rspro = $objDB->select($sql2);
                        for ($p = 0; $p < count($rspro); $p++) {
                            ?>
                            <tr>
                                <td><?php echo $rspro[$p]['ProductName']; ?></td> 
                                <td><?php echo $cart[$c]['Quantity']; ?></td>
                                <td><?php
                                    if ($rspro[$p]['offer'] != 0) {
                                        $dp = $rspro[$p]['ProductPrice'] * $rspro[$p]['offer'] / 100;
                                        $dp = $rspro[$p]['ProductPrice'] - $dp;
                                        echo round($dp);
                                    } else {
                                        echo(round($rspro[$p]['ProductPrice']));
                                    }
                                    ?></td>
                            </tr>
    <?php }
}
?>
                </table>      
                </font>
                
            </div></div>
    </div>
    <center><input style="margin-bottom: 15px;" type="image" name="submit" src="images/submit.1.png" /></center>