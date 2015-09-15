<script src="<?php echo $AbsoluteURL; ?>js/ajax.js"></script>
<script src="<?php echo $AbsoluteURL; ?>js/ajaxsubmit.js"></script>
<script src="<?php echo $AbsoluteURL; ?>js/jquery.ui.core.js"></script>
<script src="<?php echo $AbsoluteURL; ?>js/jquery.ui.widget.js"></script>
<link href="css/jquery.fancybox.css?v=2.1.4" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.4"></script>
<script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/jquery.validate.js"></script>
<?php
$category_id = loadVariable("c", "");
?>
<div class="main-container holder">
    <!-- grid-cols -->
    <div class="grid-cols">
        <!-- col67 -->
        <div style="width:100%;" class="col67">
            <div class="col-holder">
                <?php
                if ($category_id != '') {
                    global $objDB;
                    $where = "";
                    $result = $objDB->getDataArray('site_menu', 'menu_id', 'menu_name', 'menu_id');
                    echo "<h3>" . $result[$category_id] . "</h3>";
                } else {
                    echo "<h3>All Products</h3>";
                }
                ?>
                <div class = "contain_right">

                    <div class="gallery_box">

                        <?php include_once 'sidebar.php'; ?>



                        <div class="gallery_line">
                            <div style="width: 687px;height: auto;float: left" >
                                <?php
                                global $objDB;
                                $where = "";

                                if ($category_id != "") {
                                    $where.= " AND `CategoryId`=$category_id";
                                }
                                $query = "SELECT * FROM `product` WHERE `status` = '1' $where";
                                $rspb = $objDB->select($query);

                                for ($pb = 0; $pb < count($rspb); $pb++) {
                                    ?>

                                    <div class="image_box2">

                                        <div align="center" class="product1box_heading_image">
                                            <div class="name_text"><?php echo strtoupper($rspb[$pb]['ProductName']); ?><br>

                                            </div>


                                            <div class="image_part">
                                                <a href="index.php?p=productdetail&amp;ID=<?php echo $rspb[$pb]['ProductId']; ?>"><img src="<?php echo $AbsoluteURLAdmin ?>images/Product_Image/<?php echo $rspb[$pb]['ProductImage']; ?>" style="height: 130px;"></a>
                                            </div>
                                        </div>

                                        <div class="name_text" style="font-size:22px; color:#d93c4f; min-width: 20px"> $<?php echo $rspb[$pb]['ProductPrice']; ?></div>
                                        <div style=" width:200px; margin-top:5px; text-align:center;  ">
                                            <form method="post" name="MyForm<?= $pb; ?>" onSubmit="xmlhttpPost('manage.php?p=cart&a=cart&ProductId=<?php echo $rspb[$pb]['ProductId']; ?>', 'MyForm<?= $pb; ?>', 'MyResult', '', '<?= $pb; ?>', '<?php
                                            if (count($rsu) > 0) {
                                                echo count($rsu);
                                            } else {
                                                echo "1";
                                            }
                                            ?>');
                                                       return false;" >

                                                <input type="hidden" value="1" name="quantity" id="quantity" />
                                                <input type="hidden" value="<?= $pb; ?>" name="c" id="c" />
                                                <input type="hidden" id="count" name="count" value="" />
                                                <input type="hidden" value="<?php echo $rspb[$pb]['CategoryId']; ?>" name="category_id" id="category_id" />
                                                <div  style="float: right;width: 84px;">
                                                    <input name="submit" type="image" src="images/cart-icon.jpg"/>

                                                </div>

                                            </form>
                                            <a href="index.php?p=productdetail&amp;ID=<?php echo $rspb[$pb]['ProductId']; ?>"><img style="margin-right: 30px;" src="images/details-icon.jpg"></a>

                                            <div style="margin: 5px 0 0;padding:0;width:200px; font-size:14px; text-align:center;float:left;"><b style="font-weight:bold; text-align:center;">other content type here</b>
                                            </div>

                                        </div>                               

                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <!--</div>-->

                            <div class="clear"></div>

                        </div>
                    </div>
                    <div style="margin-top:15px;  height:30px;" class="gallery_box">

                    </div>
                </div><br><br>									
            </div>
        </div>
    </div>
</div>
