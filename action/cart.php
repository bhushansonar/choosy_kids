<?php
if ($_REQUEST["a"] == "cart") {
    echo $pid = $_REQUEST["ProductId"];
    echo $flag = 0;
    echo $qty = loadVariable("quantity", "");



    if (isset($_SESSION["userid"]) != "") {
        $uid = $_SESSION["userid"];
    } else {
        $uid = $_COOKIE['PHPSESSID'];
    }

    $sql = "select * from shoppingcart";
    $rspro = $objDB->select($sql);
    for ($i = 0; $i < count($rspro); $i++) {
        $pid1 = $rspro[$i]['ProductId'];
        $uid1 = $rspro[$i]['UserId'];
        if ($pid == $pid1 && $uid == $uid1) {
            $flag = 1;
        }
    }
    if ($flag == 1) {
        $sql = "select * from shoppingcart where ProductId='" . $pid . "'";
        $rspro = $objDB->select($sql);
        for ($i = 0; $i < count($rspro); $i++) {
            $qty1 = $rspro[$i]['Quantity'] . "<br>";
            $qty = $qty + $qty1;
            $sql2 = "update shoppingcart set Quantity='" . $qty . "' where ProductId='" . $pid . "'";
            mysql_query($sql2);
            echo "URL^_^";
            ?>
            <?php
            if (isset($_SESSION["userid"]) != "") {
                $uid = $_SESSION["userid"];
            } else {
                $uid = $_COOKIE['PHPSESSID'];
            }
            $sql1 = "select * from shoppingcart where UserId ='" . $uid . "'";
            $rsu = $objDB->select($sql1);
            ?>
            <!--this--><input type="hidden" id="count" name="count" value="<?php echo count($rsu); ?>" />
            <?php
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
                    ?>
                           " />
                    <input type="hidden" id="Qyt<?php echo $i; ?>" name="Qyt" value="<?php echo $rsu[$i]['Quantity']; ?>" />
                    <div id="cart<?php echo $i; ?>" class="prodct_listing">
                        <div style="width: 127px; float: left;">
                            <span style="color:#000000; font-size:12px;"><?php echo $rsd[$d]['ProductName']; ?></span>
                        </div>

                        <div style="width:15px; float:left;">
                            <span style="color:#000000; font-size:12px;" ><?php echo $rsu[$i]['Quantity']; ?></span>
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
                        <a href="javascript:funRemove('<?php echo $rsu[$i]['ProductId']; ?>','<?php echo $i; ?>','<?php echo count($rsu); ?>')"><img src="images/minus1.png" /></a>
                        <div style="clear:both"></div>
                    </div>

                <?php
                }
            }
            ?>
            <?php
        }
    } else {
        $sql = "insert into shoppingcart(UserId,ProductId,Quantity) values ('" . $uid . "','" . $pid . "','" . $qty . "')";
        $objDB->insert($sql);
        echo "URL^_^";
        ?>
        <?php
        if (isset($_SESSION["userid"]) != "") {
            $uid = $_SESSION["userid"];
        } else {
            $uid = $_COOKIE['PHPSESSID'];
        }
        $sql1 = "select * from shoppingcart where UserId ='" . $uid . "'";
        $rsu = $objDB->select($sql1);
        ?>
        <input type="hidden" id="count" name="count" value="<?php echo count($rsu); ?>" />
        <?php
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
                ?>
                       " />
                <input type="hidden" id="Qyt<?php echo $i; ?>" name="Qyt" value="<?php echo $rsu[$i]['Quantity']; ?>" />
                <div id="cart<?php echo $i; ?>" class="prodct_listing">
                    <div style=" width: 127px; float: left;">
                        <span style="color:#000000; font-size:12px;"><?php echo $rsd[$d]['ProductName']; ?></span>
                    </div>
                    <div style="width:15px; float:left;">
                        <span style="color:#000000; font-size:12px;" ><?php echo $rsu[$i]['Quantity']; ?></span>
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
                    <a href="javascript:funRemove('<?php echo $rsu[$i]['ProductId']; ?>','<?php echo $i; ?>','<?php echo count($rsu); ?>')"><img src="images/minus1.png" /></a>
                    <div style="clear:both"></div>
                    
                </div>
            <?php
            }
        }
        ?>    
        <?php
    }
}?>