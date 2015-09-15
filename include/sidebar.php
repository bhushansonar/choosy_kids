<div class="cart_leftbar">
    <div class="h_line1"></div><div class="heading" style="margin-left: 4px;">CART:&nbsp;
        <?php
        if (isset($_SESSION["userid"]) != "") {

            $uid = $_SESSION["userid"];
        } else {

            $uid = $_COOKIE['PHPSESSID'];
        }



        $sql1 = "select * from shoppingcart where UserId ='" . $uid . "'";



        $rsu = $objDB->select($sql1);



        if (empty($rsu)) {

            $Totalpro = "No";
        } else {

            $Totalpro = count($rsu) . "";
        }
        ?>
        <span id="tntpro"><?php echo $Totalpro; ?></span>&nbsp;Product
    </div><div class="h_line1"></div>
    <div class="" style="width: 180px; ">
        <div id="MyResult">     		  
    <?php
if (isset($_SESSION["userid"]) != "") {

    $uid = $_SESSION["userid"];
} else {

    $uid = $_COOKIE['PHPSESSID'];
}

$sql1 = "select * from shoppingcart where UserId ='" . $uid . "'";

$rsu = $objDB->select($sql1);



for ($i = 0; $i < count($rsu); $i++) {

    $pid = $rsu[$i]['ProductId'];

  $sql2 = "select * from product where ProductId ='" . $pid . "'";
  

    $rsd = $objDB->select($sql2);
    

    for ($d = 0; $d < count($rsd); $d++) {
        ?> 

                    <input type="hidden" id="price<?php echo $i; ?>" name="price" value="

                    <?php
                    if ($rsd[$d]['offer'] != 0) {

                        $dp = $rsd[$d]['ProductPrice'] * $rsd[$d]['offer'] / 100;



                        $dp = $rsd[$d]['ProductPrice'] - $dp;

                        echo(round($dp));
                    } else {

                        echo $rsd[$d]['ProductPrice'];
                    }
                    ?>" />

                    <input type="hidden" id="Qyt<?php echo $i; ?>" name="Qyt" value="<?php echo $rsu[$i]['Quantity']; ?>" />

                    <div id="cart<?php echo $i; ?>" class="prodct_listing" >
                        <div style=" width: 127px; float: left;">
                            <span style="color:#000000; font-size:12px;"><?php echo $rsd[$d]['ProductName']; ?></span>
                        </div>



                        <div style="width:15px; float:left;"><span style="color:#000000; font-size:12px;" ><?php echo $rsu[$i]['Quantity']; ?></span>

                        </div>

                        <div style="float:left; width:65px; text-align:center;">

                            <span style="color:#030303; font-size:12px;" id="total<?= $i ?>">			            <?php
                   if ($rsd[$d]['offer'] != 0) {

                       $dp = $rsd[$d]['ProductPrice'] * $rsd[$d]['offer'] / 100;



                       $dp = $rsd[$d]['ProductPrice'] - $dp;

                       //echo(round($dp));

                       $pricetotal = $rsu[$i]['Quantity'] * (round($dp));

                       echo $pricetotal;
                   } else {



                       $pricetotal = $rsu[$i]['Quantity'] * $rsd[$d]['ProductPrice'];

                       echo $pricetotal;
                   }
                    ?>

                            </span>

                        </div>

                        <a href="javascript:funRemove('<?php echo $rsu[$i]['ProductId']; ?>','<?php echo $i; ?>','<?php echo count($rsu); ?>','<?php echo $sz ?>')"><img src="images/minus1.png"  /></a>

                        <div style="clear:both"></div>



                    </div>



    <?php
    }
}
?>       

        </div>
    </div>
    <div class="" style="width: 180px; margin-left: 25px;">
        <div class="cart_text1">
            <span style="font-size:16px; color:#672A8B">Total</span>
        </div>
        <div class="cart_text2">
            <span style="font-size:16px; color:#672A8B; margin-right:10px;">$</span><label id="totalamount" style="color: #672A8B;">0</label>
        </div>
        <div class="clear"></div>
        <div class="h_line1"></div>
    </div>
    <div class="">
        <div style="float: left;"><label style="font-size: 9px; color: #672A8B;margin-left: 25px;">(Prices are tax Included)</label></div>
        <div style="padding-left:25px;margin-bottom: 10px;"><br>
            <a href="index.php?p=cart" class="cart_button">Cart</a>
            <a href="index.php?p=cart" class="check_button">Check Out</a>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var totalPrice = 0;

    for(var i=0;i<<?php echo count($rsu); ?>;i++){

        var quantity = document.getElementById('Qyt'+i).value;

        var itemprice = document.getElementById('price'+i).value;

        var totalpricei = quantity*itemprice;

        totalPrice += totalpricei;

    }

    document.getElementById('totalamount').innerHTML = totalPrice;

</script>