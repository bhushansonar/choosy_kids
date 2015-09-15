
<html>




    <table class="api" width=400 style="color:#000000;margin: 0 auto;">

        <?php /* ?><?php 

          foreach($resArray as $key => $value) {



          echo "<tr><td> $key:</td><td>$value</td>";

          }

          ?><?php */ ?>

        <tr><td>TRANSACTIONID</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['TRANSACTIONID']; ?>" /></div></td></tr>

        <tr><td>TRANSACTIONTYPE</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['TRANSACTIONTYPE']; ?>" /></div></td></tr> 

        <tr><td>PAYMENTTYPE</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['PAYMENTTYPE']; ?>" /></div></td></tr> 

        <tr><td>ORDERTIME</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['ORDERTIME']; ?>" /></div></td> </tr>

        <tr><td>AMT</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['AMT']; ?>" /></div></td></tr> 

        <tr><td>CURRENCYCODE</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['CURRENCYCODE']; ?>" /></div></td> </tr>

        <tr><td>PAYMENTSTATUS</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['PAYMENTSTATUS']; ?>" /></div></td> </tr>

        <tr><td>ACK</td><td><div class="login_text_box1"><input type="text"  name="email" value="<?php echo $resArray['ACK']; ?>" /></div></td> </tr>

    </table>


    <div style="margin: 0px auto; width: 218px; height: 200px;">
    <img src="images/thank_you.gif"/><h1 style="color: #672A8B;font-size: 26px;">For Using Our Services.</h1>
    </div>
</html>
<a href="index.php" style="color: #672A8B;font-size: 20px;">Home Page</a>
<?php
$total = $resArray['AMT'] * 51;

if (isset($_SESSION["userid"]) != "") {

    $uid = $_SESSION["userid"];
}

if (isset($_SESSION["email"]) != "") {

    $email = $_SESSION["email"];
}

$sql = "select * from user Where email='" . $email . "' and UserId='" . $uid . "'";

$user = $objDB->select($sql);

for ($u = 0; $u < count($user); $u++) {

    $firstname = $user[$u]['firstname'];

    $lastname = $user[$u]['lastname'];

    $address = $user[$u]['Ship_Address'];

    $city = $user[$u]['Ship_City'];

    $state = $user[$u]['Ship_State'];

    $country = $user[$u]['Ship_Country'];

    $zip = $user[$u]['Ship_Zip'];

    $sql1 = "select * from shoppingcart where UserId='" . $uid . "'";

    $cart = $objDB->select($sql1);

    for ($c = 0; $c < count($cart); $c++) {

        $pid = $cart[$c]['ProductId'];

        $qyt = $cart[$c]['Quantity'];

        $sql2 = "select * from product where ProductId='" . $pid . "'";

        $pro = $objDB->select($sql2);

        for ($p = 0; $p < count($pro); $p++) {

            if ($pro[$p]['offer'] != 0) {
                $dp = $pro[$p]['ProductPrice'] * $pro[$p]['offer'] / 100;
                $price = (round($pro[$p]['ProductPrice'] - $dp));
            } else {
                $price = $pro[$p]['ProductPrice'];
            }







            $sql = "insert into payment(TransactionId,TransactionType,PaymentType,CurrencyCode,PaymentStatus,OrderTime,ACK,Email,UserId,FirstName,LastName,ProductId,Product_Qty,ProductPrice,ShipToAddress,ShipToCity,ShipToState,ShipToCountry,ShipToZip,TotalAmount) values ('" . $resArray['TRANSACTIONID'] . "','" . $resArray['TRANSACTIONTYPE'] . "','" . $resArray['PAYMENTTYPE'] . "','" . $resArray['CURRENCYCODE'] . "','" . $resArray['PAYMENTSTATUS'] . "','" . $resArray['ORDERTIME'] . "','" . $resArray['ACK'] . "','" . $email . "','" . $uid . "','" . $firstname . "','" . $lastname . "','" . $pid . "','" . $qyt . "','" . $price . "','" . $address . "','" . $city . "','" . $state . "','" . $country . "','" . $zip . "','" . $total . "') ";



            $inserttextproperty = $objDB->insert($sql);



            //$SQL="insert into order(TransactionId,UserId,OrderTime,Confirm,	Totalamount,Status) values ('".$resArray['TRANSACTIONID']."','".$uid."','".$resArray['ORDERTIME']."','".$resArray['PAYMENTSTATUS']."','".$total."','".$resArray['PAYMENTSTATUS']."')";
            //$inserttextproperty = $objDB->insert($SQL);









            $sql3 = "select * from product_qty where ProductId='" . $pid . "' ";

            $qty = $objDB->select($sql3);

            for ($q = 0; $q < count($qty); $q++) {



                $Pro_qty = $qty[$q]['Quantity'] - $qyt;

                $sql4 = "update product_qty set  Quantity='" . $Pro_qty . "' where ProductId='" . $pid . "'";

                $updatetextproperty = $objDB->sql_query($sql4);

                $sql5 = "delete from shoppingcart where UserId='" . $uid . "' and ProductId='" . $pid . "'";

                $rspropertydel = $objDB->sql_query($sql5);
            }
        }

        $SQL = "INSERT INTO order_detail SET TransactionId='" . $resArray['TRANSACTIONID'] . "',UserId='" . $uid . "',OrderTime='" . $resArray['ORDERTIME'] . "',Confirm='" . $resArray['PAYMENTSTATUS'] . "',Totalamount='" . $total . "',Status='" . $resArray['PAYMENTSTATUS'] . "'";



        $inserttextproperty = $objDB->insert($SQL);
    }
}
?>



