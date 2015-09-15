<script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/ajax.js"></script> 
<div class="main-container holder">
    <div class="contain_right">
        <div class="h_line1"></div>
        <div class="heading">Cart</div>
        <div class="h_line1"></div>
        <div class="gallery_box" style="overflow: hidden">
            <div class="product_d_part">
                <div class="cart_line_box" style="background-color:#672A8B; overflow: hidden;">
                    <div class="cart_line_name_box" style="width: 180px;"><h1 align="center" style="font-size: 14px;color: #FFFFFF;border-right:1px solid #FFFFFF;">Name</h1></div>
                    <div class="cart_line_image_box" style="width: 180px;"><h1 align="center" style="font-size: 14px;color: #FFFFFF;border-right:1px solid #FFFFFF;">Image</h1></div>
                    <div class="cart_line_price_box" style="width: 180px;"><h1 align="center" style="border-right:1px solid #FFFFFF;font-size: 14px;color: #FFFFFF;" >Price</h1></div>
                    <div class="cart_line_qunty_box" style="width: 180px;"><h1 align="center" style="border-right:1px solid #FFFFFF;font-size: 14px;color: #FFFFFF;">Quantity</h1></div>
                    <div class="cart_line_subt_box" style="width: 180px;"><h1 align="center" style="font-size: 14px;color: #FFFFFF;">Subtotal</h1></div>
                    <div class="clear"></div>
                </div>
                <?php
                if (isset($_SESSION["userid"]) != "") {

                    $uid = $_SESSION["userid"];
                } else {

                    $uid = $_COOKIE['PHPSESSID'];
                }

                $sql1 = "select * from shoppingcart where UserId ='" . $uid . "'";



                $rsu = $objDB->select($sql1);



                for ($u = 0; $u < count($rsu); $u++) {

                    $pid = $rsu[$u]['ProductId'];

                    $quantity = $rsu[$u]['Quantity'];



                    $sql1 = "select * from product where ProductId ='" . $pid . "'";

                    $rsd = $objDB->select($sql1);



                    for ($d = 0; $d < count($rsd); $d++) {

                        $sql2 = "select * from product_qty where ProductId ='" . $pid . "'";

                        $rsize = $objDB->select($sql2);
                        ?> 

                        <div class="cart_line_box" id="cart<?php echo $u; ?>">

                            <div class="cart_line_name_box" style="margin-top: 30px; width: 150px;"><?php echo ucwords($rsd[$d]["ProductName"]); ?></div>

                            <div class="cart_line_image_box" ><img style="margin-left:4px;" src="<?php echo $AbsoluteURLAdmin; ?>images/Product_Image/<?php echo $rsd[$d]['ProductImage']; ?>"  height="75" width="75" /></div>

                            
                            <div class="cart_line_price_box" style="margin-top: 30px;"><input type="hidden" id="price<?php echo $u; ?>" name="price" value="

                                                                    <?php
                                                                    if ($rsd[$d]['offer'] != 0) {

                                                                        $dp = $rsd[$d]['ProductPrice'] * $rsd[$d]['offer'] / 100;



                                                                        $dp = $rsd[$d]['ProductPrice'] - $dp;

                                                                        echo(round($dp));
                                                                    } else {

                                                                        echo $rsd[$d]['ProductPrice'];
                                                                    }
                                                                    ?>

                                                                    " />$ 

                                <?php
                                if ($rsd[$d]['offer'] != 0) {

                                    $dp = $rsd[$d]['ProductPrice'] * $rsd[$d]['offer'] / 100;



                                    $dp = $rsd[$d]['ProductPrice'] - $dp;

                                    echo $price = (round($dp));
                                } else {

                                    echo $price = $rsd[$d]['ProductPrice'];
                                }
                                ?>
                                
                            </div>
                            
                            <div class="cart_line_qunty_box2" style="margin-top: 30px;">
                                <input type="text" id="Qyt<?php echo $u; ?>" name="Qyt" size="5" value="<?php echo $rsu[$u]['Quantity']; ?>" onblur="addtocart(<?php echo $rsize[0]['Quantity']; ?>, '<?php echo $u; ?>', '<?php echo count($rsu); ?>', '<?php echo $rsu[$u]['ProductId']; ?>')"/>
                                <a  href="javascript:funRemove('<?php echo $rsu[$u]['ProductId']; ?>','<?php echo $u; ?>','<?php echo count($rsu); ?>','<?php echo $sz ?>')"><img src="images/minus1.png" style="height: 28px;width: 28px;" /></a>
                                <div class="clear"></div>
                            </div>

                            <div id="subtotal" style="margin-top: 30px;" class="cart_line_subt_box">$ <label style="margin-left:2px;" id="total<?php echo $u; ?>" class="total">

                                    <?php
                                    $total = $quantity * $price;

                                    echo $total;
                                    ?>

                                </label></div>

                            <div class="clear"></div>



                        </div>  <?php
                    }

//                            }
                }
                ?>



                <div class="cart_line_box">

                    <div class="cart_line_subt_box2">

                        <div class="cart_line_sku_box2"><h1 style="font-size: 14px;border: medium none; color: #672A8B">Total:</h1></div>

                        <div class="cart_line_subt_box">$ <label style="margin-left:2px;" id="totalamount" >

                            </label></div>

                        <div class="clear"></div>

                    </div>



                    <div class="clear"></div>

                </div>

                <div style="padding-left:10px;"><br />

                    <a href="index.php">    <img src="images/c_s.jpg" /></a>

                    <a href="index.php?p=checkout">  <img src="images/check_out.jpg" /></a>

                    <!--<div class="cart_button"><a <href="#">Continue&nbsp;Shopping </a></div>

                            <div class="checkout_button" style="border:1px solid #a4a4a4; line-height:20px;"><a href="index.php?p=checkout" style="color:#000000;">Check&nbsp;Out</a></div>-->

                    <div class="clear"></div>

                </div>
            </div> 

        </div>



        <div class="clear"></div>

    </div>

</div>
<script type="text/javascript">

    var totalPrice = 0;

    for (var i = 0; i <<?php echo count($rsu); ?>; i++) {

        var quantity = document.getElementById('Qyt' + i).value;

        var itemprice = document.getElementById('price' + i).value;

        var totalpricei = quantity * itemprice;

        totalPrice += totalpricei;

    }

    document.getElementById('totalamount').innerHTML = totalPrice;

</script>